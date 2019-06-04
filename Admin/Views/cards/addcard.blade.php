@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>カード情報登録</h2>
        <table class="tb">
            <caption>カード情報</caption>
            <tbody><tr>
                <th style="width:220px;">カード番号<span class="requisite">必須</span></th>
                <td class="">
                    <input type="text" name="card_number" value="" size="24" maxlength="16">
                </td>
            </tr>
            <tr>
                <th>カード有効期限<span class="requisite">必須</span></th>
                <td class="">
                    <select name="card_exp_month">
                        <option value="1" selected="selected">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>/
                    <select name="card_exp_year">
                        <option value="2019" selected="selected">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>カード名義<span class="requisite">必須</span></th>
                <td class="">
                    <input type="text" name="card_name" value="" size="32" maxlength="32">
                </td>
            </tr>
            <tr>
                <th>セキュリティコード<span class="requisite">必須</span></th>
                <td class="">
                    <input type="text" name="card_cvc" value="" size="3" maxlength="3">
                </td>
            </tr>
        </tbody>
        </table>
        <p class="button"><input type="submit" name="Submit" value="確認する" class="btn_check"></p>
    </div>
</div>

@stop    