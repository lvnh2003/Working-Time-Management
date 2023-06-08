@extends('user.layout.main')
@push('css')
    <style>
        body {
            overflow-y: hidden
        }
    </style>
@endpush
@section('content')
    <div class="full-page login-page" filter-color="black" data-image="../../assets/img/login.jpeg">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="POST" action="{{ route('loginAction') }}">
                            @csrf
                            <div class="card card-login">
                                <div class="card-header text-center" data-background-color="rose">
                                    <h4 class="card-title">ログイン</h4>
                                    <div class="social-line">
                                        <a href="#btn" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#eugen" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <p class="category text-center">
                                    <a href="{{ route('signup') }}">
                                        又はサインアップ
                                    </a>

                                </p>
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">メールアドレス</label>
                                            <input type="email" class="form-control" name="email">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">パスワード</label>
                                            <input type="password" class="form-control" name="password">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">ログイン</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-page-background" style="background-image: url(../../assets/img/login.jpeg) "></div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            @if (session()->has('success'))
                demo.showNotification('top', 'right', 'success', "{!! session()->get('success') !!}");
            @endif
            @if (session()->has('error'))
                demo.showNotification('top', 'right', 'warning', "{!! session()->get('error') !!}");
            @endif
            @if ($errors->any())
            demo.showNotification('top', 'right', 'warning', "{!! $errors->all()[0] !!}");
            @endif
        })
    </script>
@endpush
