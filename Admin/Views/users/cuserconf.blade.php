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
                                {!! Form::open(['route' => ['admin.postcUserEdit', request()->id], 'id'=>'validateForm']) !!}
                                    <!--▼登録フォーム-->
                                    <table class="tb">
                                        <caption>企業情報</caption>
                                        <tbody>
                                            <tr>
                                                <th style="width:250px;">会社名<span class="requisite">必須</span></th>
                                                <td class=" ">
                                                    {{$cuser->name}}
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>メールアドレス<span class="requisite">必須</span></th>
                                                <td class="">
                                                    {{$cuser->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>電話番号<span class="requisite">必須</span></th>
                                                <td class="">
                                                    {{$cuser->phone}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>FAX番号</th>
                                                <td class="">
                                                    {{$cuser->phone}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>所在地<span class="requisite">必須</span></th>
                                                <td class="">
                                                    〒{{$cuser->zip1}}-{{$cuser->zip2}}
                                                    <br>
                                                    【都道府県・市区町村】<br>
                                                    {{$provinces[$cuser->province_id]}}
                                                    {{$cities[$cuser->city_id]}}
                                                    <br>
                                                    【番地】<br>
                                                    {{$cuser->address}}
                                                    <br>
                                                    【マンション・ビル名等】<br>
                                                    {{$cuser->building}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>パスワード<span class="requisite">必須</span></th>
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
                                                    @if($cuser->notification == 1) 受信する @else 受信しない @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>お得な情報を受信する</th>
                                                <td>
                                                    @if($cuser->incentives == 1) 受信する @else 受信しない @endif
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
                                                    @if($cuser->confirmed == 0) 仮登録 @elseif($cuser->confirmed == 1) 利用中 @else 利用不可 @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="email" value="{{$cuser->email}}">
                                    <input type="hidden" name="name" value="{{$cuser->name}}">
                                    <input type="hidden" name="phone" value="{{$cuser->phone}}">
                                    <input type="hidden" name="phone" value="{{$cuser->phone}}">
                                    <input type="hidden" name="zip1" value="{{$cuser->zip1}}">
                                    <input type="hidden" name="zip2" value="{{$cuser->zip2}}">
                                    <input type="hidden" name="province_id" value="{{$cuser->province_id}}">
                                    <input type="hidden" name="city_id" value="{{$cuser->city_id}}">
                                    <input type="hidden" name="address" value="{{$cuser->address}}">
                                    <input type="hidden" name="building" value="{{$cuser->building}}">
                                    <input type="hidden" name="password" value="{{$cuser->password}}">
                                    <input type="hidden" name="notification" value="{{$cuser->notification}}">
                                    <input type="hidden" name="incentives" value="{{$cuser->incentives}}">
                                    <input type="hidden" name="confirmed" value="{{$cuser->confirmed}}">
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
        </div>
    </div>
</section>
@stop      
