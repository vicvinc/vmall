<table class="table table-hover">
    <thead>
        <tr>
            <th>头像</th>
            <th>订单号</th>
            <th>支付状态</th>
            <th>订单总价</th>
            <th>使用状态</th>
            <th>联系人</th>
            <th>联系电话</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($data->items()))
            @foreach($data->items() as $order)
                <tr>
                    <td>
                        <img class="head-img-url" src="{{$order->follower->avatar}}"/>
                    </td>
                    <td>{{$order->no}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->order_amount}}¥</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <a href="javascript:;" data-order="{{$order->uid}}" class="btn btn-info info-btn">
                            查看
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="10">
                <div class="no-record">
                    <i class="icon icon-inbox"></i>
                    <p>暂无该分类下的订单数据</p>
                </div>
            </td>
        <tr>
        @endif
    </tbody>
</table>
