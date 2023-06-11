@extends('user.layout.main')
@section('title')
クライアントを作り
@endsection
@section('content')
    <div class="full-page lock-page" filter-color="black" data-image="../../assets/img/lock.jpeg">
        <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
        <div class="content">
            <form method="POST" action="{{ route('admin.customer.store') }}">
                @csrf
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <img class="avatar" src="../../assets/img/group.png" alt="...">
                        </a>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Tania Andrew</h4>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">groups</i>
                            </span>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">クライアント名</label>
                                <input name="name" type="text" class="form-control" autocomplete="off">
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">メールアドレス</label>
                                <input name="email" type="email" class="form-control" autocomplete="off">
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">password</i>
                            </span>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">パスワード</label>
                                <input name="password" type="password" class="form-control"
                                    autocomplete="off">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a type="button" class="btn btn-warning btn-round" href="{{route('admin.customer')}}">キャンセル</a>
                        <input type="submit" class="btn btn-success btn-round" value="登録">

                    </div>

                </div>
            </form>
        </div>

        <div class="full-page-background" style="background-image: url(../../assets/img/lock.jpeg) "></div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            @if (session()->has('error'))
                 swal("Error!", "{!! session()->get('error') !!}", "error");
            @endif  
            @error('password')
                swal("Error!", "パスワードアドレスを入力してください", "error");
            @enderror
            @error('email')
                swal("Error!", "メールアドレスを入力してください", "error");
            @enderror

        });
    </script>
@endpush
