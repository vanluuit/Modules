@extends('layouts.admin')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="contents_m">    
                    <div class="contents_box">
                        <h2>企業の登録</h2>
                        <div class="main">
                            <div class="form_table">
                                {!! Form::open(['route' => ['admin.postcUserConfirm', request()->id], 'id'=>'validateForm']) !!}
                                    <!--▼登録フォーム-->
                                    <table class="tb">
                                        <caption>企業情報</caption>
                                        <tbody>
                                            <tr>
                                                <th style="width:250px;">会社名<span class="requisite">必須</span></th>
                                                <td class=" ">
                                                    <input type="text" name="name" value="{{$cuser->name}}" size="40" maxlength="128">
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>メールアドレス<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <input type="text" name="email" value="{{$cuser->email}}" size="40" maxlength="128">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>電話番号<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <input type="text" name="phone" value="{{$cuser->phone}}" size="32" maxlength="64">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>FAX番号</th>
                                                <td class="">
                                                    <input type="text" name="fax" value="{{$cuser->fax}}" size="32" maxlength="64">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>所在地<span class="requisite">必須</span></th>
                                                <td class="">
                                                    〒<input type="text" name="zip1" value="{{$cuser->zip1}}" size="3" maxlength="3">
                                                    -<input type="text" name="zip2" value="{{$cuser->zip2}}" size="4" maxlength="4">
                                                    <br>
                                                    【都道府県・市区町村】<br>
                                                    {{Form::select('province_id', $provinces, $cuser->province_id, array('placeholder' => '未選択', 'id'=>'provincy_ajax'))}}
                                                    {{Form::select('city_id', $cities, $cuser->city_id, array('placeholder' => '未選択', 'id'=>'city_ajax'))}}<br>
                                                    【番地】<br>
                                                    <input type="text" name="address" value="{{$cuser->address}}" size="40" maxlength="256">
                                                    <br>
                                                    【マンション・ビル名等】<br>
                                                    <input type="text" name="building" value="{{$cuser->building}}" size="40" maxlength="256">
                                                    <br>
                                                    <label id="zip1-error" class="error" for="zip1"></label>
                                                    <label id="zip2-error" class="error" for="zip2"></label>
                                                    <label id="provincy_ajax-error" class="error" for="provincy_ajax"></label>
                                                    <label id="city_ajax-error" class="error" for="city_ajax"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>パスワード<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <input type="password" name="password" id="password" size="30" maxlength="50">
                                                    <span class="hint">※ご希望の半角英数字6文字以上</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>パスワード（確認用）<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <input type="password" name="password_confirmation" size="30" maxlength="50">
                                                    <span class="hint">※上記と同じものを確認のために入力して下さい。</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="tb">
                                        <caption>DMの受信設定</caption>
                                        <tbody>
                                            <tr>
                                                <th style="width:250px">サイトからのお知らせを受信する</th>
                                                <td>
                                                    <label><input type="radio" name="notification" value="1" @if($cuser->notification == 1) checked="checked" @endif >受信する</label>
                                                    <label><input type="radio" name="notification" value="0"  @if($cuser->notification == 0) checked="checked" @endif >受信しない</label>
                                                    <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>お得な情報を受信する</th>
                                                <td>
                                                    <label><input type="radio" name="incentives" value="1"  @if($cuser->incentives == 1) checked="checked" @endif >受信する</label>
                                                    <label><input type="radio" name="incentives" value="0" @if($cuser->incentives == 0) checked="checked" @endif >受信しない</label>
                                                    <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="tb">
                                        <caption>アカウント情報</caption>
                                        <tbody>
                                            <tr>
                                                <th style="width:250px;">アカウント状態<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <label><input type="radio" name="confirmed" value="0" @if($cuser->confirmed == 0) checked="checked" @endif >仮登録</label>
                                                    <label><input type="radio" name="confirmed" value="1" @if($cuser->confirmed == 1) checked="checked" @endif >利用中</label>
                                                    <label><input type="radio" name="confirmed" value="2" @if($cuser->confirmed == 2) checked="checked" @endif >利用不可</label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="button"><input type="submit" name="Submit" value="確認する" class="btn_check"></p>
                                {!! Form::close() !!}
                            </div>
                            <!--form_table END-->
                        </div>
                        <!--main END-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop      
@section('script') 
    <script>
        $(document).ready(function(){

            var validateForm = $('#validateForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email:true,
                    },
                    tel: {
                        required: true,
                    },
                    zip1: {
                        required: true,
                    },
                    zip2: {
                        required: true,
                    },
                    province_id: {
                        required: true,
                    },
                    city_id: {
                        required: true,
                    },
                    password: {
                        minlength: 6,
                        required: true,
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    },
                },

                messages: {
                    name: {
                        required: "会社名が入力されていません"
                    },
                    email: {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    },
                    tel: {
                        required: "電話番号が入力されていません。"
                    },
                    zip1: {
                        required: "郵便番号(1)が入力されていません。"
                    },
                    zip2: {
                        required: "郵便番号(2)が入力されていません。"
                    },
                    province_id: {
                        required: '都道府県が選択されていません。',
                    },
                    city_id: {
                        required: '市区町村が選択されていません。',
                    },
                    password: {
                        minlength: "パスワードは6文字以上で入力してください。",
                        required:  "パスワードは6文字以上で入力してください。",
                    },
                    password_confirmation: {
                        equalTo:  "確認用パスワードが一致していません。",
                    },
                },
                highlight: function (e) {
                    $(e).closest('td').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('td').removeClass('has-error');//.addClass('has-info');
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                        var controls = element.closest('td');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else error.insertAfter(element);
                }
            });
        });

    </script>
@stop   