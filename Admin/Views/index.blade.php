@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>サイトからのお知らせ</h2>
        <p class="date text-right">{{date('Y/m/d H:i')}} 時点</p>
        <div class="contents_box user_info">
            <h2>ユーザー情報</h2>
            <div class="body">
                <div class="info_table">
                    <table class="tb">
                        <tbody>
                            <tr>
                                <th style="width:15%;">状態</th>
                                <th style="width:15%;">ユーザー</th>
                                <th style="width:15%;">企業</th>
                                <th>説明</th>
                            </tr>
                            <tr>
                                <th>総登録数</th>
                                <td class="right"><a href="{{route('admin.nUser')}}">{{$userc['user']}}人</a></td>
                                <td class="right"><a href="{{route('admin.cUser')}}">{{$userc['business']}}人</a></td>
                                <td>ユーザーの総登録数</td>
                            </tr>
                            <tr>
                                <th>仮登録</th>
                                <td class="right"><a href="{{route('admin.nUser')}}?confirmed%5B%5D=0">{{$userc['user_t']}}人</a></td>
                                <td class="right"><a href="{{route('admin.cUser')}}confirmed%5B%5D=0">{{$userc['business_t']}}人</a></td>
                                <td>登録完了メールに記載されているURL未クリック</td>
                            </tr>
                            <tr>
                                <th>利用中</th>
                                <td class="right"><a href="{{route('admin.nUser')}}?confirmed%5B%5D=1">{{$userc['user_p']}}人</a></td>
                                <td class="right"><a href="{{route('admin.cUser')}}?confirmed%5B%5D=1">{{$userc['business_p']}}人</a></td>
                                <td>サービスを利用可能なユーザー</td>
                            </tr>
                            <tr>
                                <th>利用不可</th>
                                <td class="right"><a href="{{route('admin.nUser')}}?confirmed%5B%5D=2">{{$userc['user_d']}}人</a></td>
                                <td class="right"><a href="{{route('admin.cUser')}}?confirmed%5B%5D=2">{{$userc['business_d']}}人</a></td>
                                <td>サービスを利用不可能なユーザー</td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="sub_menu">
                        <li><a href="{{route('admin.nUser')}}">会員の管理</a></li>
                        <li><a href="{{route('admin.cUser')}}">企業の管理</a></li>
                    </ul>
                </div><!--info_table END-->
            </div>
        </div>
        <div class="contents_box item_info">
            <h2>広告情報</h2>
            <div class="body">
                <div class="info_table">
                    <p class="description">未確認の広告は必ずご確認ください</p>
                    <table class="tb">
                        <tbody>
                            <tr>
                                <th style="width:15%;">状態</th>
                                <th style="width:15%;">広告</th>
                                <th>説明</th>
                            </tr>
                            <tr>
                                <th>総登録数</th>
                                <td class="right"><a href="{{route('admin.ads')}}">{{$total}}</a></td>
                                <td>広告の総登録数</td>
                            </tr>
                            <tr>
                                <th>未確認</th>
                                <td class="right"><a href="{{route('admin.ads')}}?permission%5B%5D=0">{{$unconfirmed}}</a></td>
                                <td>掲載許可を受けていない広告</td>
                            </tr>
                            <tr>
                                <th>公開</th>
                                <td class="right"><a href="{{route('admin.ads')}}?permission%5B%5D=1&publish%5B%5D=1">{{$public}}</a></td>
                                <td>掲載中の広告</td>
                            </tr>
                            <tr>
                                <th>不許可</th>
                                <td class="right"><a href="{{route('admin.ads')}}?permission%5B%5D=2">{{$nolicense}}</a></td>
                                <td>掲載不許可の広告</td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="sub_menu">
                        <li><a href="search.php?type=items&amp;run=true">広告の管理</a></li>
                    </ul><!--sub_menu-->
                </div><!--info_table END-->
            </div>
        </div>
        <div class="contents_box item_info">
            <h2>広告成果</h2>
            <div class="body">
                <div class="info_table">
                    <table class="tb">
                        <tbody>
                            <tr>
                                <th style="width:15%;"></th>
                                <th style="width:35%;">期間</th>
                                <th style="width:35%;">請求額</th>
                            </tr>
                            <tr>
                                <th style="width:15%;"><a href="{{route('admin.MonthOwnerCount')}}?y={{date("Y", strtotime('last Months'))}}&m={{date("m", strtotime('last Months'))}}">先月</a></th>
                                <td style="width:35%;">{{date("Y年m月01日", strtotime('last Months'))}} 〜 {{date("Y年m月t日", strtotime('last Months'))}}</td>
                                <td class="right" style="width:35%;">{{$first_total}}円</td>
                            </tr>
                            <tr>
                                <th style="width:15%;"><a href="{{route('admin.MonthOwnerCount')}}?y={{date("Y")}}&m={{date("m")}}">今月</a></th>
                                <td style="width:35%;">{{date("Y年m月01日")}} 〜 {{date("Y年m月t日")}}</td>
                                <td class="right" style="width:35%;">{{$curent_total}}円</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                    <ul class="sub_menu">
                        <li><a href="{{route('admin.MonthOwnerCount')}}?y={{date("Y", strtotime('last Months'))}}&m={{date("m", strtotime('last Months'))}}">先月請求金額</a></li>
                        <li><a href="{{route('admin.MonthOwnerCount')}}?y={{date("Y")}}&m={{date("m")}}">今月請求金額</a></li>
                        <li><a href="{{route('admin.YearOwnerCount')}}">月別請求金額一覧</a></li>
                    </ul><!--sub_menu-->
                </div><!--info_table END-->
            </div>
        </div>
    </div>
</div>

@stop    