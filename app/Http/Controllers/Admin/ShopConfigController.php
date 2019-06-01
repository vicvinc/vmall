<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ShopConfig;

class ShopConfigController extends Controller {
    
    public function index() {
        $config = ShopConfig::first();

        if (!$config) {
            $config = new ShopConfig();
        }

        return view('admin.shop.config.index')->with([
            'main_title' => '店铺信息',
            'sub_title' => '店铺管理',
            'card_title' => '店铺配置',
            'config'=>$config
        ]);

    }

    public function store(Request $request) {
        $config = ShopConfig::first();

        $inputs = $request->all();

        if (!$config) {
            $config = new ShopConfig();
        }
        
        $config->fill($inputs);

        if($config->save()){
            return redirect()->to('/admin/shop/config')->withSuccess('商铺配置修改成功');
        }else{
            return redirect()->to('/admin/shop/config')->withError('商铺配置修改失败');
        }
        
    }

}
