<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

use Validator;
use App\Models\WechatFollower;
use App\Models\Address;
use App\Models\Suggestion;

class UserController extends Controller {
    protected $user, $openid;

    public function __construct() {
        $user = session('wechat.oauth_user')['default'];
        $this->user = $user;
        $this->openid = $user['id'];
    }

    // wechat user info
    public function userinfo() {
        return response()->json([
            'code' => 0,
            'data' => $this->user,
            'message' => 'success',
        ]);
    }

    public function suggestion(Request $request) {
        $suggestion = $request->input('suggestion');

        $suggest = new Suggestion();

        $suggest->openid = $this->openid;
        $suggest->content = $suggestion;
        if ($suggest->save()) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => -1]);
        }
    }

    // add new contact info
    public function storeAddress(Request $request) {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'phone' => array('regex:/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/'),
            'defaulted' => 'required|boolean', // if the address is choosen
        ];
        $messages = [
            'name.required' => '收货人还未填写',
            'phone.required' => '手机号码还未填写',
            'phone.regex' => '手机号码不合法',
            // 'province.required' => '未选择省',
            // 'city.required' => '未选择市',
            // 'address.required' => '详细地址还未填写',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => -1,
                    'message' => $validator->errors()->first(),
                ]
            );
        } else {
            $address = new Address();
            $address->openid = $this->openid;
            $address->name = $request->name;
            $address->phone = $request->phone;
            // $address->province = $request->province;
            // $address->city = $request->city;
            // $address->district = $request->district;
            // $address->address = $request->address;
            $address->defaulted = $request->defaulted;
            if ($address->save()) {
                if ($address->defaulted) {
                    // 将其他地址defaulted设置为FALSE
                    Address::where('id', '!=', $address->id)
                        ->where('openid', '=', $address->openid)
                        ->update(['defaulted' => FALSE]);
                }
                return response()->json(
                    [
                        'code' => 0,
                        'message' => '操作成功'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'code' => -1,
                        'message' => '请求超时'
                    ]
                );
            }
        }
    }

    // get all contact list
    public function indexAddress() {

        $openid = $this->openid;

        $follow = WechatFollower::where('openid', '=', $openid)->first();

        if ($follow) {
            $addresses = $follow->addresses()->get();
            return response()->json([
                'code' => 0,
                'data' => $addresses,
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'data' => NULL,
                'message' => '没找到您的相关地址！'
            ]);
        }
    }

    // update contact info
    public function updateAddress(Request $request, $id) {
        $openid = $this->openid;
        $address = Address::find($id);
        if ($address && $openid === $address->openid) {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'phone' => array('regex:/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/'),
                // 'province' => 'required',
                // 'city' => 'required',
                // 'address' => 'required',
                'defaulted' => 'required|boolean',
            ];
            $messages = [
                'name.required' => '收货人还未填写',
                'phone.required' => '手机号码还未填写',
                'phone.regex' => '手机号码不合法',
                // 'province.required' => '未选择省',
                // 'city.required' => '未选择市',
                // 'address.required' => '详细地址还未填写',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'code' => -1,
                        'message' => $validator->errors()->first(),
                    ]
                );
            } else {
                $address->name = $request->name;
                $address->phone = $request->phone;
                $address->province = $request->province;
                $address->city = $request->city;
                $address->district = $request->district;
                $address->address = $request->address;
                $address->defaulted = $request->defaulted;
                if ($address->save()) {
                    if ($address->defaulted) {
                        // 将其他地址defaulted设置为FALSE
                        Address::where('openid', '=', $openid)
                            ->where('id', '!=', $id)
                            ->update(['defaulted' => FALSE]);
                    }
                    return response()->json(
                        [
                            'code' => 0,
                            'message' => '操作成功'
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'code' => -1,
                            'message' => '联系方式更新超时，请稍后再试！'
                        ]
                    );
                }
            }
        } else {
            return response()->json([
                'code' => -1,
                'message' => '更新的地址无效！'
            ]);
        }
    }

    // remove contact info
    public function deleteAddress($id) {
        $openid = $this->openid;

        $address = Address::where('openid', '=', $openid)
            ->find($id);

        if ($address) {

            if ($address->defaulted) {
                
                $defaultAddr = Address::where('openid', '=', $openid)
                    ->where('id', '!=', $id)
                    ->first();

                if ($defaultAddr) {
                    $defaultAddr->update(['defaulted' => TRUE]);
                }
            }
            if ($address->delete()) {
                return response()->json([
                    'code' => 0,
                    'message' => '操作成功'
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'message' => '请求超时'
                ]);
            }
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该地址不存在'
            ]);
        }
    }

    public function showAddress($id)
    {
        $address = Address::find($id);
        if ($address) {
            return response()->json([
                'code' => 0,
                'message' => $address
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '没有相关地址'
            ]);
        }
    }

    public function defaultAddress(){
        $openid = $this->openid;
        // 查询该粉丝是否建立过收货地址
        $addresses = Address::where('openid','=',$openid)->get();
        if(count($addresses)){
            $default_address = [];
            foreach($addresses as $address){
                if($address['defaulted'] == 1){
                    $default_address = $address;
                    break;
                }
            }
            if($default_address){
                // 存在默认地址，则返回默认地址
                return response()->json([
                    'code' => 0,
                    'message' => $default_address
                ]);
            }else{
                // 不存在默认地址，则返回第一条地址数据
                return response()->json([
                    'code' => 0,
                    'message' => $addresses->first()
                ]);
            }
        }else{
            return response()->json([
                'code' => 0,
                'message' => ''
            ]);
        }
    }

}
