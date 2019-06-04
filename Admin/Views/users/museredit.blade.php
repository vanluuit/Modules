@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>会員の編集</h2>
            <div class="main">
                <div class="form_table">
                    {!! Form::open(['route' => ['admin.postmUserConfirm', request()->id], 'id'=>'validateForm']) !!}
                        <!--▼編集フォーム-->
                        <table class="tb">
                            {{-- <caption>会員の登録</caption> --}}
                            <tbody>
                                <tr>
                                    <th style="width:250px">メールアドレス<span class="requisite">必須</span></th>
                                    <td class="">
                                        <input type="text" name="email" value="{{$muser->email}}" size="40" maxlength="128">
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
                                        <label><input type="radio" name="notification" value="1" @if($muser->notification == 1) checked="checked" @endif >受信する</label>
                                        <label><input type="radio" name="notification" value="0"  @if($muser->notification == 0) checked="checked" @endif >受信しない</label>
                                        <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>お得な情報を受信する</th>
                                    <td>
                                        <label><input type="radio" name="incentives" value="1"  @if($muser->incentives == 1) checked="checked" @endif >受信する</label>
                                        <label><input type="radio" name="incentives" value="0" @if($muser->incentives == 0) checked="checked" @endif >受信しない</label>
                                        <span class="hint">※会員登録後もこちらの設定は変更することが出来ます。</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>強制送信除外</th>
                                    <td>
                                        <label><input type="radio" name="confirmed" value="1" @if($muser->confirmed == 1) checked="checked" @endif >有効 </label>
                                        <label><input type="radio" name="confirmed" value="0" @if($muser->confirmed == 0) checked="checked" @endif >無効</label>
                                        <span class="hint">※有効に設定している間、このユーザーへのDMは送信されません。</span>
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
                    'email]': {
                        required: true,
                        email:true,
                    }
                },

                messages: {
                    'email]': {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    }
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