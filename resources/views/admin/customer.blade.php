@extends('admin.layout.main')
@section('content')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="d35d4be0-e396-b0b7-ac3a-caab03415c00">

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <h3 class="">クライアント管理</h3>
                    <a class="btn btn-primary" href="{{route('admin.customer.create')}}">クライアント新規作成
                    </a>
                    <a class="btn btn-default">プロジェクト新規作成
                    </a>



                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Navigation Pills -
                                    <small>Horizontal Tabs</small>
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
                                        Collaboratively administrate empowered markets via plug-and-play networks.
                                        Dynamically procrastinate B2C users after installed base benefits.
                                        <br>
                                        <br> Dramatically visualize customer directed convergence without revolutionary ROI.
                                        Collaboratively administrate empowered markets via plug-and-play networks.
                                        Dynamically procrastinate B2C users after installed base benefits.
                                        <br>
                                        <br> This is very nice.
                                    </div>
                                    <div class="tab-pane" id="pill2">
                                        Efficiently unleash cross-media information without cross-media value. Quickly
                                        maximize timely deliverables for real-time schemas.
                                        <br>
                                        <br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>

    </div>
@endsection
