@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>{{$ads->title}}</h2>
        <ul class="sub_menu">
            <li><a href="{{ route('ads') }}">一覧</a></li>
            <li><a href="{{ route('editads',['id'=>$ads->id]) }}">編集</a></li>
        </ul>
        <table class="tb">
            <caption>入札</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">クリック単価</th>
                    <td class="">
                        {{@$ads->click_price}}
                        円
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">検索方法設定</th>
                    <td class="">
                        @if(@$ads->search_bg==1) 込む @else のみ @endif
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">サイトにある検索位置</th>
                    <td class="">
                        @if(@$ads->main_ads==1) ページ上部枠 @endif
                        @if(@$ads->main_ads && @$ads->fillter_ads) , @endif
                        @if(@$ads->fillter_ads==1) 詳細検索枠 @endif
                    </td>
                </tr>

            </tbody>
        </table>
        <table class="tb">
            <caption>広告情報</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">広告タイトル</th>
                    <td class="">
                        {{$ads->title}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">URL</th>
                    <td class="">
                        {{$ads->url}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">Sitename</th>
                    <td class="">
                        {{$ads->from_site}}
                    </td>
                </tr>
                <tr>
                    <th>はじめに</th>
                    <td class="">
                        {{$ads->about}}
                    </td>
                </tr>
                <tr>
                    <th>販売価格</th>
                    <td class="">
                        {{$ads->price}} 円 ～ {{$ads->price_to}} 円
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">沿線・駅</th>
                    <td class="">
                        {{$ads->traffic}}
                    </td>
                </tr>
                <tr>
                    <th>所在地</th>
                    <td class="">
                        【都道府県・市区町村】<br>
                        {{$ads->province->province_name}}
                        {{$ads->city->city_name}}<br>
                        【番地】<br>
                        {{$ads->address}}
                        <br>
                        【マンション・ビル名等】<br>
                        {{$ads->building}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">専有面積</th>
                    <td class="">
                        {{$ads->housearea}}m²
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">間取り</th>
                    <td class="">
                        {{$ads->floor_map}}
                    </td>
                </tr>
                <tr>
                    <th class="">カテゴリー</th>
                    <td class="">
                        {{config('siteconfig.cate')[$ads->cate]}}
                    </td>
                </tr>
                
                <tr>
                    <th class="">公開</th>
                    <td class="">
                        {{config('siteconfig.public')[$ads->publish]}}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@stop    

@section('script') 
    <script>
        $(document).ready(function(){
            var validateForm = $('#postaddads').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    url: {
                        required: true,
                    },
                    traffic: {
                        required: true,
                    },
                    province_id: {
                        required: true,
                    },
                    city_id: {
                        required: true,
                    },
                    cate: {
                        required: true,
                    },
                    publish: {
                        required: true,
                    },
                },

                messages: {
                    title: {
                        required: "広告タイトルが入力されていません"
                    },
                    url: {
                        required:  "URLが間違っています。",
                    },
                    traffic: {
                        required: "沿線・駅が入力されていません。"
                    },
                    province_id: {
                        required: "都道府県が入力されていません。"
                    },
                    city_id: {
                        required: '市区町村が選択されていません。',
                    },
                    cate: {
                        required: 'カテゴリーが選択されていません。',
                    },
                    publish: {
                        minlength: "パスワードは6文字以上で入力してください。",
                    },
                },
            });
        });

    </script>
@stop   