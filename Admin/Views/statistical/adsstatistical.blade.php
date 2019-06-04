@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>{{request()->y}}年 {{request()->m}}月 ： {{$ads->title}}</h2>
        <div class="list_table_lite" id="all_items_list">
            <table class="tb">
                {{-- <caption>{{request()->y}}年 {{request()->m}}月 全体広告成果一覧</caption> --}}
                <tbody>
                    <tr>
                        <th style="width:10%;">ID</th>
                        <th style="width:25%;">IP</th>
                        <th style="width:15%;">DATE</th>
                    </tr>
                    @if($data)
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->ipaddress}}</td>
                                <td>{{$item->datetimeclick}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop    