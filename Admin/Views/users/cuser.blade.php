@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="contents_m">
            <h2>会員の管理</h2>
            <div class="main">
                <div class="search_table">
                    <form action="" method="GET">
                        <table class="tb">
                            <tbody>
                                <tr>
                                    <th style="width:15%;">ID</th>
                                    <td style="width:35%;">
                                        <input type="text" name="id" value="{{@request()->id}}" size="40" maxlength="256">
                                    </td>
                                    <th style="width:15%;">会社名</th>
                                    <td style="width:35%;">
                                        <input type="text" name="name" value="{{@request()->name}}" size="40" maxlength="256">
                                    </td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>
                                        <input type="text" name="email" value="{{@request()->email}}" size="40" maxlength="256">
                                    </td>
                                    <th>電話番号</th>
                                    <td>
                                        <input type="text" name="phone" value="{{@request()->phone}}" size="40" maxlength="256">
                                    </td>
                                </tr>
                                <tr>
                                    <th>アカウント状態</th>
                                    <td colspan="3">
                                        <label><input type="checkbox" name="confirmed[]" value="0" @if(@in_array(0, @request()->confirmed)) checked="checked" @endif>仮登録</label>
                                        <label><input type="checkbox" name="confirmed[]" value="1" @if(@in_array(1, @request()->confirmed)) checked="checked" @endif>利用中</label>
                                        <label><input type="checkbox" name="confirmed[]" value="2" @if(@in_array(2, @request()->confirmed)) checked="checked" @endif>利用不可</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="button"><input type="submit" value="検索する" class="btn_search"></p>
                    </form>
                </div>
                
                <div class="list_table clearfix mgt-30" id="list_table">
                    <div class="float-center">
                        {{ $cusers->appends(request()->query())->links() }}
                    </div>
                    <table class="tb table-striped">
                        <tbody>
                            <tr class="odd">
                                <th style="width:2%;" class="center">
                                    <input type="checkbox" name="idAll" value="idAll">
                                </th>
                                <th style="width:7%;">ID</a></th>
                                <th style="width:8%;">アカウント</a></th>
                                <th>会社名</a></th>
                                <th style="width:25%;">メールアドレス</th>
                                <th style="width:10%;">電話番号</th>
                                <th style="width:150px;">操作</th>
                            </tr>
                            @if($cusers)
                            @foreach($cusers as $key => $cuser)
                            <tr>
                                <td class="center">
                                    <label><input type="checkbox" name="id[]" value="{{$cuser->id}}" checked="checked"></label>
                                </td>
                                <td><span class="bold_black"><a href="{{route('admin.cUser')}}">{{$cuser->id}}</a></span></td>
                                <td>{{@config('siteconfig.permission')[$cuser->confirmed]}}</td>

                                <td>{{$cuser->name}}</td>
                                <td>{{$cuser->email}}</td>
                                <td>{{$cuser->phone}}</td>
                                <td>
                                    @if($cuser->confirmed == 1)
                                        <a href="{{route('admin.userLoginto', ['id'=>$cuser->id])}}" class="action_but" title="ログイン" href=""><i class="fa fa-lock" aria-hidden="true"></i></a>
                                    @else
                                        <a href="#" class="action_but" title="ログイン" href=""><i class="fa fa-lock" aria-hidden="true" disnable></i></a>
                                    @endif
                                    <a class="action_but" href="{{route('admin.cUserEdit', ['id'=>$cuser->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="action_but" onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admin.userDelete', ['id'=>$cuser->id])}}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                    <a class="action_but" href="{{route('admin.getcUserview', ['id'=>$cuser->id])}}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-center">
                        {{ $cusers->appends(request()->query())->links() }}
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