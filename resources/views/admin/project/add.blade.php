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
    </style>
@endpush
@section('title')
    プロジェクトを作り
@endsection
@section('content')
    <div class="full-page lock-page" filter-color="black" data-image="../../assets/img/lock.jpeg">
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

        <div class="full-page-background" style="background-image: url(../../assets/img/lock.jpeg) "></div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#select-name").select2(
                {
                    language: {
                        noResults: function () {
                        return `見つかりません...`;
                        }
                    }
                }
            );
            @error('name')
                swal("エラー!", "プロジェクトの名前を空白のままにしないでください", "warning");
            @enderror
            @if (session()->has('error'))
                swal("エラー!", "{!! session()->get('error') !!}", "warning");
            @endif
        });
    </script>
@endpush
