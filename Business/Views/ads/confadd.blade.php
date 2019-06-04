@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['route' => 'postaddads', 'id'=>'postaddads']) !!}
        <h2>データの登録</h2>
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
                        {{@$ads->title}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">URL</th>
                    <td class="">
                        {{@$ads->url}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">Sitename</th>
                    <td class="">
                        {{@$ads->from_site}}
                    </td>
                </tr>
                <tr>
                    <th>はじめに</th>
                    <td class="">
                        {!! nl2br(@$ads->about) !!}
                    </td>
                </tr>
                <tr>
                    <th>販売価格</th>
                    <td class="">
                        {{@$ads->price}} 円 ～ {{@$ads->price_to}} 円
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">沿線・駅</th>
                    <td class="">
                        {{@$ads->traffic}}
                    </td>
                </tr>
                <tr>
                    <th>所在地</th>
                    <td class="">
                        【都道府県・市区町村】<br>
                        {{$provinces[@$ads->province_id]}}
                        {{$cities[@$ads->city_id]}}<br>
                        【番地】<br>
                        {{@$ads->address}}
                        <br>
                        【マンション・ビル名等】<br>
                        {{@$ads->building}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">専有面積</th>
                    <td class="">
                        {{@$ads->housearea}}m²
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">間取り</th>
                    <td class="">
                        {{@$ads->floor_map}}
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">築年月</th>
                    <td class="">
                        {{@$ads->date}}
                    </td>
                </tr>
                <tr>
                    <th class="">カテゴリー</th>
                    <td class="">
                        {{@config('siteconfig.cate')[@$ads->cate]}}
                    </td>
                </tr>
                
                <tr>
                    <th class="">公開</th>
                    <td class="">
                        {{@config('siteconfig.public')[@$ads->publish]}}
                    </td>
                </tr>

            </tbody>
        </table>
        <input type="hidden" name="data[click_price]" value="{{@$ads->click_price}}">
        <input type="hidden" name="data[search_bg]" value="{{@$ads->search_bg}}">
        <input type="hidden" name="data[main_ads]" value="{{@$ads->main_ads}}">
        <input type="hidden" name="data[fillter_ads]" value="{{@$ads->fillter_ads}}">
        <input type="hidden" name="data[title]" value="{{@$ads->title}}">
        <input type="hidden" name="data[url]" value="{{@$ads->url}}">
        <input type="hidden" name="data[from_site]" value="{{@$ads->from_site}}">
        <textarea class="hidden" name="data[about]">{{@$ads->about}}</textarea>
        <input type="hidden" name="data[price]" value="{{@$ads->price}}">
        <input type="hidden" name="data[price_to]" value="{{@$ads->price_to}}">
        <input type="hidden" name="data[traffic]" value="{{@$ads->traffic}}">
        <input type="hidden" name="data[province_id]" value="{{@$ads->province_id}}">
        <input type="hidden" name="data[city_id]" value="{{@$ads->city_id}}">
        <input type="hidden" name="data[address]" value="{{@$ads->address}}">
        <input type="hidden" name="data[building]" value="{{@$ads->building}}">
        <input type="hidden" name="data[housearea]" value="{{@$ads->housearea}}">
        <input type="hidden" name="data[floor_map]" value="{{@$ads->floor_map}}">
        <input type="hidden" name="data[date]" value="{{@$ads->date}}">
        <input type="hidden" name="data[cate]" value="{{@$ads->cate}}">
        <input type="hidden" name="data[publish]" value="{{@$ads->publish}}">
        <p class="button">
            <input type="button" value="戻る" onclick="window.history.back();" class="btn_back">
            <input type="submit" name="Submit" value="編集する" class="btn_edit">
        </p>
        {!! Form::close() !!}
    </div>
</div>

@stop 