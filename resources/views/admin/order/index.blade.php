@extends('layouts.content')

@section('card_body')
    <h3>
        <a
            href="{{url('admin/order?status=wait_pay')}}"
            class="btn btn-sm {{ $status == 'wait_pay' ? 'btn-primary' : 'btn-light' }} "
        >
            待支付
        </a>
        <a
            href="{{url('admin/order?status=payed')}}"
            class="btn btn-sm {{ $status == 'payed' ? 'btn-primary' : 'btn-light' }}"
        >
            已支付
        </a>
        <a href="{{url('admin/order?status=used')}}"
        class="btn btn-sm {{ $status == 'used' ? 'btn-primary' : 'btn-light' }}">
            已使用
        </a>
        <a href="{{url('admin/order?status=refund')}}"
        class="btn btn-sm {{ $status == 'refund' ? 'btn-primary' : 'btn-light' }}">
            已退款
        </a>
        <a href="{{url('admin/order?status=closed')}}" 
            class="btn btn-sm {{ $status == 'closed' ? 'btn-primary' : 'btn-light' }}">
            已关闭
        </a>
    </h3>
    <div class="table-responsive">
        @include('_common.table.order', ['data' => $data])
    </div>
    <nav class="text-center">
        {!! $data->appends(['status'=>$status])->render() !!}
    </nav>
    <div class="modal fade" tabindex="-1" role="dialog" id="orderModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">订单详情</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="data-table" class="modal-body table-responsive">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/admin/order/orderInfo.js')}}"></script>
@endsection
