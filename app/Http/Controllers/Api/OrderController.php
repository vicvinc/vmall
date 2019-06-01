<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Carbon\Carbon;
use EasyWeChat\Factory;
use Webpatser\Uuid\Uuid;

use App\Models\OrderGoods;
use App\Models\Goods;
use App\Models\Address;
use App\Models\Order;
use App\Models\ShopConfig;
use App\Models\Cart;

use DB;
use Validator;

class OrderController extends Controller {

    protected $user, $openid;

    public function __construct() {
        $user = session('wechat.oauth_user')['default'];
        $this->user = $user;
        $this->openid = $user['id'];
    }

    // order hash id
    private function build_order_no() {
        $dateStr = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        return id_encode($dateStr);
    }

    // select order
    public function index($type) {
        $openid = $this->openid;
        $page_size = 8;

        switch ($type) {
            case 'all':
                $orders = Order::with('details')
                    ->where('openid', '=', $openid)
                    ->orderBy('created_at', 'desc')
                    ->paginate($page_size);
                break;
            case 'unpay':
                $orders = Order::with('details')
                    ->where('openid', '=', $openid)
                    ->where('status', '=', 'wait_pay')
                    ->orderBy('id', 'desc')
                    ->paginate($page_size);
                break;
            case 'payed':
                $orders = Order::with('details')
                    ->where('openid', '=', $openid)
                    ->where('status', '=', 'payed')
                    ->orderBy('created_at', 'desc')
                    ->paginate($page_size);
                break;
            case 'used':
                $orders = Order::with('details')
                    ->where('openid', '=', $openid)
                    ->where('status', '=', 'used')
                    ->orderBy('created_at', 'desc')
                    ->paginate($page_size);
                break;
            default:
                break;
        }

        return response()->json([
            'code'      => 0,
            'data'      => $orders,
            'message'   => 'success',
        ]);
    }

    // new order
    public function store(Request $request) {

        $from = $request->from;
        $contact = $request->contact;
        $goods = $request->goods;
        $openid = $this->openid;

        // godos list is empty
        if (count($goods) === 0) {
            response()->json([
                'code' => -1,
                'message' => '商品信息不能为空！',
            ]);
        }

        // get array with goods uid
        $goodsUidArray = array_map(function($a) {
            return $a['goods_uid'];
        }, $goods);

        // check all the goods is valide
        $goodsInfo = DB::table('goods')
                    ->whereIn('uid', $goodsUidArray)
                    ->get();

        // some goods is not valide
        if (count($goodsInfo) !== count($goods)) {
            return response()->json([
                'code'      => -1,
                'message'   => '库存中没有该商品的信息！'
            ]);
        }

        // merge goods num to goods info list
        $goodsInfoList = array_map(function($a, $b) {
            $a->goods_num = $b['goods_num'];
            return $a;
        }, $goodsInfo, $goods);

        // calculate order amount
        $orderAmount = 0;
        foreach ($goodsInfoList as $item) {
            $price = $item->actprice;
            $num = $item->goods_num;
            $orderAmount += $price * $num;
        }

        // new order record
        $order = [];
        $order['openid'] = $openid;
        $order['name'] = $contact['name'];
        $order['phone'] = $contact['phone'];
        // currently the order amount equals goods amount
        // no discount will be applied
        $order['goods_amount'] = $orderAmount;
        $order['order_amount'] = $orderAmount;
        $order['no'] = $this->build_order_no();
        $order['uid'] = Uuid::generate(4)->string;
        $order['created_at'] = Carbon::now();
        $order['updated_at'] = Carbon::now();

        // 记录订单表，并插入订单明细表
        try {
            DB::transaction(function() use (&$from, &$order, &$goodsInfoList, &$goodsUidArray) {
                $saveOrder = DB::table('order')->insert($order);
                // save success
                if (!$saveOrder) {
                    throw new Exception('save order info failed!');
                }

                // generate order detail list
                $orderGoodsList = [];

                foreach ($goodsInfoList as $item) {
                    $detail = [];

                    $detail['uid'] = Uuid::generate(4)->string;
                    $detail['openid'] = $order['openid'];
                    $detail['order_uid'] = $order['uid'];

                    $detail['goods_uid'] = $item->uid;
                    $detail['goods_name'] = $item->name;
                    $detail['goods_no'] = $item->no;
                    $detail['goods_thumbnail'] = $item->thumbnail;
                    $detail['goods_num'] = $item->goods_num;
                    $detail['goods_price'] = $item->price;
                    $detail['goods_actprice'] = $item->actprice;
                    // push insert row
                    array_push($orderGoodsList, $detail);
                }

                // dd($orderGoodsList);

                // insert order goods detail list
                DB::table('order_goods')->insert($orderGoodsList);
                // 若为购物车订单来源，则删除对应购物车记录

                if ($from === 'cart') {
                    DB::table('cart')->where('openid', '=', $order['openid'])
                        ->whereIn('goods_uid', $goodsUidArray)
                        ->delete();
                }

            }, 3);
            // try for 3 times
        } catch (\Exception $e) {
            return response()->json([
                'code' => -1,
                'data' => $e,
                'message' => '订单创建失败！'
            ]);
        }
        // resp
        return response()->json([
            'code' => 0,
            'data' => $order['uid'],
            'message' => '订单创建成功',
        ]);
    }

    // pay order
    public function payOrder(Request $request) {
        $prepayId = $request->input('orderID');

        $config = [
            'app_id'             => 'wxd84401efc8bac7ce',
            'mch_id'             => '',
            'key'                => '',
            // 'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            // 'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            'notify_url'         => '',     // 你也可以在下单时单独设置来想覆盖它
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            'sandbox' => true,
        ];

        $payment = Factory::payment($config);

        $jssdk = $payment->jssdk;

        $config = $jssdk->sdkConfig($prepayId);

        return response()->json([
            'code' => 0,
            'data' => $config,
            'message' => 'pay'
        ]);
    }

    public function show($id) {
        $openid = $this->openid;
        $order = Order::where('id', '=', $id)
            ->where('openid', '=', $openid)->first();
        if ($order) {
            return response()->json([
                'code' => 0,
                'message' => $order
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该订单不存在！'
            ]);
        }
    }

    // order detail
    public function detail($uid) {

        $order = Order::where('uid', $uid)
                ->where('openid', $this->openid)
                ->first();

        if ($order) {

            $goods = Order::where('uid', $uid)->with('details')->first();

            return response()->json([
                'code' => 0,
                'data' => $goods,
                'message' => 'success',
            ]);

        } else {
            return response()->json([
                'code' => -1,
                'message' => '订单不存在'
            ]);
        }
    }

    // delete order
    public function delete($uid) {
        $order = Order::where('openid', $this->openid)
                    ->where('uid', $uid)
                    ->first();

        if (!$order) {
            return response()->json([
                'code' => -1,
                'message' => '要删除的订单信息不存在！',
            ]);
        }

        $order->delete();

        return response()->json([
            'code' => 0,
            'message' => '订单删除成功！'
        ]);
    }
}
