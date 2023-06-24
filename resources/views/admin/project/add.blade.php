@extends('user.layout.main')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border: 0;
            border-bottom: 1px solid #D2D2D2;

            border-radius: 0
        }

        .selection {
            padding-bottom: 10px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-left: -6px
        }

        html {
            height: 100%;
            /* max-height: 600px; */
            width: 100%;
            background-color: hsla(200, 40%, 30%, .4);
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

        body {
            background-color: transparent;

        }
    </style>
@endpush

@section('title')
    プロジェクトを作り
@endsection
@section('content')
    <div class="full-page lock-page" filter-color="black">
        <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
        <div class="content">
            <form method="POST" action="{{ route('admin.project.store') }}">
                @csrf
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <img class="avatar" src="../../assets/img/group.png" alt="...">
                        </a>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">クライアントの作成</h4>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">groups</i>
                            </span>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" style="z-index: 100;">クライアント名</label>
                                <select class="form-control" name="idClient" id="select-name">
                                    <option disabled="" selected="" value="0"></option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->getUser->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">edit</i>
                            </span>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">プロジェクト名</label>
                                <input name="name" type="text" class="form-control" autocomplete="off">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a type="button" class="btn btn-warning btn-round" href="{{ route('admin.customer') }}">キャンセル</a>
                        <input type="submit" class="btn btn-success btn-round" value="登録">

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#select-name").select2({
                language: {
                    noResults: function() {
                        return `見つかりません...`;
                    }
                }
            });
            @error('name')
                swal({
                    title: "過ち!",
                    text: "プロジェクトの名前を空白のままにしないでください",
                    type: "warning",
                    confirmButtonText: "はい"
                })
            @enderror
            @error('idClient')
                swal({
                    title: "過ち!",
                    text: "クライアントを選択してください",
                    type: "warning",
                    confirmButtonText: "はい"
                })
            @enderror
            @if (session()->has('error'))
                swal({
                    title: "過ち!",
                    text: "{!! session()->get('error') !!}",
                    type: "warning",
                    confirmButtonText: "はい"
                })
            @endif
        });
    </script>
@endpush
