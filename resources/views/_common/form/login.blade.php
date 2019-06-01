<h3 class="h3 mb-3 font-weight-normal">欢迎来到vMall管理后台，请登录</h3>

<form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="请输入邮箱" value="{{old('email')}}" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="请输入密码" required>
    </div>
    <div class="form-group">
        <div class="i-checks">
            <label>
                <input type="checkbox" name="remember" checked> 记住我
            </label>
            @if(count($errors))
                <small class="text-danger">账号或密码错误！</small>
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block">登录</button>

    <p class="text-muted text-center text-nowrap mt-2">
        还没有账号？
        <a href="{{ url('/register') }}">注册账号</a>
    </p>
    
</form>
