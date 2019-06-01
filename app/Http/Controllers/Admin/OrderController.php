<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderGoods;

class OrderController extends Controller {

    public function index(Request $request) {
        // wait_pay unship shiped received ''closed''
        $status = empty($request->input('status')) ? 
            'wait_pay' : $request->input('status');
        
        // 封装查询条件
        $data = Order::with('follower')
            ->where(function ($query) use ($status) {
                switch ($status) {
                    case 'wait_pay':
                        $query->where('status', '=', 'wait_pay');
                        break;
                    case 'payed':
                        $query->where('status', '=', 'payed');
                        break;
                    case 'used':
                        $query->where('status', '=', 'used');
                        break;
                    case 'closed':
                        $query->where('status', '=', 'closed');
                        break;
                    default:
                        $query->where('status', '=', 'payed');
                        break;
                }
            })->paginate(10);
        
        return view('admin.order.index')->with([
            'main_title' => '订单管理',
            'sub_title' => '订单查看',
            'card_title' => '订单列表',
            'data' => $data,
            'status' => $status,
        ]);
    }

    public function show($uid) {

        $orderInfo = Order::where('uid', $uid)
            ->with('follower')
            ->with('details')
            ->first();

        return view('admin.order.detail')->with([
            'data' => $orderInfo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
