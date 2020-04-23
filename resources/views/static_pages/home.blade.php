@extends('layouts.default')

@section('content')
  <div class="jumbotron">
    <h1 style="color:red">欢迎!</h1>
    <p class="lead">
      你现在所看到的是由本人制作的 <a href="https://learnku.com/courses/laravel-essential-training">福大校友录</a> 的毕业设计项目主页。
    </p>
    <p style="color:purple;font-size: 18px">
      Everything of my project will start showing soon.
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{route('signup')}}" role="button">现在注册</a>
  </div>
@stop
