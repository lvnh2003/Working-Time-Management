@extends('admin.layout.main')
@push('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    クライアント管理
@endsection
@section('content')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="d35d4be0-e396-b0b7-ac3a-caab03415c00">
        <div style="display:none" class="modal fade in" id="noticeModal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true" style="display: block; padding-left: 15px;">
            <div class="modal-dialog modal-notice">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="material-icons">clear</i></button>
                        <h5 class="modal-title" id="myModalLabel"></h5>
                        <a class="btn btn-success" id="link">アサイン</a>
                    </div>
                    <div class="modal-body">
                        <div class="instruction">
                            <table id="datatables" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>画像</th>
                                        <th>名前</th>
                                        <th>トータル</th>
                                        <th>アクション</th>


                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">閉める!<div
                                class="ripple-container">
                                <div class="ripple ripple-on ripple-out"
                                    style="left: 63.6562px; top: 13.75px; background-color: rgb(255, 255, 255); transform: scale(14.6621);">
                                </div>
                            </div></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="material-icons">clear</i></button>
                    </div>
                    <div class="modal-body text-center">
                        <h5>削除してもよろしいですか</h5>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-simple" data-dismiss="modal">滅ぼす</button>
                        <a type="button" class="btn btn-success btn-simple" id="btnConfirm">はい</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <h3 class="">クライアント管理</h3>
                    <a class="btn btn-primary" href="{{ route('admin.customer.create') }}">クライアント新規作成
                    </a>
                    <a class="btn btn-default" href="{{ route('admin.project.create') }}">プロジェクト新規作成
                    </a>


                    @foreach ($clients as $client)
                        <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $client->getUser->name }}
                                    </h4>
                                </div>
                                <div class="card-content">
                                    <ul class="nav nav-pills nav-pills-warning">
                                        <li class="active">
                                            <a href="#pill1" data-toggle="tab" aria-expanded="true">プロジェクト</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="pill1">
                                            <div class="row">
                                                @foreach ($client->getUser->getProject as $project)
                                                    <div class="col-lg-4 col-md-4 col-sm-4"
                                                        id="{{ 'project-' . $project->id }}">
                                                        <div class="card card-stats">
                                                            <div class="card-header" data-background-color="blue">
                                                                <i class="material-icons">event_note</i>
                                                            </div>
                                                            <div class="card-content">
                                                                <p class="category">{{ $project->getTotalTimeProject() }} 時間
                                                                </p>
                                                                <h3 class="card-title">{{ $project->name }}</h3>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="stats">
                                                                    <i class="material-icons text-danger">warning</i>

                                                                    <button value="{{ $project->id }}" class="btnDelete"
                                                                        style="cursor: pointer;background-color: transparent;border: none; color: #9c27b0;"
                                                                        data-toggle="modal" data-target="#smallAlertModal">
                                                                        削除
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                </div>
                                                                <div class="stats" style="float: right">
                                                                    <i class="material-icons text-warning">info</i>
                                                                    <button value="{{ $project->id }}"
                                                                        data-toggle="modal" data-target="#noticeModal"
                                                                        style="cursor: pointer;background-color: transparent;border: none; color: #9c27b0;"
                                                                        class="btnModal">ディテール</button>
                                                                </div>
                                                                {{-- <button class="btn btn-raised btn-round btn-info" data-toggle="modal" data-target="#noticeModal">
                                                            Notice modal
                                                        <div class="ripple-container"></div></button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- end row -->
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/datatables.min.js">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).on('click', '.btnModal', function() {
            var id = this.value;

            if (table) {
                table.clear().destroy(); // Hủy DataTable đã được khởi tạo trước đó
                $('#datatables ').empty();
                $('#datatables thead').empty();

                // Tạo phần tử <thead> và dòng tiêu đề mới
                var newThead = $('<thead>');
                var headerRow = $('<tr>');
                headerRow.append('<th>画像</th>');
                headerRow.append('<th>名前</th>');
                headerRow.append('<th>トータル</th>');
                headerRow.append('<th>アクション</th>');

                // Gắn kết dòng tiêu đề vào phần tử <thead>
                newThead.append(headerRow);

                // Gắn kết phần tử <thead> mới vào bảng
                $('#datatables').append(newThead);
            }
            table = new DataTable('#datatables', {
                language: {
                    "sEmptyTable": "データテーブルに利用できるデータがありません",
                    "sInfo": "_TOTAL_ 件中 _START_ から _END_ まで表示",
                    "sInfoEmpty": "0 件中 0 から 0 まで表示",
                    "sInfoFiltered": "（全 _MAX_ 件より抽出）",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "_MENU_ 件表示",
                    "sLoadingRecords": "ローディング...",
                    "sProcessing": "処理中...",
                    "sSearch": "検索:",
                    "sZeroRecords": "一致するレコードがありません",
                    "oPaginate": {
                        "sFirst": "最初",
                        "sLast": "最後",
                        "sNext": "次",
                        "sPrevious": "前"
                    },
                    "oAria": {
                        "sSortAscending": ": 昇順でソート",
                        "sSortDescending": ": 降順でソート"
                    },
                    "select": {
                        "rows": {
                            "_": "%d 件のレコードが選択されています",
                            "0": "",
                            "1": "1 件のレコードが選択されています"
                        }
                    }
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.project.listCreator', '') }}" + '/' + id,
                columns: [{
                        data: 'avatar',
                        name: 'avatar',
                        render: function(data) {
                            return `
                                                <img class="img" src="${data}" style="width:80px">
                                           `;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'progress',
                        name: 'progress',
                    },
                    {
                        data: 'detail',
                        name: 'detail',
                        render: function(data) {
                            return `<a href="${data}" class="btn btn-success"> ディテール </a>`
                        }
                    }
                ],
                pageLength: 1


            });
            $.ajax({
                url: '{{ route('admin.project.get', '') }}' + '/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#myModalLabel').text(response.name);
                    if (response.finished == null) {
                        $('#link').removeClass('finished btn-default').addClass('btn-success')
                        $('#link').attr('href', '{{ route('admin.project.assign', '') }}' + '/' +
                            response
                            .id);
                    } else {
                        $('#link').attr('href', '#');
                        $('#link').removeClass('btn-success').addClass('finished btn-default')
                    }


                },
                error: function(err) {}

            });
        });
        $(document).on('click', '.finished', function() {
            swal({
                title: "通知",
                text: "おそらく、このプロジェクトマネージャーはプロジェクトを終了しました。",
                type: 'info',
                confirmButtonText: "はい"
            })
        });
        $(document).on('click', '.btnDelete', function() {
            var id = this.value;
            $('#btnConfirm').click(function() {
                $.ajax({
                    url: '{{ route('admin.project.destroy', '') }}' + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        $('#project-' + response.id).remove();
                        $('#smallAlertModal').modal('hide');
                        swal({
                            title: "完了!",
                            text: response.success,
                            type: "success",
                            confirmButtonText: "はい"
                        });
                    },
                    error: function(error) {
                        swal({
                            title: "過ち!",
                            text: response.error,
                            type: "error",
                            confirmButtonText: "はい"
                        });
                    },
                })
            });

        })
    </script>
@endpush
