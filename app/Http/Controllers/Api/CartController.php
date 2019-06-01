<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Cart;
use Validator;

class CartController extends Controller {
    protected $follow, $openid;

    public function __construct() {
        $user = session('wechat.oauth_user')['default'];
        $this->follow = $user;
        $this->openid = $user['id'];
    }

    public function index() {
        $openid = $this->openid;

        $goods = Cart::with('goods')
            ->where('openid', '=', $openid)
            ->get();

        return response()->json([
            'code' => 0,
            'data' => $goods,
            'message' => 'success',
        ]);
    }

    public function calculateTotal() {
        // get cart goods by openid
        $cartCount = Cart::where('openid', '=', $this->follow->id)->count();
        // return count cart goods nunmber
        return response()->json([
            'code' => 0,
            'cartCount' => $cartCount,
            'message' => 'succ',
        ]);
    }

    public function emptyCart(){
        Cart::where('openid','=', $this->follow->id)->delete();
        return response()->json([
            'code' => 0,
            'message' => '操作成功',
        ]);
    }

    public function store(Request $request) {
        $openid = $this->openid;
        
        $rules = [
            'goods_uid' => 'required',
            'goods_num' => 'required|integer|min:1',
        ];
        
        $inputs = $request->all();

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => -1,
                'message' => '加入购物车失败，请联系商家购买',
            ]);
        } else {
            // 查询是否已存在commodity_id的数据
            $cart = Cart::where('openid', '=', $openid)
                ->where('goods_uid', '=', $inputs['goods_uid'])
                ->first();

            if ($cart) {
                // 若存在，则更新数量
                $cart->goods_num += $inputs['goods_num'];
            } else {
                // 若不存在，则录入新数据
                $cart = new Cart();
                $cart->fill($inputs);
                $cart->openid = $openid;
                // $cart->goods_uid = $request->uid;
                // $cart->goods_num = $request->num;
            }

            if ($cart->save()) {
                // return all the cart list
                $cart = Cart::with('goods')
                    ->where('openid', '=', $openid)
                    ->get();

                return response()->json([
                    'code' => 0,
                    'data' => $cart,
                    'message' => '加入购物车成功！',
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'message' => '加入购物车失败，请稍后再试！',
                ]);
            }
        }
    }

    public function update(Request $request, $uid) {

    }

    public function delete($uid) {
        $cart = Cart::where('uid', $uid)
                ->where('openid', $this->openid)
                ->first();
        
        if (!$cart) {
            return response()->json([
                'code' => -1,
                'message' => '删除购物车货物不存在！',
            ]);
        }

        $cart->delete();
        
        return response()->json([
            'code' => 0,
            'message' => '删除购物车货物成功',
        ]);
    }
}
