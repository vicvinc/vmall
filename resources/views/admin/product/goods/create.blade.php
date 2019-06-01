@extends('layouts.content')

@section('card_body')
    <form action="{{url('admin/product/goods')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="goods-name">名称：</label>
                <input id="goods-name" name="name" type="text" class="form-control" placeholder="商品名称" required>
            </div>
            <div class="form-group col-md-4">
                <label for="sequence">排序：</label>
                <input id="sequence" name="sequence" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
            </div>
            <div class="form-group col-md-4">
                <label for="goods-no">编号：</label>
                <input id="goods-no" name="no" type="text" class="form-control" placeholder="商品内部编号">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="topic">所属专题：</label>
                <select id="topic" class="form-control" name="topic_uid">
                    <option value="0" selected>无</option>
                    @foreach($topics as $topic)
                        <option value="{{$topic->uid}}}">{{$topic->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="plate">所属板块：</label>
                <select id="plate" class="form-control" name="plate_uid">
                    <option value="0" selected>无</option>
                    @foreach($plates as $plate)
                        <option value="{{$plate->uid}}}">{{$plate->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="category">所属分类：</label>
                <select id="category" class="form-control" name="category_uid">
                    <option value="0" selected>无</option>
                    @foreach($categories as $category)
                        <option value="{{$category->uid}}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>原价：</label>
                <input name="price" type="text" class="form-control" placeholder="商品原始价格">
            </div>
            <div class="form-group col-md-3">
                <label>现价：</label>
                <input name="actprice" type="text" class="form-control" placeholder="商品实际出售价格">
            </div>
            <div class="form-group col-md-3">
                <label>库存：</label>
                <input name="stock" type="text" class="form-control" placeholder="库存数量">
            </div>
            <div class="form-group col-md-3">
                <label>销量：</label>
                <input name="sales" type="text" class="form-control" placeholder="可选，默认为0">
            </div>
        </div>
        <div class="form-group">
            <label>展示图片：</label>
            <input name="thumbnail" type="file" class="form-control">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="brief">商品简介：</label>
                <textarea id="brief" rows="8" cols="80" name="brief" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="editor">商品详情：</label>
                <textarea id="editor" rows="8" cols="80" name="detail" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label>状态：</label>
            <label class="radio-inline">
                <input type="radio" name="status" value="on_sale" checked> 上架
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="off_sale"> 下架
            </label>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection