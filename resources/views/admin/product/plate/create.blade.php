@extends('layouts.content')

@section('card_body')

    <form
        action="{{url('admin/product/plate')}}"
        method="post"
        enctype="multipart/form-data"
    >
        {{csrf_field()}}
    
        <div class="form-group">
            <label>排序：</label>
            <input name="sequence" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
        </div>
        <div class="form-group">
            <label>名称：</label>
            <input name="title" type="text" class="form-control" placeholder="板块名" required>
        </div>
        <div class="form-group">
            <label>图片：</label>
            <input name="thumbnail" type="file" class="form-control" required>
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
