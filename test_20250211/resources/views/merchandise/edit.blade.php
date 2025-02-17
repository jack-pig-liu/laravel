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

    商品名稱 <input type="text" name="name"
        placeholder="商品名稱" value="{{ old('name', $merchandise->name) }}"><br>
    <br>
    英文名稱 <input type="text" name="name_en"
        placeholder="英文名稱" value="{{ old('name_en', $merchandise->name_en) }}"><br>
    <br>
    商品介紹 <textarea name="introduction">
    {{ old('introduction', $merchandise->introduction) }}
    </textarea>
    <br>

    <!-- "id" => 3
    "status" => "C"
    "name" => ""
    "name_en" => ""
    "introduction" => ""
    "introduction_en" => ""
    "photo" => ""
    "price" => 0
    "remain_count" => 0 -->
    <input type="submit" value="登入">
</form>
@endsection