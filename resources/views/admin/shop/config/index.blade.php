@extends('layouts.content')

@section('card_body')

    <form role="form" action="/admin/shop/config" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="">名称：</label>
            <input 
                class="form-control"
                name="name"
                type="text"
                value="{{$config->name}}"
                placeholder="商城名称">
        </div>
        <div class="form-group">
            <label for="">SEO关键字：</label>
            <input
                class="form-control"
                name="seo_key_words"
                type="text"
                value="{{$config->seo_key_words}}"
                placeholder="商城关键字,以逗号分割，不超过50字">
        </div>
        <div class="form-group">
            <label for="">SEO描述：</label>
            <textarea
                class="form-control"
                name="seo_describe"
                type="text"
                placeholder="商城描述，不超过120字">{{$config->seo_describe}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">确定</button>
    </form>

@endsection

