@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>会員の編集</h2>
            <div class="main">
                <div class="form_table">
                    {!! Form::open(['route' => ['admin.postnUserEdit', request()->id], 'id'=>'validateForm']) !!}
                        <!--▼編集フォーム-->
                        <table class="tb">
                            {{-- <caption>会員の登録</caption> --}}
                            <tbody>
                                <tr>
                                    <th style="width:250px">メールアドレス</th>
                                    <td class="">
                                        {{$nuser->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>パスワード</th>
                                    <td class="">
                                        ********
                                    </td>
                                </tr>
                                <tr>
                                    <th>パスワード（確認用）</th>
                                    <td class="">
                                        ********
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
                                        @if($nuser->notification == 1) 受信する @else 受信しない @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th>お得な情報を受信する</th>
                                    <td>
                                        @if($nuser->incentives == 1) 受信する @else 受信しない @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tb">
                            <caption>アカウント情報</caption>
                            <tbody>
                                <tr>
                                    <th style="width:250px;">アカウント状態</th>
                                    <td class="">
                                        @if($nuser->confirmed == 0) 仮登録 @elseif($nuser->confirmed == 1) 利用中 @else 利用不可 @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="data[email]" value="{{$nuser->email}}">
                        <input type="hidden" name="data[password]" value="{{$nuser->password}}">
                        <input type="hidden" name="data[notification]" value="{{$nuser->notification}}">
                        <input type="hidden" name="data[incentives]" value="{{$nuser->incentives}}">
                        <input type="hidden" name="data[confirmed]" value="{{$nuser->confirmed}}">

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
