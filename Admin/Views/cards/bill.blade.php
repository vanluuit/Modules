@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>料金請求の管理</h2>
        <table class="tb">
            <tbody>
                <tr>
                    <th style="width:15%;">入金報告</th>
                    <td style="width:35%;">
                        <div class="label5 clearfix">
                            <label><input type="checkbox" name="notice[]" value="TRUE">済</label>
                            <label><input type="checkbox" name="notice[]" value="FALSE">未</label>
                            <input type="hidden" name="notice_CHECKBOX" value="">
                            <input name="notice_PAL[]" type="hidden" value="match in">
                        </div>
                    </td>
                    <th style="width:15%;">入金確認</th>
                    <td style="width:35%;">
                        <div class="label5 clearfix">
                            <label><input type="checkbox" name="pay_flg[]" value="TRUE">済</label>
                            <label><input type="checkbox" name="pay_flg[]" value="FALSE">未</label>
                            <input type="hidden" name="pay_flg_CHECKBOX" value="">
                            <input name="pay_flg_PAL[]" type="hidden" value="match in">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop    