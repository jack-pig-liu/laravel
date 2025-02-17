<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<h1>{{ $title }}</h1>

<!-- @include('component.social') -->
@include('component.errors')

<form action="/user/auth/signin" method="post">
    {{ csrf_field() }}

    Email： <input type="text" name="email"
        placeholder="Email" value="{{old('email')}}"><br>
    密碼： <input type="password" name="password"
        placeholder="密碼" value="{{old('password')}}"><br>
    <input type="submit" value="登入">
</form>
@endsection