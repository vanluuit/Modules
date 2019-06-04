@extends('layouts.search')
@section('content')
<section id="pagebox">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="contents_m">    
                    <div class="contents_box">
                        <h2>ログインフォーム</h2>
                        <div class="main">  
                            <div class="form_table">
                                @if (@session('flash'))
                                    <p class="link-box {{ @session('flash')['class'] }}">
                                        {!! @session('flash')['mes'] !!}
                                    </p>
                                @endif
                                {!! Form::open(['route' => 'dologin', 'id'=>'validateForm']) !!}
                                    <table>
                                        <caption>ログイン情報</caption>
                                        <tbody>
                                            <tr>
                                                <th>メールアドレス</th>
                                                <td class="">
                                                    <input type="text" name="email" value="" size="40" maxlength="128">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>パスワード</th>
                                                <td class="">
                                                    <input type="password" name="password" id="password" size="30" maxlength="50">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="button"><input type="submit" name="Submit" value="確認する" class="btn_check"></p>
                                {!! Form::close() !!}
                            </div>
                            <!--form_table END-->
                        </div>
                        <!--main END-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop    
@section('script') 
    <script>
        $(document).ready(function(){

            var validateForm = $('#validateForm').validate({
                rules: {
                    email: {
                        required: true,
                        email:true,
                    },
                    password: {
                        minlength: 6,
                        required: true,
                    }
                },

                messages: {
                    email: {
                        required:  "メールアドレスが間違っています。",
                        email: "メールアドレスが間違っています。",
                    },
                    password: {
                        minlength: "パスワードは6文字以上で入力してください。",
                        required:  "パスワードは6文字以上で入力してください。",
                    }
                },
                highlight: function (e) {
                    $(e).closest('td').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('td').removeClass('has-error');//.addClass('has-info');
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                        var controls = element.closest('td');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else error.insertAfter(element);
                }
            });
        });
    </script>
@stop   