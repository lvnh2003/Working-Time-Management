@extends('user.layout.main')
@push('css')
    <style>
        body{
        overflow-y: hidden
       }
    </style>
@endpush
@section('content')
<div class="full-page lock-page" filter-color="black" data-image="../../assets/img/lock.jpeg">
    <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
    <div class="content">
        <form method="POST" action="{{route('forgot.reset',$token)}}">
            @csrf
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="avatar" src="{{$user->getAvatar()}}" alt="...">
                    </a>
                </div>
                <div class="card-content">
                    <h4 class="card-title">{{$user->name}}</h4>
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">password</i>
                        </span>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">確認パスワード</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                autocomplete="off">
                            <span class="material-input"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-rose btn-round">更新</button>
                </div>
            </div>
        </form>
    </div>
<div class="full-page-background" style="background-image: url(../../assets/img/lock.jpeg) "></div></div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            @if (session()->has('success'))
                demo.showNotification('top', 'right', 'success', "{!! session()->get('error') !!}");
            @endif
            @if ($errors->any())
                demo.showNotification('top', 'right', 'warning', "{!! $errors->all()[0] !!}");
            @endif
        })
    </script>
@endpush
