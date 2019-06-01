@extends('layouts.content')

@section('card_body')
   
    <form
        action="{{url('admin/product/topic')}}"
        method="post"
        enctype="multipart/form-data"
    >
        {{csrf_field()}}
        <div class="form-group">
            <label>排序：</label>
            <input
                class="form-control"
                name="sequence"
                type="number"
                placeholder="值越小越靠前显示,默认为0"
            >
        </div>
        <div class="form-group">
            <label>名称：</label>
            <input
                class="form-control"
                name="title"
                type="text"
                placeholder="填写专题名"
                required
            >
        </div>
        <div class="form-group">
            <label>图片：</label>
            <input
                class="form-control"
                name="thumbnail"
                type="file"
                required
            >
        </div>
        <div class="form-group">
            <label>状态：</label>
            <label class="radio-inline">
                <input type="radio" name="status" value="show" checked> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="hide"> 隐藏
            </label>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
           
@endsection
