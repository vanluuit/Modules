@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['route' => ['admin.confedit', $ads->id], 'id'=>'posteditads']) !!}
        <input type="hidden" name="id" value="{{$ads->id}}">
        <h2>データの登録</h2>
        <table class="tb">
            <caption>入札</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">クリック単価</th>
                    <td class="">
                        <input type="number" name="data[click_price]" value="{{$ads->click_price}}" size="5" maxlength="5">
                        円
                        <span class="hint">広告一覧で、上位 3 位までの広告を金額の高い順に掲載します</span>
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">クリック単価</th>
                    <td class="">
                        <label><input type="radio" name="data[search_bg]" value="1" @if($ads->search_bg==1) checked="checked" @endif >込む</label>
                        <label><input type="radio" name="data[search_bg]" value="0" @if($ads->search_bg==0) checked="checked" @endif >のみ</label>
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">サイトにある検索位置</th>
                    <td class="">
                        <label><input type="checkbox" name="data[main_ads]" value="1" @if($ads->main_ads==1) checked="checked" @endif >ページ上部枠</label>
                        <label><input type="checkbox" name="data[fillter_ads]" value="1" @if($ads->fillter_ads==1) checked="checked" @endif >詳細検索枠</label>
                    </td>
                </tr>

            </tbody>
        </table>
        <table class="tb">
            <caption>広告情報</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">広告タイトル<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="data[title]" value="{{$ads->title}}" size="80" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">URL<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="data[url]" value="{{$ads->url}}" size="80 " maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">サイト名</th>
                    <td class="">
                        <input type="text" name="data[from_site]" value="{{$ads->from_site}}" size="100" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th>はじめに</th>
                    <td class="">
                        <textarea name="data[about]" cols="30" rows="5">{{$ads->about}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>販売価格</th>
                    <td class="">
                        <input type="number" name="data[price]" value="{{$ads->price}}" size="5">
                        円 ～ <input type="number" name="data[price_to]" value="{{$ads->price_to}}" size="5">
                        円
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">沿線・駅<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="data[traffic]" value="{{$ads->traffic}}" size="100" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th>所在地<span class="requisite">必須</span></th>
                    <td class="">
                        {{-- 〒<input type="text" name="data[zip1]" value="" size="3" maxlength="3">
                        -<input type="text" name="data[zip2]" value="" size="4" maxlength="4">
                        <br> --}}
                        【都道府県・市区町村】<br>
                        {{Form::select('data[province_id]', $provinces, $ads->province_id, array('placeholder' => '未選択', 'id'=>'provincy_ajax'))}}
                        {{Form::select('data[city_id]', $cities, $ads->city_id, array('placeholder' => '未選択', 'id'=>'city_ajax'))}}<br>
                        【番地】<br>
                        <input type="text" name="data[address]" value="{{$ads->address}}" size="40" maxlength="256">
                        <br>
                        【マンション・ビル名等】<br>
                        <input type="text" name="data[building]" value="{{$ads->building}}" size="40" maxlength="256">
                        <br>
                        {{-- <label id="zip1-error" class="error" for="zip1"></label>
                        <label id="zip2-error" class="error" for="zip2"></label> --}}
                        <label id="provincy_ajax-error" class="error" for="provincy_ajax"></label>
                        <label id="city_ajax-error" class="error" for="city_ajax"></label>
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">専有面積</th>
                    <td class="">
                        <input type="text" name="data[housearea]" value="{{$ads->housearea}}" size="30" maxlength="255">m²
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">間取り</th>
                    <td class="">
                        <input type="text" name="data[floor_map]" value="{{$ads->floor_map}}" size="30" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">築年月</th>
                    <td class="">
                        <input class="datepicker" type="text" name="data[date]" value="{{$ads->date}}" data-date-format="yyyy年mm月" size="30" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th class="">カテゴリー<span class="requisite">必須</span></th>
                    <td class=""> 
                        {{Form::select('data[cate]', config('siteconfig.cate'), $ads->cate, array('placeholder' => '---'))}}
                    </td>
                </tr>
                
                <tr>
                    <th class="">公開<span class="requisite">必須</span></th>
                    <td class="">
                        <label><input type="radio" name="data[publish]" value="1" @if($ads->publish==1) checked="checked" @endif >公開</label>
                        <label><input type="radio" name="data[publish]" value="0" @if($ads->publish==0) checked="checked" @endif >非公開</label>
                    </td>
                </tr>

            </tbody>
        </table>
        <table class="tb">
            <caption>掲載情報</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">掲載許可<span class="requisite">必須</span></th>
                    <td class="">
                        <label><input type="radio" name="permission" value="0" @if($ads->permission == 0) checked="checked" @endif >未確認</label>
                        <label><input type="radio" name="permission" value="1" @if($ads->permission == 1) checked="checked" @endif >許可</label>
                        <label><input type="radio" name="permission" value="2" @if($ads->permission == 2) checked="checked" @endif >不許可</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="button"><input type="submit" name="Submit" value="確認する" class="btn_check"></p>
        {!! Form::close() !!}
    </div>
</div>

@stop    

@section('script') 
    <script>
        $(document).ready(function(){
            var validateForm = $('#posteditads').validate({
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