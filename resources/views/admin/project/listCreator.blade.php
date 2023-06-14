@extends('admin.layout.main')
@section('title')
    全てのクリエイター
@endsection
@section('content')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="d35d4be0-e396-b0b7-ac3a-caab03415c00">
        <div class="content">
            <div style="display:none" class="modal fade in" id="noticeModal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" style="display: block; padding-left: 15px;">
                <div class="modal-dialog modal-notice">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                            <h5 class="modal-title" id="myModalLabel"></h5>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="purple">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">クリエイター</h4>
                                <div class="toolbar">
                                    <a type="button" href="{{ route('admin.customer') }}" class="btn-danger btn"
                                        style="float:right;margin-top: -20px">
                                        ホーム
                                        <span class="btn-label">
                                            <i class="material-icons">keyboard_return</i>
                                        </span>
                                    </a>
                                    <input type="text" id="searchInput" placeholder="検索..." class="form-control"
                                        style="width: 30%;margin-left: 20px">

                                </div>

                                <div class="material-datatables">
                                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="datatables" cellspacing="0" width="100%" style="width: 100%;">

                                                    <tbody>
                                                        @foreach ($creators as $creator)
                                                            <tr>
                                                                <td class="row">
                                                                    <div class="col-md-11">
                                                                        <div class="card card-testimonial">
                                                                            <div class="card-content">
                                                                                <div class="card-avatar">
                                                                                    <a href="#pablo">
                                                                                        <img class="img"
                                                                                            src="{{ $creator->getAvatar() ? $creator->getAvatar() : $avatar_default }}">
                                                                                    </a>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ route('admin.project.assign.create', $id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <h4 class="card-description">
                                                                                        {{ $creator->name }}</h4>
                                                                                    <button value="{{ $creator->id }}"
                                                                                        name="idCreator"
                                                                                        class="btn btn-success">アサイン</button>
                                                                                </form>
                                                                                <div class="row">
                                                                                    @foreach ($creator->getProjectOfCreator as $item)
                                                                                        <div class="col-md-4">
                                                                                            <div class="card">
                                                                                                <div class="card-header card-header-icon"
                                                                                                    data-background-color="rose">
                                                                                                    <i
                                                                                                        class="material-icons">today</i>
                                                                                                </div>
                                                                                                <div class="card-content">
                                                                                                    <button
                                                                                                        value="{{ $item->getProject->id }}"
                                                                                                        data-toggle="modal"
                                                                                                        data-target="#noticeModal"
                                                                                                        style="cursor: pointer;background-color: transparent;border: none; color: #9c27b0;float: right;"
                                                                                                        class="btnModal"><i
                                                                                                            class="material-icons text-warning">info</i></button>
                                                                                                    <h4 class="card-title">
                                                                                                        {{ $item->getProject->name }}
                                                                                                    </h4>

                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="label-control">時間:</label>
                                                                                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d日m月Y年') }}
                                                                                                            <br>~
                                                                                                            {{ $item->getProject->finished ? \Carbon\Carbon::parse($item->getProject->finished)->format('d日m月Y年') : '未完成' }}
                                                                                                        </span>
                                                                                                        <span
                                                                                                            class="material-input"></span>


                                                                                                    </div>



                                                                                                </div>

                                                                                            </div>

                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- {{ $creators->appends(request()->query())->links('pagination::bootstrap-4') }}  --}}
                                </div>
                            </div>
                            <!-- end content-->
                        </div>
                        <!--  end card  -->
                    </div>
                    <!-- end col-md-12 -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{-- <script src="{{ asset('/assets') }}/js/jquery.datatables.js"></script> --}}
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
                },
                error: function(err) {
                    swal({
                        title: "過ち!",
                        text: err.message,
                        type: "error",
                        confirmButtonText: "はい"
                    })

                }

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện khi người dùng nhập vào trường tìm kiếm
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                // Lặp qua tất cả các hàng trong bảng và ẩn hiện dựa trên kết quả tìm kiếm
                $('#datatables tbody tr').each(function() {
                    var name = $(this).find('.card-description').text().toLowerCase();
                    if (name.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endpush
