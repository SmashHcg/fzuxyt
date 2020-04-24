<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container ">
    <a class="navbar-brand" href="{{route('home')}}">福大校友录</a>
    <ul class="navbar-nav justify-content-end">
      @if (Auth::check())
        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>
        <!--姓名下拉框导航-->
        <li class="nav-item dropdown">
          <!--姓名按钮-->
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->nickName }}
          </a>
          <!--下拉框-->
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人中心</a>
            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">编辑资料</a>
            <div class="dropdown-divider"></div>
            <!--登出跳转-->
            <a class="dropdown-item" id="logout" href="#">
              <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
              </form>
            </a>
          </div>
        </li>
      @else
        <li class="nav-item"><a class="nav-link" href="{{route('help')}}">帮助</a></li>
        <li class="nav-item" ><a class="nav-link" href="{{route('login')}}">登录</a></li>
      @endif
    </ul>
  </div>
</nav>
