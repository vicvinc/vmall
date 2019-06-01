<table class="table table-hover">
    <tr>
        <th>订单号：</th>
        <td class="modal-data-1">{{$data->no}}</td>
        <th>下单时间：</th>
        <td class="modal-data-2">{{$data->created_at}}</td>
    </tr>
    <tr>
        <th>订单总价：</th>
        <td class="modal-data-3">&yen; {{$data->order_amount}}</td>
        <th>商品总价：</th>
        <td class="modal-data-4">&yen; {{$data->goods_amount}}</td>
    </tr>
    <tr>
        <th>支付状态：</th>
        <td class="modal-data-5">{{$data->status}}</td>
        <th>使用状态：</th>
        <td class="modal-data-6">{{$data->status}}</td>
    </tr>
    <tr>
        <th>收货人姓名：</th>
        <td class="modal-data-9">{{$data->name}}</td>
        <th>收货人电话：</th>
        <td class="modal-data-2">{{$data->phone}}</td>
    </tr>
    <tr>
        <th>购物清单：</th>
        <td colspan="3">
            @foreach ($data->details as $detail)
                <img class="commodity-img-url" src="{{$detail->goods_thumbnail}}"/>
                【{{$detail->goods_actprice}}】 
                {{$detail->goods_name}}
                【{{$detail->goods_num}}件】
            @endforeach
        </td>
    </tr>
</table>
