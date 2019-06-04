@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>会員の編集</h2>
            <div class="main">
                <div class="form_table">
                    {!! Form::open(['route' => ['admin.postnUserConfirm', request()->id], 'id'=>'validateForm']) !!}
                        <!--▼編集フォーム-->
                        <table class="tb">
                            {{-- <caption>会員の登録</caption> --}}
                            <tbody>
                                <tr>
                                    <th>メールアドレス<span class="requisite">必須</span></th>
                                    <td class="">
                                        <input type="text" name="data[email]" value="{{$nuser->email}}" size="40" maxlength="128">
                                    </td>
                                </tr>
                                <tr>
                                    <th>パスワード<span class="requisite">必須</span></th>
                                    <td class="">
                                        <input type="password" name="data[password]" id="password" size="30" maxlength="50">
                                        <span class="hint">※ご希望の半角英数字6文字以上</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>パスワード（確認用）<span class="requisite">必須</span></th>
                                    <td class="">
                                        <input type="password" name="data[password_confirmation]" size="30" maxlength="50">
                                        <span class="hint">※上記と同じものを確認のために入力して下さい。</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tb">
                            <caption>DMの受信設定</caption>
                            <tbody>
                                <tr>
                                    <th style="width:220px">サイトからのお知らせを受信する</th>
                                    <td>
                                        <label><input type="radio" name="data[notification]" value="1" @if($nuser->notification == 1) checked="checked" @endif >受信する</label>
                                        <label><input type="radio" name="data[notification]" value="0"  @if($nuser->notification == 0) checked="checked" @endif >受信しない</label>
                                        <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>お得な情報を受信する</th>
                                    <td>
                                        <label><input type="radio" name="data[incentives]" value="1"  @if($nuser->incentives == 1) checked="checked" @endif >受信する</label>
                                        <label><input type="radio" name="data[incentives]" value="0" @if($nuser->incentives == 0) checked="checked" @endif >受信しない</label>
                                        <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tb">
                            <caption>アカウント情報</caption>
                            <tbody>
                                <tr>
                                    <th style="width:220px;">アカウント状態<span class="requisite">必須</span></th>
                                    <td class="">
                                        <label><input type="radio" name="data[confirmed]" value="0" @if($nuser->confirmed == 0) checked="checked" @endif >仮登録</label>
                                        <label><input type="radio" name="data[confirmed]" value="1" @if($nuser->confirmed == 1) checked="checked" @endif >利用中</label>
                                        <label><input type="radio" name="data[confirmed]" value="2" @if($nuser->confirmed == 2) checked="checked" @endif >利用不可</label>
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

@stop    
@section('script') 
    <script>
        $(document).ready(function(){

            var validateForm = $('#validateForm').validate({
                rules: {
                    'data[email]': {
                        required: true,
                        email:true,
                    },
                    'data[password]': {
                        minlength: 6,
                        required: true,
                    },
                    'data[password_confirmation]': {
                        equalTo: "#password"
                    },
                },

                messages: {
                    'data[email]': {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    },
                    'data[password]': {
                        minlength: "パスワードは6文字以上で入力してください。",
                        required:  "パスワードは6文字以上で入力してください。",
                    },
                    'data[password_confirmation]': {
                        required:  "確認用パスワードが一致していません。",
                        equalTo: "確認用パスワードが一致していません。",
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