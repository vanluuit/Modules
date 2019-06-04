@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>{{$y}}年 {{$m}}月 ： {{session('users')['companyname']}} ({{session('users')['id']}})</h2>
        <p class="date text-right">
            {!! Form::open(['route' => 'YearOwnerCount', 'class'=>'float-right', 'method'=>'GET']) !!}
            <select name="y">
                <option value="">--</option>
                @for($i=date('Y')-8; $i<=date('Y'); $i++)
                    <option @if($y==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                @endfor
            </select>年
            <select name="m">
                <option value="">--</option>
                @for($i=1; $i<=12; $i++)
                    @php ($i<10) ? $a = '0'.$i : $a = $i  @endphp
                    <option @if($m==$a) selected="" @endif value="{{$a}}">{{$a}}</option>
                @endfor
            </select>月
            <input type="hidden" name="num" value="{{$num}}">
            <input type="submit" value="変更">
            {!! Form::close() !!}
            <span class="float-right">年および月を変更すると、該当するデータに表示内容を切り替えることができます。</span>
        </p>
    </div>
    <div class="col-sm-12 mgt-40">
        <ul class="sub_menu">
            <li>表示月数</li>
            <li><a href="{{route('YearOwnerCount')}}?y={{$y}}&m={{$m}}&num=6">6ヵ月</a></li>
            <li><a href="{{route('YearOwnerCount')}}?y={{$y}}&m={{$m}}&num=12">12ヵ月</a></li>
            <li><a href="{{route('YearOwnerCount')}}?y={{$y}}&m={{$m}}&num=24">24ヵ月</a></li>
        </ul>
        <table class="list_table_lite tb">
            <thead>
                <tr>
                    <th style="width:10%;">年／月</th>
                    <th style="width:40%;">広告成果グラフ</th>
                    <th style="width:10%;">クリック回数</th>
                    <th style="width:15%;">請求金額</th>
                    <th style="width:10%;">計上</th>
                    <th style="width:150px;">操作</th>
                </tr>
            </thead>
            <tbody class="list_table_lite_odd">
                @foreach($datas as $key => $data)
                <tr>
                    <td>
                        {{$data['y']}}年{{$data['m']}}月
                    </td>
                    <td>
                        <div id="chart_{{$key}}"></div>
                    </td>
                    <td class="right">{{$data['total_click']}} 回</td>
                    <td class="right">{{$data['total_price']}} 円</td>
                    <td class="center">--</td>
                    <td><a class="action_but" href="{{route('admin.MonthOwnerCount')}}?y={{$data['y']}}&m={{$data['m']}}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop    
@section('script') 
    <script>
        @foreach($datas as $key => $data)
            Highcharts.chart('chart_{{$key}}', {
                chart: {
                    height: 200,
                    type: 'line'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                exporting: { enabled: false },
                xAxis: {
                    categories: [{{$data['xAxis']}}],
                    title: {
                        text: ''
                    },
                },
                yAxis: {
                    title: {
                        text: ''
                    },
                    labels: {
                        format: '{value} 円'
                    }
                },
                tooltip: {
                    formatter: function () {
                        return ['<b>' + this.x + '</b>'].concat(
                            this.points.map(function (point) {
                                return '{{$data['y']}}年{{$data['m']}}月'+point.x+'日<br>広告成果 : ' + point.y+'円';
                            })
                        );
                    },
                    split: true
                },  

                legend: {
                    enabled: false
                },

                series: [{
                    name: '',
                    data: [{{$data['yAxis']}}],
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
        @endforeach
    </script>
@stop  