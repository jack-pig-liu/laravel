<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<h1>{{ $title }}</h1>

<!-- @include('component.social') -->
@include('component.errors')

<form action="/merchandise/{{ $merchandise->id }}/edit"
    method="post"
    enctype="multipart/form-data">

    <div class="form-group">
        <label for="type">狀態</label>
        <select class="form-control"
            name="status"
            id="status">
            <option value="C"
                @if(old('status', $merchandise->status)=='C') selected @endif
                >
                建立中
            </option>
            <option value="S"
                @if(old('status', $merchandise->status)=='S') selected @endif
                >
                銷售中
            </option>
        </select>
    </div>
    <div class="form-group">
        <label for="name">中文名稱</label>
        <input type="text"
            class="form-control"
            id="name"
            name="name"
            value="{{ old('name', $merchandise->name) }}">
    </div>
    <div class="form-group">
        <label for="name_en">英文名稱</label>
        <input type="text"
            class="form-control"
            id="name_en"
            name="name_en"
            value="{{ old('name_en', $merchandise->name_en) }}">
    </div>
    <div class="form-group">
        <label for="introduction">商品介紹</label>
        <input type="text"
            class="form-control"
            id="introduction"
            name="introduction"
            value="{{ old('introduction', $merchandise->introduction) }}">
    </div>
    <div class="form-group">
        <label for="introduction_en">英文介紹</label>
        <input type="text"
            class="form-control"
            id="introduction_en"
            name="introduction_en"
            value="{{ old('introduction_en', $merchandise->introduction_en) }}">
    </div>
    <div class="form-group">
        <label for="photo">商品圖片</label>
        <input type="file"
            class="form-control"
            id="photo"
            name="photo">
        <img src="/{{ $merchandise->photo }}" />
    </div>

    <div class="form-group">
        <label for="price">商品價格</label>
        <input type="text"
            class="form-control"
            id="price"
            name="price"
            value="{{ old('price', $merchandise->price) }}">
    </div>
    <div class="form-group">
        <label for="remain_count">剩餘庫存</label>
        <input type="text"
            class="form-control"
            id="remain_count"
            name="remain_count"
            value="{{ old('remain_count', $merchandise->remain_count) }}">
    </div>
    <button type="submit" class="btn btn-default">更新</button>
    {{-- CSRF 欄位--}}
    {{ csrf_field() }}
</form>

@endsection