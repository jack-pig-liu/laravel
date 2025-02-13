<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<h1>{{ $title }}</h1>

<!-- @include('component.social') -->
@include('component.errors')

<form action="/user/auth/signup" method="post">
    {{ csrf_field() }}
    暱稱： <input type="text" name="nickname" 
            placeholder="暱稱" value="{{old('nickname')}}"><br>
    Email： <input type="text" name="email" 
            placeholder="Email" value="{{old('email')}}"><br>
    密碼： <input type="password" name="password" 
            placeholder="密碼" value="{{old('password')}}"><br>
    使用者類型：
    <input type="radio" name="usertype" value="user"
        @if (old("usertype")=="user" )
        checked
        @endif> 一般使用者
    <input type="radio" name="usertype" value='admin'
        @if (old("usertype")=="admin" )
        checked
        @endif> 管理員<br>
    <input type="submit" value="註冊">
</form>
@endsection