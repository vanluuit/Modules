@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:30px;">
        <h2>求人広告の管理</h2>
        <ul class="sub_menu">
            <li><a href="{{ route('admin.addads') }}">広告を登録する</a></li>
        </ul>

        <form action="" method="GET">
        <table class="tb">
            <tbody>
                <tr>
                    <th style="width:15%;">キーワード検索</th>
                    <td colspan="3">
                        <input type="text" name="keyword" value="{{@request()->keyword}}" id="name" placeholder="キーワード" size="100" maxlength="120">
                    </td>
                </tr>
                <tr>
                    <th style="width:15%;">広告ID</th>
                    <td style="width:35%;">
                        <input type="text" name="id" value="{{@request()->id}}" size="30" maxlength="256">
                    </td>
                    <th style="width:15%;">広告名</th>
                    <td style="width:35%;">
                        <input type="text" name="title" value="{{@request()->title}}" size="30" maxlength="256">
                    </td>
                </tr>
                <tr>
                    <th>企業ID</th>
                    <td>
                        <input type="text" name="user_id" value="{{@request()->user_id}}" size="30" maxlength="256">
                    </td>
                    <th>企業名</th>
                    <td class="td2">
                        <input type="text" name="user_name" value="{{@request()->user_name}}" size="30" maxlength="256">
                    </td>
                </tr>
                <tr>
                    <th>日程</th>
                    <td colspan="3">
                        <select name="date_yearA">
                            <option value="">----</option>
                            @for($i = 2016; $i<2022; $i++)
                                <option value="{{$i}}" @if( @request()->date_yearA == $i ) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>年
                        <select name="date_monthA">
                            <option value="">----</option>
                            @for($i = 1; $i<13; $i++)
                                <option value="{{$i}}" @if(@request()->date_monthA == $i) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>月
                        <select name="date_dayA">
                            <option value="">----</option>
                            @for($i = 1; $i<31; $i++)
                                <option value="{{$i}}" @if(@request()->date_dayA == $i) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>日
                        　～　
                        <select name="date_yearB">
                            <option value="">----</option>
                            @for($i = 2016; $i<2022; $i++)
                                <option value="{{$i}}" @if(@request()->date_yearA == $i) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>年
                        <select name="date_monthB">
                            <option value="">----</option>
                            @for($i = 1; $i<13; $i++)
                                <option value="{{$i}}" @if(@request()->date_monthB == $i) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>月
                        <select name="date_dayB">
                            <option value="">----</option>
                            @for($i = 1; $i<31; $i++)
                                <option value="{{$i}}" @if(@request()->date_dayB == $i) selected="selected" @endif >{{$i}}</option>
                            @endfor
                        </select>日
                    </td>
                </tr>
                <tr>
                    <th style="width:15%;">掲載許可</th>
                    <td style="width:35%;">
                        <label><input type="checkbox" name="permission[]" value="0" @if(@in_array(0, @request()->permission)) checked="checked" @endif>未確認</label>
                        <label><input type="checkbox" name="permission[]" value="1" @if(@in_array(1, @request()->permission)) checked="checked" @endif>許可</label>
                        <label><input type="checkbox" name="permission[]" value="2" @if(@in_array(2, @request()->permission)) checked="checked" @endif>不許可</label>
                    </td>
                    <th style="width:15%;">公開</th>
                    <td style="width:35%;">
                        <label><input type="checkbox" name="publish[]" value="1"  @if(@in_array(1, @request()->publish)) checked="checked" @endif >公開</label>
                        <label><input type="checkbox" name="publish[]" value="0"  @if(@in_array(0, @request()->publish)) checked="checked" @endif >非公開</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="button"><input type="submit" value="検索する" class="btn_search"></p>
        </form>
    </div>
    <div class="col-sm-12">
        @if($ads)
        <div class="float-center">
            {{ $ads->appends(request()->query())->links() }}
        </div>
        <table class="tb">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>掲載許可<br>公開</th>
                    <th>広告タイトル</th>
                    <th>所在地</th>
                    <th>入札金額(円)</th>
                    <th>広告掲載地域</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ads as $item)
                    <tr>
                        <td><a href="{{route('admin.viewads',['id'=>$item->id])}}">{{$item->id}}</a></td>
                        <td>{{config('siteconfig.permission')[$item->permission]}}<br>{{config('siteconfig.public')[$item->publish]}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->province->province_name}}{{$item->city->city_name}}{{$item->address}}{{$item->building}}</td>
                        <td>{{$item->click_price}}</td>
                        <td>{{$item->province->province_name}}{{$item->city->city_name}}</td>
                        <td>
                            <a class="action_but" href="{{route('admin.editads',['id'=>$item->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            
                            <a class="action_but" onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admin.adsDelete', ['id'=>$item->id])}}"><i class="fa fa-remove" aria-hidden="true"></i></a>

                            <a class="action_but" href="{{route('admin.viewads',['id'=>$item->id])}}"><i class="fa fa-search" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="float-center">
            {{ $ads->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

@stop    