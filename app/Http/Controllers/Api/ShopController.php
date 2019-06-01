<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ShopBanner;
use App\Models\Topic;
use App\Models\Plate;
use App\Models\Category;
use App\Models\Goods;
use App\Models\ShopConfig;

class ShopController extends Controller {
    // shop config
    public function shopconfig() {
        $config = ShopConfig::first();
        if (!$config) {
            $config = new ShopConfig();
        }
        return response()->json([
            'code' => 0,
            'data' => $config,
            'message' => 'success',
        ]);
    }

    // shop banner
    public function getBanners() {
        $banners = ShopBanner::where('status', '=', 'show')
            ->orderBy('sequence', 'asc')
            ->orderBy('updated_at', 'asc')
            ->get();

        return response()->json([
            'code' => 0,
            'data' => $banners,
            'message' => 'success',
        ]);
    }

    // topic
    public function getTopics() {
        $topics = Topic::where('status', '=', 'show')
            ->orderBy('sequence', 'asc')
                            ->orderBy('updated_at', 'asc')
            ->get();
        
        return response()->json([
            'code' => 0,
            'data' => $topics,
            'message' => 'success',
        ]);
    }

    // topic items
    public function getTopicItems($uid) {

        $topic = Topic::where('uid', $id)->first();

        if ($topic) {
            $goods = Goods::where('status', '=', 'on_sale')
                ->where('topic_uid', '=', $uid)
                ->orderBy('updated_at', 'desc')
                ->paginate(8);

            return response()->json([
                'code' => 0,
                'data' => $goods,
                'message' => 'success',
            ]);
        }

        return response()->json([
            'code' => 1,
            'data' => [],
            'message' => '查询的主题不存在！'
        ]);
    }

    // blocks
    public function getBlocks() {
        $topics = Plate::where('status', '=', 'show')
            ->orderBy('sequence', 'asc')
            ->orderBy('updated_at', 'asc')
            ->get();
        
        return response()->json([
            'code' => 0,
            'data' => $topics,
            'message' => 'success'
        ]);
    }

    // block items
    public function getBlockItems($uid) {
        $plate = Plate::where('uid', $uid)->first();

        if ($plate) {
            $goods = Goods::where('status', '=', 'on_sale')
                ->where('plate_uid', '=', $uid)
                ->orderBy('updated_at', 'desc')
                ->paginate(8);

            return response()->json([
                'code' => 0,
                'data' => $goods,
                'message' => 'success',
            ]);
        }
        return response()->json([
            'code' => 1,
            'data' => [],
            'message' => '查询的板块不存在！'
        ]);
    }

    // categories
    public function getCategories() {
        $parentCategories = Category::where('type', '=', 'first_cate')
            ->orderBy('sequence', 'asc')
            ->orderBy('updated_at', 'asc')
            ->get();

        $categories = array();

        foreach ($parentCategories as $key => $parent) {
            $categories[$key]['parent'] = $parent;
            $categories[$key]['children'] = Category::where('parent_uid', '=', $parent->uid)
                ->orderBy('sequence', 'asc')
                ->orderBy('updated_at', 'asc')
                ->get();
        }
        
        return response()->json([
            'code' => 0,
            'data' => $categories,
            'message' => 'success'
        ]);
    }

    // get category item 
    public function getCateGoryItems($uid) {
        $category = Category::where('uid', '=', $uid)->first();
        if ($category) {
            $goods = Goods::where('status', '=', 'on_sale')
                ->where('category_uid', '=', $uid)
                ->orderBy('updated_at', 'desc')
                ->paginate(8);
            return response()->json([
                'code' => 0,
                'data' => $goods,
                'message' => 'success',
            ]);
        }
        return response()->json([
            'code' => 1,
            'data' => [],
            'message' => '相关分类不存在！',
        ]);
    }

    // goods list
    public function getGoods(Request $request) {
        $goods = Goods::where('status', '=', 'on_sale')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        
        return response()->json([
            'code' => 0,
            'data' => $goods,
            'message' => 'success',
        ]);
    }

    // goods detail
    public function getGoodsDetail($uid){
        $goods = Goods::where('uid', $uid)->first();
        if ($goods && $goods->status == '出售中') {
            return response()->json([
                'code' => 0,
                'message' => 'succ',
                'data' => $goods,
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该商品已下架！',
                'data' => NULL,
            ]);
        }
    }

    // search goods
    public function searchGoods($keyword) {
        $goods = Goods::where('name', 'like', '%'.$keyword.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(8);

        return response()->json([
            'code'      => 0,
            'data'      => $goods,
            'message'   => 'success',
        ]);
    }

    public function getCommodityByPlate(Request $request) {
        $id = $request->input('plate_uid');
        $response = [];
        $plate = Plate::find($id);
        if ($plate) {
            $response = $plate->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodityByCategory(Request $request)
    {
        $id = $request->input('category_id');
        $response = [];
        $category = Category::find($id);
        if ($category) {
            $response = $category->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodities($ids){
        $ids = explode(',',trim($ids,','));
        if(!is_array($ids)){
            return response()->json(
                [
                    'code'=>-1,
                    'message'=>'未查询到商品'
                ]
            );
        }
        $commodities = [];
        foreach($ids as $item){
            $item = explode('-',$item);
            // 查询商品数据
            $commodity = Goods::find($item[0]);
            // 添加购物车所选商品数量
            $commodity->cart_num = $item[1];
            $commodities[] = $commodity;
        }
        return response()->json(
            [
                'code' => 0,
                'message' => $commodities
            ]
        );
    }

}
