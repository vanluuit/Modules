@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>広告情報</h2>
        <p class="date text-right">{{date('Y/m/d H:i')}} 時点</p>
        <table class="tb">
            <tbody>
                <tr>
                    <th style="width:15%;">状態</th>
                    <th style="width:15%;">広告</th>
                    <th>説明</th>
                </tr>
                <tr>
                    <th>総登録数</th>
                    <td class="right"><a href="{{route('ads')}}">{{$total}}</a></td>
                    <td>広告の総登録数</td>
                </tr>
                <tr>
                    <th>未確認</th>
                    <td class="right"><a href="{{route('ads')}}?permission%5B%5D=0">{{$unconfirmed}}</a></td>
                    <td>掲載許可を受けていない広告</td>
                </tr>
                <tr>
                    <th>公開</th>
                    <td class="right"><a href="{{route('ads')}}?permission%5B%5D=1&publish%5B%5D=1">{{$public}}</a></td>
                    <td>掲載中の広告</td>
                </tr>
                <tr>
                    <th>不許可</th>
                    <td class="right"><a href="{{route('ads')}}?permission%5B%5D=2">{{$nolicense}}</a></td>
                    <td>掲載不許可の広告</td>
                </tr>
            </tbody>
        </table>
        <h2>広告成果</h2>
        <table class="tb">
            <tbody>
                <tr>
                    <th style="width:15%;"></th>
                    <th style="width:35%;">期間</th>
                    <th style="width:35%;">請求額</th>
                </tr>
                <tr>
                    <th style="width:15%;"><a href="{{route('MonthOwnerCount')}}?y={{date("Y", strtotime('last Months'))}}&m={{date("m", strtotime('last Months'))}}">先月</a></th>
                    <td style="width:35%;">{{date("Y年m月01日", strtotime('last Months'))}} 〜 {{date("Y年m月t日", strtotime('last Months'))}}</td>
                    <td class="right" style="width:35%;">{{$first_total}}円</td>
                </tr>
                <tr>
                    <th style="width:15%;"><a href="{{route('MonthOwnerCount')}}?y={{date("Y")}}&m={{date("m")}}">今月</a></th>
                    <td style="width:35%;">{{date("Y年m月01日")}} 〜 {{date("Y年m月t日")}}</td>
                    <td class="right" style="width:35%;">{{$curent_total}}円</td>
                </tr>
            </tbody>
        </table>
        <ul class="sub_menu">
            {{-- <li><a href="./search.php?target_owner=C0000002&amp;target_owner_PAL=match+comp&amp;type=advertise_log&amp;run=true&amp;group=items&amp;regist_yearA=2019&amp;regist_monthA=1&amp;regist_dayA=1&amp;regist_yearB=2019&amp;regist_monthB=1&amp;regist_dayB=31">請求金額検索</a></li> --}}
            <li><a href="{{route('MonthOwnerCount')}}?y={{date("Y", strtotime('last Months'))}}&m={{date("m", strtotime('last Months'))}}">先月請求金額</a></li>
            <li><a href="{{route('MonthOwnerCount')}}?y={{date("Y")}}&m={{date("m")}}">今月請求金額</a></li>
            <li><a href="{{route('YearOwnerCount')}}">月別請求金額一覧</a></li>
        </ul>
    </div>
</div>

@stop    