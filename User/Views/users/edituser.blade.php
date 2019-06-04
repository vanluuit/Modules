@extends('layouts.search')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="contents_m">    
                    <div class="contents_box">
                        <h2>会員の登録</h2>
                        <div class="main">  
                            <div class="form_table">
                                @if (@session('flash'))
                                    <p class="link-box {{ @session('flash')['class'] }}">
                                        {!! @session('flash')['mes'] !!}
                                    </p>
                                @endif
                                {!! Form::open(['route' => 'postedituser', 'id'=>'validateForm']) !!}
                                    <table>
                                        {{-- <caption>会員の登録</caption> --}}
                                        <tbody>
                                            <tr>
                                                <th>メールアドレス<span class="requisite">必須</span></th>
                                                <td class="">
                                                    <input type="text" name="email" size="40" maxlength="128" value="{{$user->email}}">
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
                                    <table>
                                        <caption>DMの受信設定</caption>
                                        <tbody>
                                            <tr>
                                                <th style="width:220px">サイトからのお知らせを受信する</th>
                                                <td>
                                                    <label><input type="radio" name="notification" value="1" @if($user->notification==1) checked="checked" @endif>受信する</label>
                                                    <label><input type="radio" name="notification" value="0" @if($user->notification==0) checked="checked" @endif>受信しない</label>
                                                    <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>お得な情報を受信する</th>
                                                <td>
                                                    <label><input type="radio" name="incentives" value="1"  @if($user->incentives==1) checked="checked" @endif>受信する</label>
                                                    <label><input type="radio" name="incentives" value="0" @if($user->incentives==0) checked="checked" @endif>受信しない</label>
                                                    <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
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
                    email: {
                        required: true,
                        email:true,
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
                    email: {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    },
                    password: {
                        minlength: "パスワードは6文字以上で入力してください。",
                        required:  "パスワードは6文字以上で入力してください。",
                    },
                    password_confirmation: {
                        required:  "確認用パスワードが一致していません。",
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