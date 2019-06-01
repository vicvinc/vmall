<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ShopBanner;
use Image;

class ShopBannerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $banners = ShopBanner::paginate(10);

        return view('admin.shop.banner.index')->with([
            'main_title' => '店铺管理',
            'sub_title' => '首页轮播',
            'card_title' => '轮播列表',
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.shop.banner.create')->with([
            'main_title' => '店铺管理',
            'sub_title' => '首页轮播',
            'card_title' => '新增轮播',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $banner = new ShopBanner();
        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/banner/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }
        $banner->fill($inputs);

        if($banner->save()) {
            return redirect()->to('admin/shop/banner')->withSuccess('新增轮播图成功！');
        } else {
            return redirect()->to('admin/shop/banner')->withError('新增轮播图失败！');
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

        $banner = ShopBanner::where('uid', $uid)->first();

        if ($banner) {
            return view('admin.shop.banner.edit')->with([
                'main_title' => '店铺管理',
                'sub_title' => '首页轮播',
                'card_title' => '编辑轮播',
                'banner' => $banner
            ]);
        } else {
            return redirect()->to('admin/shop/banner')->withError('对应轮播图不存在！');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid) {

        $banner = ShopBanner::where('uid', $uid)->first();
        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/banner/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }

        if($banner->update($inputs)) {
            return redirect()->to('admin/shop/banner')->withSuccess('修改轮播图成功！');
        } else {
            return redirect()->to('admin/shop/banner')->withError('修改轮播图失败！');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid) {
        $banner = ShopBanner::where('uid', $uid)->first();

        if($banner){
            $banner->delete();
            return redirect()->to('admin/shop/banner')->withSuccess('删除轮播图成功！');
        }else{
            return redirect()->to('admin/shop/banner')->withError('删除失败，未找到对应轮播图！');
        }
    }
}
