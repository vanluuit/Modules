@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>クロール申請</h2>
        <table class="tb">
            <caption>クロール申請情報</caption>
            <tbody>
                <tr>
                    <th style="width:220px;">氏名<span class="requisite">必須</span></th>
                    <td class=" ">
                        <input type="text" name="name" value="" size="40" maxlength="256"> 
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="mail" value="" size="40" maxlength="256">
                    </td>
                </tr>
                <tr>
                    <th>電話番号<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="tel" value="" size="32" maxlength="32">
                    </td>
                </tr>
                <tr>
                    <th>クロール申請URL<span class="requisite">必須</span></th>
                    <td class="">
                        <input type="text" name="search_url" value="" size="40" maxlength="256">
                        <span class="hint">※「http://www.example.com/」のようなトップページURLを申請してください。</span>
                    </td>
                </tr>
                <tr>
                    <th>メモ</th>
                    <td class="">
                        <textarea name="memo" cols="45" rows="6"></textarea>
                        <span class="hint">※サイトクロール申請理由や、その他希望など</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop    