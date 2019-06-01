@extends('layouts.content')

@section('card_body')
    <form
        action="{{url('admin/product/category')}}"
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
            <input name="title" type="text" class="form-control" placeholder="分类名" required>
        </div>
        <div class="form-group">
            <label>图片：</label>
            <input name="thumbnail" type="file" class="form-control">
        </div>
        <div class="form-group">
            <label>类型：</label>
            <label class="radio-inline">
                <input type="radio" name="type" value="first_cate" checked> 一级分类
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="second_cate"> 二级分类
            </label>
        </div>
        <div class="form-group hidden" id="parentWrapper">
            <label>选择上级分类：</label>
            @if(!count($parentCategories))
                <p class="text-warning">创建二级分类，请先新建至少一个一级分类</p>
            @endif
            <select class="form-control" name="parent_uid">
                @foreach($parentCategories as $item)
                    <option value="{{$item->uid}}">
                        {{$item->title}}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection

@section('script')
    <script src="{{asset('js/admin/product/categoryCreate.js')}}"></script>
@endsection