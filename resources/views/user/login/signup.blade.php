@extends('user.layout.main')
@push('css')
    <style>
        .card .card-signup {
            margin-bottom: 0
        }

        .register-page .card-signup {
            padding: 0;
            padding-top: 10px
        }

        body {
            overflow-y: hidden
        }
    </style>
@endpush
@section('content')
    <div class="full-page register-page" filter-color="black" data-image="../../assets/img/register.jpeg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card card-signup">
                        <h2 class="card-title text-center">サインアップ</h2>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-rose">
                                            <i class="material-icons">list</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">条項 1</h4>
                                            <p class="description">
                                                「プライバシーの権利が保護されます。お客様の個人情報は、法的要件に基づかない限り、
                                                お客様の同意なしに第三者に開示されることはありません。」
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-primary">
                                            <i class="material-icons">list</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">条項 2</h4>
                                            <p class="description">
                                                「当社のウェブサイトを利用する際には、法律に違反せず、情報の共有に対して責任を負います。違反行為や他のユーザーに害を与える場合、
                                                当社はアカウントを削除する権利を有します。」
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <form class="form" method="POST" action="{{ route('signupAction') }}">
                                    @csrf
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group is-empty"><input type="text" class="form-control"
                                                    placeholder="クリエイター名..." name="name"
                                                    value="{{ old('name') }}"><span class="material-input"></span></div>
                                        </div>
                                        @error('name')
                                            <div class="text-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group is-empty"><input type="text" class="form-control"
                                                    placeholder="メールアドレス..." name="email"
                                                    value="{{ old('email') }}"><span class="material-input"></span></div>
                                        </div>
                                        @error('email')
                                            <div class="text-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group is-empty"><input type="password" placeholder="パスワード..."
                                                    name="password" class="form-control"><span
                                                    class="material-input"></span></div>
                                        </div>
                                        @error('password')
                                            <div class="text-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <!-- If you want to add a checkbox to this form, uncomment this code -->
                                        {{-- <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes" checked=""><span
                                                    class="checkbox-material"><span class="check"></span></span> I agree to
                                                the
                                                <a href="#something">terms and conditions</a>.
                                            </label>
                                        </div> --}}
                                    </div>
                                    <div class="footer text-center">
                                        <input type="submit" class="btn btn-primary btn-round" value="サインアップ">
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-page-background" style="background-image: url(../../assets/img/register.jpeg) "></div>
    </div>
@endsection
