@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>データの登録</h2>
        <div class="message">
            <p>登録が完了しました。</p>
            <ul>
                <li><a href="{{route('addads')}}">データの登録</a></li>
                <li><a href="{{route('ads')}}">データの一覧</a></li>
                <li><a href="{{route('business')}}">トップページ</a></li>
            </ul>
        </div><!--message END-->
    </div>
</div>
@stop    
