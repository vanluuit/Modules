@extends('layouts.search')
@section('content')
<section>
    <div class="container max-620 pdtb_50">
        <div class="form-search">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center bold"><span class="cl_f46f50">家</span>まとめ</h2>
                </div>
            </div>
            <form action="{{route('fillter')}}" method="get" accept-charset="utf-8">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <h3 class="title-search">キーワードから選ぶ</h3>
                        <div class="form-group has-feedback has-search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            <input type="text" name="key" class="form-control" placeholder="マンション名など">
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <h3 class="title-search">地域から選ぶ</h3>
                        <div class="form-group has-feedback has-search">
                            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                            <input type="text" name="location" class="form-control SearchLocation" placeholder="都道府県・市区町村・駅名">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="title-search">ジャンルを選ぶ</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <h3 class="sub-tt">借りる</h3>
                    </div>
                    <div class="col-sm-10 form-group">
                        <div class="border">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="max-130">
                                        賃貸マンション <input class="pull-right" type="checkbox" value="1" disabled="">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                        賃貸アパート <input class="pull-right" type="checkbox" value="2" disabled="">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                        一戸建て <input class="pull-right" type="checkbox" value="3" disabled="">
                                    </label>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <h3 class="sub-tt">買う</h3>
                    </div>
                    <div class="col-sm-10 form-group">
                        <div class="border">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="max-130">
                                        新築マンション<input class="pull-right" type="checkbox" name="tag" value="1">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                        中古マンション<input class="pull-right" type="checkbox" name="tag" value="2">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                     新築一戸建て<input class="pull-right" type="checkbox" name="tag" value="3">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                     中古一戸建て<input class="pull-right" type="checkbox" name="tag" value="4">
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="max-130">
                                    土   地<input class="pull-right" type="checkbox" name="tag" value="5">
                                    </label>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">
                            <button type="submit" class="btn btn-default btn-search_main">検索</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="url-search">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-search">地域から探す</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="denable">北海道・東北</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産北海道')}}">北海道</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産青森')}}">青森</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産岩手')}}">岩手</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産秋田')}}">秋田</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産宮城')}}">宮城</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産山形')}}">山形</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産福島')}}">福島</a></li>
                    </ul>　　　
                </div>
                <div class="col-sm-12">
                    <h4 class="denable">関東</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産東京')}}">東京</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産神奈川')}}">神奈川</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産埼玉')}}">埼玉</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産千葉')}}">千葉</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産茨城')}}">茨城</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産栃木')}}">栃木</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産群馬')}}">群馬</a></li>
                    </ul>　　　

                </div>
                <div class="col-sm-12">
                    <h4 class="denable">中部・北陸</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産愛知')}}">愛知</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産岐阜')}}">岐阜</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産静岡')}}">静岡</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産三重')}}">三重</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産新潟')}}">新潟</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産山梨')}}">山梨</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産長野')}}">長野</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産石川')}}">石川</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産富山')}}">富山</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産福井')}}">福井</a></li>
                    </ul>　　　
                </div>
                <div class="col-sm-12">
                    <h4 class="denable">関西</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産大阪')}}">大阪</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産兵庫')}}">兵庫</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産京都')}}">京都</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産滋賀')}}">滋賀</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産奈良')}}">奈良</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産和歌山')}}">和歌山</a></li>
                    </ul>　　　
                </div>
                <div class="col-sm-12">
                    <h4 class="denable">中国・四国</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産岡山')}}">岡山</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産広島')}}">広島</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産鳥取')}}">鳥取</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産島根')}}">島根</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産山口')}}">山口</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産香川')}}">香川</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産徳島')}}">徳島</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産愛媛')}}">愛媛</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産高知')}}">高知</a></li>
                    </ul>　　　
                </div>
                <div class="col-sm-12">
                    <h4 class="denable">九州・沖縄</h4>
                    <ul class="nav-link">
                        <li><a href="{{route('searchs', 'の関連の不動産福岡')}}">福岡</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産佐賀')}}">佐賀</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産長崎')}}">長崎</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産熊本')}}">熊本</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産大分')}}">大分</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産宮崎')}}">宮崎</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産鹿児島')}}">鹿児島</a></li>
                        <li><a href="{{route('searchs', 'の関連の不動産沖縄')}}">沖縄</a></li>
                    </ul>　　　
                </div>
            </div>
        </div>
    </div>
</section>

@stop      