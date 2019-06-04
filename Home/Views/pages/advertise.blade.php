@extends('layouts.search')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sx-12">
                <h2>求人広告を出してみませんか？</h2>
                <p>
                   広告にクリック単価を設定していただき、クリック単価が高い広告のトップ３がページの先頭に表示されます。<br>
                   まずは、無料で<a href="<?php echo route('register.cUser') ?>">企業登録</a>をお願いします。
                </p>
                <ul class="nav-ten">
                    <li><a href="./">トップページ</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@stop      