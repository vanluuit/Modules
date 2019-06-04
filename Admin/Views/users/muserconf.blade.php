@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>会員の編集</h2>
            <div class="main">
                <div class="form_table">
                    {!! Form::open(['route' => ['admin.postmUserEdit', request()->id], 'id'=>'validateForm']) !!}
                        <!--▼編集フォーム-->
                        <table class="tb">
                            {{-- <caption>会員の登録</caption> --}}
                            <tbody>
                                <tr>
                                    <th style="width:250px">メールアドレス<span class="requisite">必須</span></th>
                                    <td class="">
                                        {{$muser->email}}
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
                                        @if($muser->notification == 1) 受信する @else 受信しない @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th>お得な情報を受信する</th>
                                    <td>
                                        @if($muser->incentives == 1) 受信する @else 受信しない @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>強制送信除外</th>
                                    <td>
                                        @if($muser->confirmed == 1) 有効 @else 無効 @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="email" value="{{$muser->email}}">
                        <input type="hidden" name="notification" value="{{$muser->notification}}">
                        <input type="hidden" name="incentives" value="{{$muser->incentives}}">
                        <input type="hidden" name="confirmed" value="{{$muser->confirmed}}">
                        <p class="button">
                            <input type="button" value="戻る" onclick="window.history.back();" class="btn_back">
                            <input type="submit" name="Submit" value="編集する" class="btn_edit">
                        </p>
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
                    'email': {
                        required: true,
                        email:true,
                    }
                },

                messages: {
                    'email': {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    }
                highlight: function (e) {
                    $(e).closest('td').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('td').removeClass('has-error');//.addClass('has-info');
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is('input[type=checkbox') || element.is('input[type=radio')) {
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