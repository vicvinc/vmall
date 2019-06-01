<table class="table table-hover">
    <thead>
        <tr>
            <th>头像</th>
            <th>昵称</th>
            <th>性别</th>
            <th>所在地</th>
            <th>状态</th>
            <th>关注时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($data->items()))
            @foreach($data->items() as $follower)
                <tr>
                    <td>
                        <img
                            class="head-img-url"
                            alt="{{$follower->nickname}}"
                            src="{{$follower->avatar}}"
                        />
                    </td>
                    <td>{{$follower->nickname}}</td>
                    <td>{{$follower->sex}}</td>
                    <td>
                        {{$follower->country}} {{$follower->province}} {{$follower->city}}
                    </td>
                    <td>{{$follower->sub_status}}</td>
                    <td>{{$follower->created_at}}</td>
                    <td>
                        <form method="POST" action="{{url('admin/wechat/refresh')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input name="openid" value="{{$follower->openid}}" type="hidden">
                            <button type="submit" class="btn btn-primary" title="更新粉丝信息">刷新</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">
                    <div class="no-record">
                        <i class="icon icon-inbox"></i>
                        <p>暂时没有粉丝关注信息</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>

