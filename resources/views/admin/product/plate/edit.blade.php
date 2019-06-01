@extends('layouts.content')

@section('card_body')
    
<form
    action="{{url('admin/product/plate/' . $plate->uid)}}"
    method="post"
    enctype="multipart/form-data"
>
    <input type="hidden" value="PUT" name="_method">
    {{csrf_field()}}
    <div class="form-group">
        <label>排序：</label>
        <input
            class="form-control"
            name="sequence"
            value="{{$plate->sequence}}"
            type="number"
            placeholder="值越小越靠前显示,默认为0"
        >
    </div>
    <div class="form-group">
        <label>名称：</label>
        <input
            class="form-control"
            name="title"
            value="{{$plate->title}}"
            type="text"
            placeholder="板块名"
            required
        >
    </div>
    <div class="form-group">
        <label>图片：</label>
        @if($plate->thumbnail)
            <img src="{{$plate->thumbnail}}" class="img-thumbnail">
            <input id="file" name="thumbnail" type="file" class="form-control hidden">
        @else
            <input name="thumbnail" type="file" class="form-control" required>
        @endif
    </div>
    <div class="form-group">
        <label>状态：</label>
        <label class="radio-inline">
            <input
                type="radio"
                name="status"
                value="show"
                @if($plate->status == "显示")
                    checked
                @endif
            > 显示
        </label>
        <label class="radio-inline">
            <input
                type="radio"
                name="status"
                value="hide"
                @if($plate->status == "隐藏")
                    checked
                @endif
            > 隐藏
        </label>
    </div>
    <button type="submit" class="btn btn-primary">保存</button>
</form>
           
@endsection
@section('script')
<script src="{{asset('js/admin/product/plateEdit.js')}}"></script>
@endsection
