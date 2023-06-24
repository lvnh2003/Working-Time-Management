@extends('user.layout.main')
@section('title')
クライアントを作り
@endsection
@push('css')
<style>
    html {
    height: 100%;
    /* max-height: 600px; */
    width: 100%;
    background-color: hsla(200,40%,30%,.4);
    background-image:    
      url('https://78.media.tumblr.com/cae86e76225a25b17332dfc9cf8b1121/tumblr_p7n8kqhmud1uy4lhuo1_540.png'), 
      url('https://78.media.tumblr.com/66445d34fe560351d474af69ef3f2fb0/tumblr_p7n908e1jb1uy4lhuo1_1280.png'),
      url('https://78.media.tumblr.com/8cd0a12b7d9d5ba2c7d26f42c25de99f/tumblr_p7n8kqhmud1uy4lhuo2_1280.png'),
      url('https://78.media.tumblr.com/5ecb41b654f4e8878f59445b948ede50/tumblr_p7n8on19cv1uy4lhuo1_1280.png'),
      url('https://78.media.tumblr.com/28bd9a2522fbf8981d680317ccbf4282/tumblr_p7n8kqhmud1uy4lhuo3_1280.png');
    background-repeat: repeat-x;
    background-position: 
      0 20%,
      0 100%,
      0 50%,
      0 100%,
      0 0;
    background-size: 
      2500px,
      800px,
      500px 200px,
      1000px,
      400px 260px;
    animation: 50s para infinite linear;
    }
  
  @keyframes para {
    100% {
      background-position: 
        -5000px 20%,
        -800px 95%,
        500px 50%,
        1000px 100%,
        400px 0;
      }
    }
    body{
        background-color: transparent;
        
    }
  </style>          
@endpush
@section('content')
    <div class="full-page lock-page" filter-color="black" >
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
                        <h4 class="card-title">クライアントを作り</h4>
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

        {{-- <div class="full-page-background" style="background-image: url(../../assets/img/lock.jpeg) "></div> --}}
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            @if (session()->has('error'))
                 swal(
                    {
                        title:"過ち!",
                        text: "{!! session()->get('error') !!}",
                        type: "warning",
                        confirmButtonText: "はい"
                    })
                 
            @endif
            @error('name')
                swal(
                    {
                        title:"過ち!",
                        text: "名前を空白にすることはできません",
                        type: "warning",
                        confirmButtonText: "はい"
                    })
            @enderror
            @error('password')
            swal(
                    {
                        title:"過ち!",
                        text: "{{$message}}",
                        type: "warning",
                        confirmButtonText: "はい"
                    })
            @enderror
            @error('email')
                swal(
                    {
                        title:"過ち!",
                        text: "メールアドレスを入力してください",
                        type: "warning",
                        confirmButtonText: "はい"
                    })
            @enderror
                
        });
    </script>
@endpush
