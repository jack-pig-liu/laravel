<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<h1>{{ $title }}</h1>

<!-- @include('component.social') -->
@include('component.errors')

<ul>
    @foreach($merchandises as $merchandise)
    <li>
        <h4>{{ $merchandise->name }}</h4>
        <img src="/{{ $merchandise->photo or '/assets/images/default-merchandise.png' }}" />
        <p>{{ $merchandise->price }}</p>
        <a href="/merchandise/{{ $merchandise->id }}/edit">編輯</a>
        <form action="/merchandise/{{ $merchandise->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">刪除</button>
        </form>
    </li>
    @endforeach
</ul>

@endsection