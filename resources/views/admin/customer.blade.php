@extends('admin.layout.main')
@push('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
@endpush
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
                        <a class="btn btn-success" id="link">Assign</a>
                    </div>
                    <div class="modal-body">
                        <div class="instruction">
                            <table id="datatables" style="width: 100%">
                                <thead>
                                    <tr style="width: 100%">
                                        <th>画像</th>
                                        <th>名前</th>
                                        <th>トータル</th>


                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close!<div
                                class="ripple-container">
                                <div class="ripple ripple-on ripple-out"
                                    style="left: 63.6562px; top: 13.75px; background-color: rgb(255, 255, 255); transform: scale(14.6621);">
                                </div>
                            </div></button>
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
                                        <li class="">
                                            <a href="#pill2" data-toggle="tab" aria-expanded="false">クリエイター</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="pill1">
                                            <div class="row">
                                                @foreach ($client->getUser->getProject as $project)
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="card card-stats">
                                                            <div class="card-header" data-background-color="blue">
                                                                <i class="material-icons">event_note</i>
                                                            </div>
                                                            <div class="card-content">
                                                                <p class="category">Bookings</p>
                                                                <h3 class="card-title">{{ $project->name }}</h3>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="stats">
                                                                    <i class="material-icons text-danger">warning</i>
                                                                    <a href="#pablo">Remove</a>
                                                                </div>
                                                                <div class="stats" style="float: right">
                                                                    <i class="material-icons text-warning">info</i>
                                                                    <button value="{{ $project->id }}" data-toggle="modal"
                                                                        data-target="#noticeModal"
                                                                        style="cursor: pointer;background-color: transparent;border: none; color: #9c27b0;"
                                                                        class="btnModal">Detail</button>
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
                                        <div class="tab-pane" id="pill2">
                                            Efficiently unleash cross-media information without cross-media value. Quickly
                                            maximize timely deliverables for real-time schemas.
                                            <br>
                                            <br>Dramatically maintain clicks-and-mortar solutions without functional
                                            solutions.
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
                $('#datatables').empty();
            }
            table = new DataTable('#datatables', {
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
                        render: function(data) {
                            return `<a href="${data}" class="btn btn-success"> Detail </a>`
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
                    $('#link').attr('href','{{route('admin.project.assign','')}}'+'/'+response.id);

                },
                error: function(err) {}

            });
        })
    </script>
@endpush
