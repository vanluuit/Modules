 @extends('layouts.search')
@section('content')
<style>
    span.news {
    color: red;
    background: #cbe6ed;
    margin-left: 10px;
    padding: 2px;
}
</style>

<section id="content" class="backgr">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="result_left row pc">
                    <a class="logo_s" href="/">家まとめ</a>
                    @if($location || $key)
                    <div class="filter-sidebar">
                        <form id="regForm" action="">
                            <h3>メールアラート登録</h3>
                            <div class="tab curent" id="cr1">キーワードで検索した条件の新着情報をメールで受け取る
                                <p><input class="form-control" type="text" name="email" placeholder="メールアドレス"></p>
                                <p><label class="error" for="" id="error-email-alert"></label></p>
                                <p>
                                    <button type="button" id="checkmailalert" class="btn btn-info" data-id="cr2">無料登録</button>
                                </p>
                            </div>
                            <div class="tab" id="cr2">メールアドレス：<b id="email_show"></b><br>サイトからのお知らせを受け取る
                                <p><label><input type="checkbox" name="notification" value="1" checked="checked">受信する</label></p>
                                <p>お得な情報を受け取る<br>
                                <label><input type="checkbox" name="incentives" value="1" checked="checked">受信する</label>
                                </p>
                                <p> この条件で登録しますがよろしいですか？</p>
                                <p>
                                    <input type="hidden" name="keyword_mail" value="{{$key}}">
                                    <input type="hidden" name="area_mail" value="{{$location}}">
                                    <button type="button" id="submit_alert" class="btn btn-info"  data-id="cr3">はい</button>
                                    <button type="button" id="prevBtn_alert" class="btn btn-info"  data-id="cr1">いいえ</button>
                                </p>
                            </div>

                            <div class="tab" id="cr3">
                                メールアドレス：<b id="email_show_suc"></b><br>
                                現在メールアラート認証メールを送信しています。
                            </div>
                        </form>
                        
                    </div>
                    @endif
                    <div class="filter-sidebar">
                        <form action="{{route('fillter')}}" method="GET" role="form" id="fillter_form_1">
                            <input type="hidden" name="search" value="{{@$key}}">
                            <input type="hidden" name="location" value="{{@$location}}">
                            <div class="form-group">
                                <h3>ジャンル</h3>
                                <ul class="cate_check_list">
                                    <li><label><input type="checkbox" name="tag[]" value="3" @if(@in_array('3', @request()->tag)) checked="" @endif >新築マンション</label></li>
                                    <li><label><input type="checkbox" name="tag[]" value="1" @if(@in_array('1', @request()->tag)) checked="" @endif >新築戸建て</label></li>
                                    <li><label><input type="checkbox" name="tag[]" value="4" @if(@in_array('4', @request()->tag)) checked="" @endif >中古マンション</label></li>
                                    <li><label><input type="checkbox" name="tag[]" value="2" @if(@in_array('2', @request()->tag)) checked="" @endif >中古戸建</label></li>
                                    <li><label><input type="checkbox" name="tag[]" value="5" @if(@in_array('5', @request()->tag)) checked="" @endif >土地</label></li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <h3>価格</h3>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <select class="form-control" name="price_from">
                                            <option value="0">下限なし</option>
                                             @for($i=500; $i<=9000; $i +=500)
                                            <option value="{{$i*10000}}" @if(@request()->price_from == $i*10000) selected="" @endif >{{$i}}万円</option>
                                            @endfor
                                            <option value="100000000"  @if(@request()->price_from == 100000000) selected="" @endif >1億円</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control" name="price_to">
                                            <option value="0">上限なし</option>
                                            @for($i=500; $i<=9000; $i +=500)
                                            <option value="{{$i*10000}}" @if(@request()->price_to == $i*10000) selected="" @endif >{{$i}}万円</option>
                                            @endfor
                                            <option value="100000000"  @if(@request()->price_to == 100000000) selected="" @endif >1億円</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h3>専有面積</h3>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <select class="form-control" name="housearea_from">
                                            <option value="0">下限なし</option>
                                            @for($i=10; $i<=200; $i +=5)
                                            <option value="{{$i}}" @if(@request()->housearea_from == $i) selected="" @endif >{{$i}}m²</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control" name="housearea_to">
                                            <option value="0">上限なし</option>
                                            @for($i=10; $i<=200; $i +=5)
                                            <option value="{{$i}}" @if(@request()->housearea_to == $i) selected="" @endif >{{$i}}m²</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h3>間取り</h3>
                                <ul class="checkList multi">
                                    <li><label><input type="checkbox" name="floor_map[]" value="ワンルーム" @if(@in_array('ワンルーム', @request()->floor_map)) checked="" @endif >ワンルーム</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="1K" @if(@in_array('1K', @request()->floor_map)) checked="" @endif >1K</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="1DK" @if(@in_array('1DK', @request()->floor_map)) checked="" @endif >1DK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="1LDK" @if(@in_array('1LDK', @request()->floor_map)) checked="" @endif >1LDK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="2K" @if(@in_array('2K', @request()->floor_map)) checked="" @endif >2K</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="2DK" @if(@in_array('2DK', @request()->floor_map)) checked="" @endif >2DK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="2LDK" @if(@in_array('2LDK', @request()->floor_map)) checked="" @endif >2LDK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="3K" @if(@in_array('3K', @request()->floor_map)) checked="" @endif >3K</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="3DK" @if(@in_array('3DK', @request()->floor_map)) checked="" @endif >3DK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="3LDK" @if(@in_array('3LDK', @request()->floor_map)) checked="" @endif >3LDK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="4K" @if(@in_array('4K', @request()->floor_map)) checked="" @endif >4K</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="4DK" @if(@in_array('4DK', @request()->floor_map)) checked="" @endif >4DK</label></li>
                                    <li><label><input type="checkbox" name="floor_map[]" value="4LDK以上" @if(@in_array('4LDK以上', @request()->floor_map)) checked="" @endif >4LDK以上</label></li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <h3>駅徒歩分</h3>
                                <select name="traffic" class="form-control">
                                    <option value="0">指定なし</option>
                                    <option value="1" @if(@request()->traffic == '1') selected="" @endif >1分以内</option>
                                    <option value="5" @if(@request()->traffic == '5') selected="" @endif >5分以内</option>
                                    <option value="7" @if(@request()->traffic == '7') selected="" @endif >7分以内</option>
                                    <option value="10" @if(@request()->traffic == '10') selected="" @endif>10分以内</option>
                                    <option value="15" @if(@request()->traffic == '15') selected="" @endif>15分以内</option>
                                    <option value="20" @if(@request()->traffic == '20') selected="" @endif>20分以内</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <h3>築年数</h3>
                                <select name="year" class="form-control">
                                    <option value="0">指定なし</option>
                                    <option value="1" @if(@request()->year == '1') selected="" @endif >新築・未入居</option>
                                    <option value="3" @if(@request()->year == '3') selected="" @endif >3年以内</option>
                                    <option value="5" @if(@request()->year == '5') selected="" @endif >5年以内</option>
                                    <option value="10" @if(@request()->year == '10') selected="" @endif >10年以内</option>
                                    <option value="15" @if(@request()->year == '15') selected="" @endif >15年以内</option>
                                    <option value="20" @if(@request()->year == '20') selected="" @endif >20年以内</option>
                                    <option value="25" @if(@request()->year == '25') selected="" @endif >25年以内</option>
                                    <option value="30" @if(@request()->year == '30') selected="" @endif >30年以内</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="text-center">
                                    <input value="検索" class="btn btn-default" type="submit" />
                                </p>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="result_right row">
                    <div id="search-box" class="pc">
                        <form action="{{route('fillter')}}" id="SearchSearchForm" method="get" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h3 class="title-search">キーワードから選ぶ</h3>
                                        <div class="form-group has-feedback has-search">
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            <input type="text" name="key" class="form-control" placeholder="マンション名など">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h3 class="title-search">地域から選ぶ</h3>
                                        <div class="form-group has-feedback has-search">
                                            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                                            <input type="text" name="location" class="form-control SearchLocation" placeholder="都道府県・市区町村・駅名">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p class="">
                                        <button style="margin-top:48px"  type="submit" class="btn btn-default btn-search_main">検索</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="sp">
                        <form action="{{route('fillter')}}" id="SearchSearchForm" method="get" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group search-bd-l">
                                        <div class="form-group has-feedback has-search">
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            <input type="text" name="key" class="form-control" placeholder="マンション名など">
                                        </div>
                                        <div class="form-group has-feedback has-search">
                                            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                                            <input type="text" name="location" class="form-control SearchLocation" placeholder="都道府県・市区町村・駅名">
                                        </div>
                                        <button type="submit" class="btn btn-default btn-search_main">検索</button>
                                    </div>
                                    <div role="tabpanel" class="tab_search">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#tab_1" aria-controls="tab_1" role="tab" data-toggle="tab">ジャンル</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab_2" aria-controls="tab_2" role="tab" data-toggle="tab">価格</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab_3" aria-controls="tab_3" role="tab" data-toggle="tab">専有面積</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab_4" aria-controls="tab_4" role="tab" data-toggle="tab">間取り</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab_5" aria-controls="tab_5" role="tab" data-toggle="tab">駅徒歩分</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab_6" aria-controls="tab_6" role="tab" data-toggle="tab">築年数</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tab_1">
                                                <div class="form-group">
                                                    <ul class="cate_check_list">
                                                        <li><label><input type="checkbox" name="tag[]" value="3" @if(@in_array('3', @request()->tag)) checked="" @endif >新築マンション</label></li>
                                                        <li><label><input type="checkbox" name="tag[]" value="1" @if(@in_array('1', @request()->tag)) checked="" @endif >新築戸建て</label></li>
                                                        <li><label><input type="checkbox" name="tag[]" value="4" @if(@in_array('4', @request()->tag)) checked="" @endif >中古マンション</label></li>
                                                        <li><label><input type="checkbox" name="tag[]" value="2" @if(@in_array('2', @request()->tag)) checked="" @endif >中古戸建</label></li>
                                                        <li><label><input type="checkbox" name="tag[]" value="5" @if(@in_array('5', @request()->tag)) checked="" @endif >土地</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_2">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <select class="form-control" name="price_from">
                                                                <option value="0">下限なし</option>
                                                                 @for($i=500; $i<=9000; $i +=500)
                                                                <option value="{{$i*10000}}" @if(@request()->price_from == $i*10000) selected="" @endif >{{$i}}万円</option>
                                                                @endfor
                                                                <option value="100000000"  @if(@request()->price_from == 100000000) selected="" @endif >1億円</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select class="form-control" name="price_to">
                                                                <option value="0">上限なし</option>
                                                                @for($i=500; $i<=9000; $i +=500)
                                                                <option value="{{$i*10000}}" @if(@request()->price_to == $i*10000) selected="" @endif >{{$i}}万円</option>
                                                                @endfor
                                                                <option value="100000000"  @if(@request()->price_to == 100000000) selected="" @endif >1億円</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <select class="form-control" name="housearea_from">
                                                                <option value="0">下限なし</option>
                                                                @for($i=10; $i<=200; $i +=5)
                                                                <option value="{{$i}}" @if(@request()->housearea_from == $i) selected="" @endif >{{$i}}m²</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select class="form-control" name="housearea_to">
                                                                <option value="0">上限なし</option>
                                                                @for($i=10; $i<=200; $i +=5)
                                                                <option value="{{$i}}" @if(@request()->housearea_to == $i) selected="" @endif >{{$i}}m²</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_4">
                                                <div class="form-group">
                                                    <ul class="checkList multi">
                                                        <li><label><input type="checkbox" name="floor_map[]" value="ワンルーム" @if(@in_array('ワンルーム', @request()->floor_map)) checked="" @endif >ワンルーム</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="1K" @if(@in_array('1K', @request()->floor_map)) checked="" @endif >1K</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="1DK" @if(@in_array('1DK', @request()->floor_map)) checked="" @endif >1DK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="1LDK" @if(@in_array('1LDK', @request()->floor_map)) checked="" @endif >1LDK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="2K" @if(@in_array('2K', @request()->floor_map)) checked="" @endif >2K</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="2DK" @if(@in_array('2DK', @request()->floor_map)) checked="" @endif >2DK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="2LDK" @if(@in_array('2LDK', @request()->floor_map)) checked="" @endif >2LDK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="3K" @if(@in_array('3K', @request()->floor_map)) checked="" @endif >3K</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="3DK" @if(@in_array('3DK', @request()->floor_map)) checked="" @endif >3DK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="3LDK" @if(@in_array('3LDK', @request()->floor_map)) checked="" @endif >3LDK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="4K" @if(@in_array('4K', @request()->floor_map)) checked="" @endif >4K</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="4DK" @if(@in_array('4DK', @request()->floor_map)) checked="" @endif >4DK</label></li>
                                                        <li><label><input type="checkbox" name="floor_map[]" value="4LDK以上" @if(@in_array('4LDK以上', @request()->floor_map)) checked="" @endif >4LDK以上</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_5">
                                                <div class="form-group">
                                                    <select name="traffic" class="form-control">
                                                        <option value="0">指定なし</option>
                                                        <option value="1" @if(@request()->traffic == '1') selected="" @endif >1分以内</option>
                                                        <option value="5" @if(@request()->traffic == '5') selected="" @endif >5分以内</option>
                                                        <option value="7" @if(@request()->traffic == '7') selected="" @endif >7分以内</option>
                                                        <option value="10" @if(@request()->traffic == '10') selected="" @endif>10分以内</option>
                                                        <option value="15" @if(@request()->traffic == '15') selected="" @endif>15分以内</option>
                                                        <option value="20" @if(@request()->traffic == '20') selected="" @endif>20分以内</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_6">
                                                <div class="form-group">
                                                    <select name="year" class="form-control">
                                                        <option value="0">指定なし</option>
                                                        <option value="1" @if(@request()->year == '1') selected="" @endif >新築・未入居</option>
                                                        <option value="3" @if(@request()->year == '3') selected="" @endif >3年以内</option>
                                                        <option value="5" @if(@request()->year == '5') selected="" @endif >5年以内</option>
                                                        <option value="10" @if(@request()->year == '10') selected="" @endif >10年以内</option>
                                                        <option value="15" @if(@request()->year == '15') selected="" @endif >15年以内</option>
                                                        <option value="20" @if(@request()->year == '20') selected="" @endif >20年以内</option>
                                                        <option value="25" @if(@request()->year == '25') selected="" @endif >25年以内</option>
                                                        <option value="30" @if(@request()->year == '30') selected="" @endif >30年以内</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div id="results">
                        <div id="counter">
                            <p>
                                Page {{$data->currentPage()}} of {{$data->lastPage()}}, showing 30 records out of {{$data->total()}} total, starting on record 1, ending on 30
                            </p>
                        </div>
                        <div id="result_list">
                            <ul>
                                <p>{{$data->total()}} 件</p>
                                @foreach($ads as $ad)
                                    @php
                                        $date1 = new DateTime(date('Y-m-d H:i:s'));
                                        $date2 = new DateTime($ad->created_at);
                                        $interval = $date1->diff($date2);
                                        // dd($date2);
                                        if($interval->y > 0) $show = $interval->y . " 年前 ";
                                        else if($interval->m > 0) $show = $interval->m . " 月前 ";
                                        else if($interval->d > 0) $show = $interval->d . " 日前 ";
                                        else if($interval->h > 0) $show = $interval->h . " 時間前 ";
                                        else if($interval->i > 0) $show = $interval->i . " 分前 ";
                                        else  $show = $interval->s . " 秒前 ";
                                        if(stripos($ad->url, 'suumo')) {
                                            $die = true;
                                            // $die = checkexit($ad->url);
                                        }else{
                                            $die = true;
                                        }

                                    @endphp
                                    <li class="@if(!$die) die_link @endif">
                                        <p><a rel="nofollow" href="{{route('statisticalads',['id'=>$ad->id])}}" target="_blank" class="title ads" title="{{$ad->title}}">{{$ad->title}}</a>
                                        @if(date('Y-m-d') == $ad->order_time)
                                        <span class="news">新着物件 </span>
                                        @endif
                                        </p>
                                        <p>所在地:{{$ad->address}}</p>
                                        <p>販売価格:{{$ad->price}}円～{{$ad->price_to}}円｜沿線・駅:{{$ad->traffic}}</p>
                                        <p>専有面積:{{$ad->housearea}}m²｜間取り:{{$ad->floor_map}}｜築年月:{{$ad->date_string}}</p>
                                        <p>{{$ad->about}}</p>
                                        <p>ジャンル:{{@config('siteconfig.tag')[$ad->tag]}}</p>
                                        <p>
                                            {{$ad->from_site}} -
                                            {{$show}} 
                                           {{--  @if(session('users') && session('roles')==1)
                                                <a class="heart bookmarks @if(count($ad->bookmarks)) active @endif"  href="javascript:void(0)" data-id="{{$ad->id}}">
                                                    <span>お気に入り  </span><span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                                </a>
                                            @endif --}}
                                        </p>
                                    </li>
                                @endforeach

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
                                        @if(date('Y-m-d') == $item->order_time)
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
                                            @if(session('users') && session('roles')==1)
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop  
@section('script')
    <script>
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        $(document).on('click','#checkmailalert', function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            var email = $(this).closest('form').find('input[name="email"]').val();
            if(validateEmail(email)) {
                $.ajax({
                    url: "{{route('ajaxCheckUserExit')}}",
                    data: {_token: CSRF_TOKEN, email : email},
                    type: 'POST',
                    crossDomain: true,
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 'success') {
                            $('#email_show').text(data.mes);
                            $('.tab').removeClass('curent');
                            $('#'+id).addClass('curent');
                        }else{
                            $('#error-email-alert').html(data.mes);
                        }
                    }
                });
            }
        });
        $(document).on('click','#prevBtn_alert', function(){
            $('.tab').removeClass('curent');
            $('#cr1').addClass('curent');
        });
        $(document).on('click','#submit_alert', function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            var keyword_mail = $('#regForm input[name="keyword_mail"]').val();
            var area_mail = $('#regForm input[name="area_mail"]').val();
            if ($('#regForm input[name="incentives"]').is(':checked')) {var incentives = 1;}else{var incentives = 0;}
            if ($('#regForm input[name="notification"]').is(':checked')) {var notification = 1;}else{var notification = 0;}
            var email = $('#regForm input[name="email"]').val();
            if(validateEmail(email)) {
                $.ajax({
                    url: "{{route('ajaxReceiveMail')}}",
                    data: {_token: CSRF_TOKEN, email : email, incentives : incentives, notification : notification, keyword_mail : keyword_mail, area_mail : area_mail},
                    type: 'POST',
                    crossDomain: true,
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 'success') {
                            $('#email_show_suc').text(data.mes);
                            $('.tab').removeClass('curent');
                            $('#'+id).addClass('curent');
                        }else{
                            $('#error-email-alert').html(data.mes);
                        }
                    }
                });
            }
        });
    </script>
@stop 