@extends('layouts.search')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 result_right">
                <div id="results">
                    <h2 id="counter_x">
                        <p>
                            お気に入りリスト
                        </p>
                    </h2>
                    @if($data->total())
                    <div id="result_list">
                        <ul>
                            <p>{{$data->total()}} 件</p>
                            @foreach($data as $item)
                                @php
                                    $kc = date('Y-m-d h:i:s',(strtotime(date('Y-m-d h:i:s')) - strtotime('2018-10-24 10:15:20')));
                                    $date1 = new DateTime(date('Y-m-d H:i:s'));
                                    $date2 = new DateTime($item->created_at);
                                    $interval = $date1->diff($date2);
                                    // dd($date2);
                                    if($interval->y > 0) $show = $interval->y . " 年前 ";
                                    else if($interval->m > 0) $show = $interval->m . " 月前 ";
                                    else if($interval->d > 0) $show = $interval->d . " 日前 ";
                                    else if($interval->h > 0) $show = $interval->h . " 時間前 ";
                                    else if($interval->i > 0) $show = $interval->i . " 分前 ";
                                    else  $show = $interval->s . " 秒前 ";
                                    if(stripos($item->url, 'suumo')) {
                                        $die = true;
                                        // $die = checkexit($item->url);
                                    }else{
                                        $die = true;
                                    }

                                @endphp
                                <li class="@if(!$die) die_link @endif">
                                    <p><a rel="nofollow" href="{{route('statistical',['id'=>$item->id])}}" target="_blank" class="title" title="{{$item->title}}">{{$item->title}}</a>
                                    @if(date('Y-m-d') == $item->date_order)
                                    <span class="news">新着物件 </span>
                                    @endif
                                    </p>
                                    <p>所在地:{{$item->address}}</p>
                                    <p>販売価格:{{$item->price_string}}｜沿線・駅:{{$item->traffic}}</p>
                                    <p>専有面積:{{$item->housearea_string}}｜間取り:{{$item->floor_map}}｜築年月:{{$item->date_string}}</p>
                                    <p>{{$item->about}}</p>
                                    <p>ジャンル:{{config('siteconfig.tag')[$item->tag]}}</p>
                                    <p>
                                        @php 
                                            $vt = strrpos($item->url, '.jp')+3;
                                            $home = substr($item->url, 0, $vt);
                                        @endphp
                                        {{$item->from_site}} -
                                        {{$show}} 
                                        @if(session('users'))

                                        <a class="heart bookmarks @if(count($item->bookmarks)) active @endif"  href="javascript:void(0)" data-id="{{$item->id}}">
                                            <span>お気に入り  </span><span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                        </a>
                                        @endif
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <p>Trang <b>{{$data->currentPage()}}</b> / <b>{{$data->lastPage()}}</b></p>
                    {{-- {{ $data->render() }} --}}
                    {{ $data->appends(request()->query())->links() }}
                    @else
                        <p>リストに追加された情報が見付かりませんでした。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@stop    
