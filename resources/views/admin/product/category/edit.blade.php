@extends('layouts.content')

@section('card_body')
    
<form
    action="{{url('admin/product/category/'. $category->uid)}}"
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
            value="{{$category->sequence}}"
            type="number"
            placeholder="值越小越靠前显示,默认为0"
        >
    </div>
    <div class="form-group">
        <label>名称：</label>
        <input
            class="form-control"
            name="title"
            value="{{$category->title}}"
            type="text"
            placeholder="分类名"
            required
        >
    </div>
    <div class="form-group">
        <label>图片：</label>
        @if($category->thumbnail)
            <img src="{{$category->thumbnail}}" class="img-thumbnail">
            <input id="file" name="thumbnail" type="file" class="form-control hidden">
        @else
            <input name="thumbnail" type="file" class="form-control" required>
        @endif
    </div>
    <div class="form-group">
        <label>类型：</label>
        <label class="radio-inline">
            <input
                type="radio"
                name="type"
                value="first_cate"
                @if($category->type == "一级分类")
                    checked
                @endif
            > 一级分类
        </label>
        <label class="radio-inline">
            <input
                type="radio"
                name="type"
                value="second_cate"
                @if($category->type=="二级分类")
                    checked
                @endif
            > 二级分类
        </label>
    </div>
    <div class="form-group hidden" id="parentWrapper">
        <label>选择上级分类：</label>
        @if(!count($parentCategories))
            <p class="text-warning">设置二级分类前，请先新建至少一个一级分类</p>
        @endif
        <select class="form-control" name="parent_uid">
            @foreach($parentCategories as $item)
                <option 
                    value="{{$item->uid}}"
                    @if($category->parent_uid == $item->uid)
                        selected
                    @endif
                >
                    {{$item->title}}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">保存</button>
</form>
          
@endsection

@section('script')
    <script src="{{asset('js/admin/product/categoryEdit.js')}}"></script>
@endsection