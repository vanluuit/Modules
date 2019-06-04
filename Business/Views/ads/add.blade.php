@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['route' => 'confadd', 'id'=>'postaddads']) !!}
        <h2>データの登録</h2>
        <table class="tb">
            <caption>入札</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">クリック単価</th>
                    <td class="">
                        <input type="number" name="data[click_price]" value="" size="5" maxlength="5">
                        円
                        <span class="hint">広告一覧で、上位 3 位までの広告を金額の高い順に掲載します</span>
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">検索方法設定</th>
                    <td class="">
                        <label><input type="checkbox" name="data[search_bg]" value="1" checked="checked">込む</label>
                        <label><input type="checkbox" name="data[search_bg]" value="0">のみ</label>
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">サイトにある検索位置</th>
                    <td class="">
                        <label><input type="checkbox" name="data[main_ads]" value="1">ページ上部枠</label>
                        <label><input type="checkbox" name="data[fillter_ads]" value="1">詳細検索枠</label>
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
                        <input type="text" name="data[title]" value="" size="80" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">URL<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="data[url]" value="" size="80 " maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">サイト名</th>
                    <td class="">
                        <input type="text" name="data[from_site]" value="" size="100" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th>はじめに<span class="requisite">必須</span></th>
                    <td class="">
                        <textarea name="data[about]" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>販売価格</th>
                    <td class="">
                        <input type="number" name="data[price]" value="" size="5" maxlength="5" min="0">
                        円 ～ <input type="number" name="data[price_to]" value="" size="5" min="0">
                        円
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">沿線・駅<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="data[traffic]" value="" size="100" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th>所在地<span class="requisite">必須</span></th>
                    <td class="">
                        {{-- 〒<input type="text" name="data[zip1]" value="" size="3" maxlength="3">
                        -<input type="text" name="data[zip2]" value="" size="4" maxlength="4">
                        <br> --}}
                        【都道府県・市区町村】<br>
                        {{Form::select('data[province_id]', $provinces, '', array('placeholder' => '未選択', 'id'=>'provincy_ajax'))}}
                        {{Form::select('data[city_id]', array(), '', array('placeholder' => '未選択', 'id'=>'city_ajax'))}}<br>
                        【番地】<br>
                        <input type="text" name="data[address]" value="" size="40" maxlength="256">
                        <br>
                        【マンション・ビル名等】<br>
                        <input type="text" name="data[building]" value="" size="40" maxlength="256">
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
                        <input type="text" name="data[housearea]" value="" size="30" maxlength="255">m²
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">間取り</th>
                    <td class="">
                        <input type="text" name="data[floor_map]" value="" size="30" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th style="width:220px;">築年月</th>
                    <td class="">
                        <input class="datepicker" type="text" name="data[date]" value="" size="30" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th class="">カテゴリー<span class="requisite">必須</span></th>
                    <td class="">
                        {{Form::select('data[cate]', config('siteconfig.cate'), '', array('placeholder' => '未選択'))}}
                    </td>
                </tr>
                
                <tr>
                    <th class="">公開<span class="requisite">必須</span></th>
                    <td class="">
                        <label><input type="radio" name="data[publish]" value="1" checked="checked">公開</label>
                        <label><input type="radio" name="data[publish]" value="0">非公開</label>
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
            var validateForm = $('#postaddads').validate({
                rules: {
                    'data[title]': {
                        required: true,
                    },
                    'data[url]': {
                        required: true,
                    },
                    'data[traffic]': {
                        required: true,
                    },
                    'data[province_id]': {
                        required: true,
                    },
                    'data[city_id]': {
                        required: true,
                    },
                    'data[cate]': {
                        required: true,
                    },
                    'data[publish]': {
                        required: true,
                    },
                },

                messages: {
                    'data[title]': {
                        required: "広告タイトルが入力されていません"
                    },
                    'data[url]': {
                        required:  "URLが間違っています。",
                    },
                    'data[traffic]': {
                        required: "沿線・駅が入力されていません。"
                    },
                    'data[province_id]': {
                        required: "都道府県が入力されていません。"
                    },
                    'data[city_id]': {
                        required: '市区町村が選択されていません。',
                    },
                    'data[cate]': {
                        required: 'カテゴリーが選択されていません。',
                    },
                    'data[publish]': {
                        minlength: "パスワードは6文字以上で入力してください。",
                    },
                },
            });
        });

    </script>
@stop   