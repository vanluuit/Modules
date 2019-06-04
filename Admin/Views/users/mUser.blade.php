@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>非会員ユーザーの管理</h2>
            <div class="main">
                <div class="search_table">
                    <form action="" method="GET">
                        <table class="tb">
                            <tbody>
                                <tr>
                                    <th style="width:20%;">お得な情報メール</th>
                                    <td>
                                        <label><input type="checkbox" name="notification[]" value="1"  @if(@in_array(1, @request()->notification)) checked="checked" @endif>受信する</label>
                                        <label><input type="checkbox" name="notification[]" value="0"  @if(@in_array(0, @request()->notification)) checked="checked" @endif>受信しない</label>
                                    </td>
                                    <th style="width:20%;">お知らせメール</th>
                                    <td>
                                        <label><input type="checkbox" name="incentives[]" value="1" @if(@in_array(1, @request()->incentives)) checked="checked" @endif>受信する</label>
                                        <label><input type="checkbox" name="incentives[]" value="0" @if(@in_array(0, @request()->incentives)) checked="checked" @endif>受信しない</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:20%;">ID</th>
                                    <td>
                                        <input type="text" name="id" value="{{@request()->id}}" placeholder="ID" size="28" maxlength="64">
                                    </td>
                                    <th style="width:20%;">メールアドレス</th>
                                    <td>
                                        <input type="text" name="email" value="{{@request()->email}}" placeholder="メールアドレス" size="28" maxlength="64">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="button"><input type="submit" value="検索する" class="btn_search"></p>
                    </form>
                </div>
                
                <div class="list_table clearfix mgt-30" id="list_table">
                    <div class="float-center">
                        {{ $musers->appends(request()->query())->links() }}
                    </div>
                    <table class="tb table-striped">
                        <tbody>
                            <tr class="odd">
                                <th style="width:5%;" class="center">
                                    <input type="checkbox" name="idAll" value="idAll">
                                </th>
                                <th style="width:10%;">ID</a></th>
                                <th style="width:25%;">メールアドレス</a></th>
                                <th style="width:15%;">お得な情報メール</th>
                                <th style="width:15%;">お知らせメール</th>
                                <th style="width:15%;">強制送信除外</th>
                                <th style="width:100px;">操作</th>
                            </tr>
                            @if($musers)
                            @foreach($musers as $key => $muser)
                            <tr>
                                <td class="center">
                                    <label><input type="checkbox" name="id[]" value="{{$muser->id}}" checked="checked"></label>
                                </td>
                                <td><span class="bold_black">M({{$muser->id}})</span></td>
                                <td>{{$muser->email}}</td>
                                <td> @if($muser->notification == 1) 受信する @else 受信しない @endif</td>
                                <td> @if($muser->incentives == 1) 受信する @else 受信しない @endif</td>
                                <td> @if($muser->confirmed == 0) 有効 @else 無効 @endif</td>
                                <td>
                                    <a class="action_but" href="{{route('admin.mUserEdit', ['id'=>$muser->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="action_but" onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admin.userDelete', ['id'=>$muser->id])}}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-center">
                        {{ $musers->appends(request()->query())->links() }}
                    </div>
                </div>

                <!--list_table END-->
                {{-- <div>
                    <h2>DM配信リストへの追加</h2>
                    <p class="description">
                        検索結果のユーザー情報でDM配信リストを作成するには、「<a href="search.php?type=list&amp;run=true">DM配信リストの管理</a>」で予めDM配信リストを作成し下記フォームで指定します。<br>
                        ユーザーを個別に選択するなどして、さらに細かく対象を選定する場合は検索結果の各ユーザー情報ごとのチェックボックスを選択して設定して下さい。
                    </p>
                </div> --}}
            </div>
            <!--main END-->
        </div>
    </div>
</div>

@stop    