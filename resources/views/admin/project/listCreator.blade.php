@extends('admin.layout.main')
@section('content')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="d35d4be0-e396-b0b7-ac3a-caab03415c00">
        <div class="content">
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

                                                    <tbody>
                                                        @foreach ($creators as $creator)
                                                            <tr>
                                                                <div class="row">
                                                                    <div class="col-md-11">
                                                                        <div class="card card-testimonial">

                                                                            <div class="card-content">


                                                                                <div class="card-avatar">
                                                                                    <a href="#pablo">
                                                                                        <img class="img"
                                                                                            src="{{ $creator->getAvatar() }}">
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
                                                                                        class="btn btn-success">Assign</button>
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
                                                                                                    <h4 class="card-title">
                                                                                                        {{ $item->getProject->name }}
                                                                                                    </h4>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="label-control">Time:</label>
                                                                                                        <span>2022/09/01 ~
                                                                                                            2022/11/31
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
                                                                </div>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{ $creators->links() }}
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
