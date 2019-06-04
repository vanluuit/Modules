@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>{{request()->y}}年 {{request()->m}}月 ： {{session('users')['companyname']}} ({{session('users')['id']}})</h2>
        <p class="date text-right">
            {!! Form::open(['route' => 'MonthOwnerCount', 'class'=>'float-right', 'method'=>'GET']) !!}
            <select name="y">
                <option value="">--</option>
                @for($i=date('Y')-8; $i<=date('Y'); $i++)
                    <option @if(request()->y==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                @endfor
            </select>年
            <select name="m">
                <option value="">--</option>
                @for($i=1; $i<=12; $i++)
                    @php ($i<10) ? $a = '0'.$i : $a = $i  @endphp
                    <option @if(request()->m==$a) selected="" @endif value="{{$a}}">{{$a}}</option>
                @endfor
            </select>月
            <input type="submit" value="変更">
            {!! Form::close() !!}
            <span class="float-right">年および月を変更すると、該当するデータに表示内容を切り替えることができます。</span>
        </p>
    </div>
    <div class="col-sm-12 mgt-40">
        <div id="mount_chart"></div>
    </div>
    <div class="col-sm-12">
        <p class="bold" style="color:red;">※チャートのポイントをクリックすると下に広告成果一覧が表示されます</p>
        <div class="list_table_lite">
            <table  class="tb">
                <caption>決済情報</caption>
                <tbody>
                    <tr>
                        <th>利用期間</th>
                        <td>
                            2019/01/01 ～ 2019/01/31
                        </td>
                    </tr>
                    <tr>
                        <th>請求予定日</th>
                        <td id="show_day">---</td>
                    </tr>
                    <tr>
                        <th>計上</th>
                        <td id="show_click">--</td>
                    </tr>
                    <tr>
                        <th>請求金額</th>
                        <td id="show_price">0 円</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-12">
        <ul class="sub_menu">
            <li id="show_all_btn" class="click_failure"><a href="#" onclick="showAllItemsList(&quot;show_all_btn&quot;, &quot;items_list&quot;, &quot;all_items_list&quot;); return false;">全体広告成果を表示</a></li>
        </ul>
        <div class="list_table_lite" id="all_items_list">
            <table class="tb">
                <caption>{{request()->y}}年 {{request()->m}}月 全体広告成果一覧</caption>
                <tbody>
                    <tr>
                        <th style="width:10%;">ID</th>
                        <th style="width:25%;">広告名</th>
                        <th style="width:15%;">クリック単価</th>
                        <th style="width:10%;">クリック回数</th>
                        <th style="width:30%;">請求金額</th>
                        <th style="width:150px;">操作</th>
                    </tr>
                    @if($ads_mounths)
                        @php
                            $click=0; $price=0;
                        @endphp
                        @foreach($ads_mounths as $key => $ads_mounth)
                            @php
                                $click +=count($ads_mounth->statistical);
                                $price +=count($ads_mounth->statistical)*$ads_mounth->click_price;
                            @endphp
                            <tr>
                                <td>{{$ads_mounth->id}}</td>
                                <td>{{$ads_mounth->title}}</td>
                                <td>{{$ads_mounth->click_price}}</td>
                                <td>{{count($ads_mounth->statistical)}}回</td>
                                <td>{{count($ads_mounth->statistical)*$ads_mounth->click_price}}円</td>
                                <td><a class="action_but" href="{{route('AdsStatistical')}}?y={{request()->y}}&m={{request()->m}}&ads={{$ads_mounth->id}}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <table class="tb">
                <tbody>
                    <tr>
                        <th style="width:50%;">合計</th>
                        <td style="width:10%;" class="right">{{$click}} 回</td>
                        <td style="width:30%;" class="right">{{$price}} 円</td>
                        <th></th>
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop    
@section('script') 
    <script>
        var arcl = "{{$arcl}}";
        var obj = JSON.parse(arcl.replace(/&quot;/g,'"'));
        Highcharts.chart('mount_chart', {
            credits: {
                enabled: false
            },
            title: {
                text: '{{request()->y}}年 {{request()->m}}月の広告成果 ： {{$total_price}}円／クリック回数 ： {{$total_click}} 回'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [{{$xAxis}}],
                title: {
                    text: '日数'
                },
            },
            yAxis: {
                title: {
                    text: '金額'
                },
                labels: {
                    format: '{value} 円'
                }
            },
            tooltip: {
                formatter: function () {
                    return ['<b>' + this.x + '</b>'].concat(
                        this.points.map(function (point) {
                            return '{{request()->y}}年{{request()->m}}月'+point.x+'日<br>広告成果 : ' + point.y + '円<br>クリック回数 : '+obj[point.x];
                        })
                    );
                },
                split: true
            },  

            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                $('#show_day').text('{{request()->y}}年{{request()->m}}月'+ this.category + '日');
                                $('#show_click').text(obj[this.category]+ '回');
                                $('#show_price').text(this.y + '円');
                            }
                        }
                    }
                }
            },

            series: [{
                name: '',
                data: [{{$yAxis}}],
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
@stop  