<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;
use App\Models\WechatFollower;

class HomeController extends BaseController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
            return view('index')->with([
                'dataToday' => $this->countOrderToday(),
                'dataYesterday' => $this->countOrderYesterday(),
                'dataCurMonth' => $this->countOrderMonthly(),
                'dataCurYear' => $this->countOrderYearly(),
                'data10DaysSubUser' => $this->count10DaysSubUser(),
                'data10DaysUnSubUser' => $this->count10DaysUnSubUser(),
                'dataAllUserNum' => $this->countAllUser(),
            ]);
        } else {
            return Redirect::action('Auth\AuthController@showLoginForm');
        }
    }

    // count today's order and amount sum
    public function countOrderToday() {
        $today = Carbon::today();
        $count = Order::where('created_at', '>=', $today)->count();
        $total = Order::where('created_at', '>=', $today)
            ->where('status', '=', 'payed')
            ->sum('order_amount');
        
        return [
            'count' => $count,
            'total' => $total,
        ];
    }

    // count yesterday's order and amount sum
    public function countOrderYesterday() {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $count = Order::whereBetween('created_at', array($yesterday, $today))->count();
        $total = Order::whereBetween('created_at', array($yesterday, $today))
                ->where('status', '=', 'payed')
                ->sum('order_amount');
        
        return [
            'count' => $count,
            'total' => $total,
        ];
    }

    // count current month's order and amount sum
    public function countOrderMonthly() {
        $now = Carbon::now();
        $monthStart = $now->startOfMonth();
        $count = Order::where('created_at', '>=', $monthStart)
                ->where('status', '=', 'payed')
                ->count();
        $total = Order::where('created_at', '>=', $monthStart)
                ->where('status', '=', 'payed')
                ->sum('order_amount');
        
        return [
            'count' => $count,
            'total' => $total,
        ];
    }

    // count all the year's order and mount sum
    public function countOrderYearly() {
        $now = Carbon::now();
        $yearStart = $now->startOfYear();
        $count = Order::where('created_at', '>=', $yearStart)
                ->where('status', '=', 'payed')
                ->count();
        $total = Order::where('created_at', '>=', $yearStart)
                ->where('status', '=', 'payed')
                ->sum('order_amount');

        return [
            'count' => $count,
            'total' => $total,
        ];
    }

    // count recent 10 days new follower
    public function count10DaysSubUser() {
        $timeStart = Carbon::now()->subDays(10);
        $count = WechatFollower::where('created_at', '>=', $timeStart)
                ->where('sub_status', '=', 'subscribed')
                ->count();
    
        return $count;
        
    }

    // count recent 10days unsubscribe user
    public function count10DaysUnSubUser() {
        $timeStart = Carbon::now()->subDays(10);
        $count = WechatFollower::where('updated_at', '>=', $timeStart)
                ->where('sub_status', '=', 'unsubscribe')
                ->count();

        return $count;

    }

    // count total user
    public function countAllUser() {
        return WechatFollower::where('sub_status', '=', 'subscirbed')->count();
    }

}
