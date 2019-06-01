@extends('layouts.content')

@section('card_body')
    <form
        action="{{url('admin/product/goods/'.$goods->uid)}}"
        method="post"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="goods-name">名称：</label>
                <input
                    id="goods-name"
                    class="form-control"
                    name="name"
                    value="{{$goods->name}}"
                    type="text"
                    placeholder=""
                    required
                >
            </div>
            <div class="form-group col-md-4">
                <label for="sequence">排序：</label>
                <input
                    id="sequence"
                    name="sequence"
                    value="{{$goods->sequence}}" 
                    type="number"
                    class="form-control"
                    placeholder="值越小越靠前显示,默认为0"
                >
            </div>
            <div class="form-group col-md-4">
                <label for="goods-no">编号：</label>
                <input
                    id="goods-no"
                    class="form-control"
                    name="no"
                    type="text"
                    value="{{$goods->no}}"
                    placeholder="商品编号"
                    required
                >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>所属专题：</label>
                <select class="form-control" name="topic_uid">
                    <option value="0">无</option>
                    @foreach($topics as $topic)
                        <option
                            @if($topic->uid == $goods->topic_uid)
                                selected
                            @endif
                            value="{{$topic->uid}}"
                        >
                            {{$topic->title}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>所属板块：</label>
                <select class="form-control" name="plate_uid">
                    <option value="0">无</option>
                    @foreach($plates as $plate)
                        <option
                            @if($plate->uid == $goods->plate_uid)
                                selected
                            @endif
                            value="{{$plate->uid}}"
                        >
                            {{$plate->title}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>所属分类：</label>
                <select class="form-control" name="category_uid">
                    <option value="0">无</option>
                    @foreach($categories as $category)
                        <option
                            @if($category->uid == $goods->category_uid)
                                selected
                            @endif
                            value="{{$category->uid}}"
                        >
                            {{$category->title}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>原价：</label>
                <input
                    class="form-control"
                    name="price"
                    value="{{$goods->price}}"
                    type="text"
                    placeholder=""
                    required
                >
            </div>
            <div class="form-group col-md-3">
                <label>现价：</label>
                <input
                    class="form-control"
                    name="actprice"
                    value="{{$goods->actprice}}"
                    type="text"
                    placeholder=""
                    required
                >
            </div>
            <div class="form-group col-md-3">
                <label>库存：</label>
                <input
                    class="form-control"
                    name="stock"
                    value="{{$goods->stock}}"
                    type="text"
                    placeholder=""
                    required
                >
            </div>
            <div class="form-group col-md-3">
                <label>销量：</label>
                <input
                    class="form-control"
                    name="sales"
                    value="{{$goods->sales}}"
                    type="text"
                    placeholder="可选，默认为0"
                >
            </div>
        </div>
        <div class="form-group">
            <label>展示图片：</label>
            @if($goods->thumbnail)
                <img width="120px" height="120px" src="{{$goods->thumbnail}}" class="img-thumbnail">
                <input id="file" name="thumbnail" type="file" class="form-control d-none">
            @else
                <input name="thumbnail" type="file" class="form-control">
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="brief">商品简介：</label>
                <textarea id="brief" name="brief" rows="8" cols="80" class="form-control">
                    {{$goods->brief}}
                </textarea>
            </div>
            <div class="form-group col-md-6">
                <label>商品详情：</label>
                <textarea id="editor" name="detail" rows="8" cols="80" class="form-control">
                    {{$goods->detail}}
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label>状态：</label>
            <label class="radio-inline">
                <input 
                    type="radio"
                    name="status"
                    value="on_sale" 
                    @if($goods->status == '出售中')
                        checked
                    @endif
                > 出售中
            </label>
            <label class="radio-inline">
                <input
                    type="radio"
                    name="status"
                    value="off_sale" 
                    @if($goods->status == '已停售')
                        checked
                    @endif
                > 已停售
            </label>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection
