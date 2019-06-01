<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use EasyWeChat\Foundation\Application;

use App\Models\WechatMenu;

class WechatMenuController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $list = WechatMenu::orderBy('parent_button', 'asc')->orderBy('sequence', 'asc')->get();
        
        $menus = array();
        $level_one_menu = array();
        $level_two_menu = array();

        if (count($list)) {
            // 取出一级菜单
            foreach ($list as $index => $menu) {
                if ($menu['parent_button'] == 0) {
                    $level_one_menu[$menu['uid']] = $menu;
                } else {
                    $level_two_menu[$menu['uid']] = $menu;
                }
            }

            // 合并二级菜单至一级菜单中
            foreach ($level_one_menu as $index => $item) {
                $menus[] = $item;
                $two_menu = array();
                foreach ($level_two_menu as $uid => $value) {
                    if ($value['parent_button'] == $item['uid']) {
                        $value['name'] = '│─── ' . $value['name'];
                        $two_menu[] = $value;
                        unset($level_two_menu[$uid]);
                    }
                }
                $menus = array_merge($menus, $two_menu);
            }
        }

        return view('admin.wechat.menu.index')->with([
            'main_title' => '公众号管理',
            'sub_title' => '菜单设置',
            'card_title' => '菜单列表',
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // 查询全部一级菜单（parent_button = 0）
        $parent_menu = WechatMenu::where('parent_button', '=', 0)->get();
        return view('admin.wechat.menu.create')->with([
            'main_title' => '公众号管理',
            'sub_title' => '菜单设置',
            'card_title' => '菜单列表',
            'parent_menu' => $parent_menu
        ]);
    }

    /**
     * 发送菜单至微信
     * 生成公众号菜单
     */
    public function pushMenu(){
		$wechat = app('wechat.official_account');
		$buttons = array();
		$menus = WechatMenu::where('parent_button','=',0)->orderBy('parent_button','asc')->orderBy('sequence','asc')->get();
		
		foreach($menus as $i=>$menu){
			if($menu->type == 'none'){
				$buttons[$i] = ['name'=>$menu->name];
				$buttons[$i]['sub_button'] = array();
				$sub_menus = WechatMenu::where('parent_button','=',$menu->id)->orderBy('sequence','asc')->get();
				foreach($sub_menus as $k=>$sub){
					if($sub->type == 'view'){
						$buttons[$i]['sub_button'][$k] = ['type'=>$sub->type, 'name'=>$sub->name, 'url'=>$sub->url];
					}else{
						$buttons[$i]['sub_button'][$k] = ['type'=>$sub->type, 'name'=>$sub->name, 'key'=>$sub->key];
					}
				}
			}elseif($menu->type == 'view'){
				$buttons[$i] = ['type'=>$menu->type, 'name'=>$menu->name, 'url'=>$menu->url];
			}elseif($menu->type == 'click'){
				$buttons[$i] = ['type'=>$menu->type, 'name'=>$menu->name, 'key'=>$menu->key];
			}	
		}
	
		$wechat->menu->delete();
	
		$response = $wechat->menu->create($buttons);
		
		if($response['errcode'] == 0){
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单发送成功,5分钟之内公众号菜单会自动刷新');
		}else{
            return Redirect::to('admin/wechat/menu')->withError('菜单发送失！错误原因：' . $response->errmsg);
		}
	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $count = WechatMenu::where('parent_button', '=', 0)->count();
        $inputs = $request->all();
        
        $type = $inputs['type'];
        $parent_button = $inputs['parent_button'];

        if ($parent_button == 0) {
            if ($count >= 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，一级菜单至多设置3个！');
            }
        } else {
            if ($type == 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，二级菜单类型不能为“无事件”！');
            }
        }

        $menu = new WechatMenu();
        $menu->fill($inputs);

        if ($menu->save()) {
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单新增成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('菜单新增失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid) {
        $menu = WechatMenu::where('uid', $uid)->first();

        $parent_menu = WechatMenu::where('parent_button', '=', 0)->get();

        return view('admin.wechat.menu.edit')->with([
            'main_title' => '公众号管理',
            'sub_title' => '菜单设置',
            'card_title' => '编辑菜单',
            'menu' => $menu,
            'parent_menu'=>$parent_menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid) {

        $menu = WechatMenu::where('uid', $uid)->first();

        if (empty($menu)) {
            return Redirect::to('admin/wechat/menu')->withError('修改的菜单不存在！');
        }

        $inputs = $request->all();

        if ($menu->update($inputs)) {
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单修改成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('菜单修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid) {

        $menu = WechatMenu::where('uid', $uid)->first();

        if ($menu) {
            // 删除菜单
            $menu->delete();
            WechatMenu::where('parent_button', '=', $uid)->delete();

            return Redirect::to('admin/wechat/menu')->withSuccess('菜单删除成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('删除失败，未找到对应菜单');
        }
    }
}
