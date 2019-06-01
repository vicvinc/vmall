<form class="m-t" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <input name="name" type="text" class="form-control" placeholder="用户名" value="{{ old('name') }}" required>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input name="email" type="email" class="form-control" placeholder="邮箱" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="密码" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input name="password_confirmation" type="password" class="form-control" placeholder="确认密码" required>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b">注册</button>
    <p class="text-muted text-center"><small>已有账号？</small></p>
    <a class="btn btn-sm btn-white btn-block" href="{{ url('/login') }}">登录</a>
</form>