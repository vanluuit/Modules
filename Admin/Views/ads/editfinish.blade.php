@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>広告の編集</h2>
        <div class="message">
            <p>編集が完了しました。</p>
            <ul>
                <li><a href="{{route('ads')}}">データの一覧</a></li>
                <li><a href="{{route('business')}}">トップページ</a></li>
            </ul>
        </div><!--message END-->
    </div>
</div>
@stop    
