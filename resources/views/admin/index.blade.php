@extends('admin.layout.main')
@push('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <style>
        .card img {
            width: 80%;
            height: 100%;
            margin: auto;
        }
    </style>
@endpush
@section('content')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="d35d4be0-e396-b0b7-ac3a-caab03415c00">
        {{-- <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> DataTables.net </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="hidden-lg hidden-md">
                                    Notifications
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Mike John responded to your email</a>
                                </li>
                                <li>
                                    <a href="#">You have 5 new tasks</a>
                                </li>
                                <li>
                                    <a href="#">You're now friend with Andrew</a>
                                </li>
                                <li>
                                    <a href="#">Another Notification</a>
                                </li>
                                <li>
                                    <a href="#">Another One</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group form-search is-empty">
                            <input type="text" class="form-control" placeholder=" Search ">
                            <span class="material-input"></span>
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav> --}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="orange">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">クリエイター</h4>
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="material-datatables">
                                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="datatables"
                                                    class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                                                    cellspacing="0" width="100%" style="width: 100%;" role="grid"
                                                    aria-describedby="datatables_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting" tabindex="0" aria-controls="datatables"
                                                                rowspan="1" colspan="1" style="width: 100px;"
                                                                aria-label="Name: activate to sort column ascending">画像
                                                            </th>
                                                            <th class="sorting_desc" tabindex="0"
                                                                aria-controls="datatables" rowspan="1" colspan="1"
                                                                style="width: 100px;"
                                                                aria-label="Position: activate to sort column ascending"
                                                                aria-sort="descending">名前</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables"
                                                                rowspan="1" colspan="1" style="width: 200px;"
                                                                aria-label="Office: activate to sort column ascending">
                                                                メール</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatables"
                                                                rowspan="1" colspan="1" style="width: 200px;"
                                                                aria-label="Age: activate to sort column ascending">プロジェクト
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portofolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>2023
                    <a href="http://www.creative-tim.com"> Creative Tim </a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/datatables.min.js">
    </script>
    <script>
        let table = new DataTable('#datatables', {
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
            ajax: "{{ route('admin.getAllUsers') }}",
            columns: [{
                    data: 'avatar',
                    name: 'avatar',
                    render: function(data) {
                        return `
                        <div class="card-avatar">
                                            <a href="#pablo">
                                                <img class="img" src="${data}">
                                            <div class="ripple-container"></div></a>
                                        </div>`;
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'project',
                    name: 'project',
                }
            ],


        })
    </script>
@endpush
