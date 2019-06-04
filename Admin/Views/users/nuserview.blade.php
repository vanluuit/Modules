@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>(N{{$nuser->id}})</h2>
            <ul class="sub_menu">
                <li><a href="{{route('admin.nUser')}}">一覧</a></li>
                <li><a href="{{route('admin.nUserEdit', ['id'=>$nuser->id])}}">編集</a></li>
                <li><a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admin.userDelete', ['id'=>$nuser->id])}}">削除</a></li>
                @if($nuser->confirmed == 1)
                    <li><a href="{{route('admin.userLoginto', ['id'=>$nuser->id])}}">ログイン</a></li>
                @else
                    <li><a href="#" style="text-decoration: line-through;">ログイン</a></li>
                @endif
            </ul>
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
                    {!! Form::close() !!}
                </div>
                <!--form_table END-->
            </div>
            <!--main END-->
        </div>
    </div>
</div>

@stop    
