@extends('layouts.content')

@section('card_body')
        
<form
    action="{{url('admin/shop/banner/'.$banner->uid)}}"
    enctype="multipart/form-data"
    method="post"
>
    <input type="hidden" value="PUT" name="_method">
    {{csrf_field()}}
    <div class="form-group">
        <label>排序：</label>
        <input
            class="form-control"
            name="sequence"
            type="text"
            placeholder="值越小越靠前显示,默认为0"
            value="{{$banner->sequence}}"
        >
    </div>
    <div class="form-group">
        <label>标题：</label>
        <input
            class="form-control"
            name="title"
            type="text"
            placeholder="轮播图标题，可为空"
            value="{{$banner->title}}"
        >
    </div>
    <div class="form-group">
        <label>图片：</label>
        @if($banner->thumbnail)
            <img src="{{$banner->thumbnail}}" width="120px" height="80" class="img-thumbnail">
            <input id="file" name="thumbnail" type="file" class="form-control d-none">
        @else
            <input name="thumbnail" type="file" class="form-control" required>
        @endif
    </div>
    <div class="form-group">
        <label>链接：</label>
        <input name="link" type="text" class="form-control" value="{{$banner->link}}">
    </div>
    <div class="form-group">
        <label>状态：</label>
        <label class="radio-inline">
            <input
                type="radio" name="status" value="show"
                @if($banner->status == "显示")
                    checked
                @endif
            > 显示
        </label>
        <label class="radio-inline">
            <input
                type="radio"
                name="status"
                value="hide"
                @if($banner->status == "隐藏")
                    checked
                @endif
            > 隐藏
        </label>
    </div>
    <button type="submit" class="btn btn-primary">保存</button>
</form>
           
@endsection

@section('script')
    <script src="{{asset('js/admin/shop/bannerEdit.js')}}"></script>
@endsection