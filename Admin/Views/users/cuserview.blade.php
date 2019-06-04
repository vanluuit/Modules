@extends('layouts.admin')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-2">
                <div class="contents_m">    
                    <div class="contents_box">
                        <h2>C({{$cuser->id}})</h2>
                        <ul class="sub_menu">
                            <li><a href="{{route('admin.cUser')}}">一覧</a></li>
                            <li><a href="{{route('admin.cUserEdit', ['id'=>$cuser->id])}}">編集</a></li>
                            <li><a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admin.userDelete', ['id'=>$cuser->id])}}">削除</a></li>
                            @if($cuser->confirmed == 1)
                                <li><a href="{{route('admin.userLoginto', ['id'=>$cuser->id])}}">ログイン</a></li>
                            @else
                                <li><a href="#" style="text-decoration: line-through;">ログイン</a></li>
                            @endif
                        </ul>
                        <div class="main">
                            <div class="form_table">
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
