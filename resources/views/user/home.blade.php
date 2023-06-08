@extends('user.layout.main')
@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')
    @include('user.layout.navbar')
    <div class="content">
        <style>
            .custom-file-input {
                position: relative;
                display: inline-block;
            }

            .custom-file-input input[type="file"] {
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .custom-file-input label {
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                border-radius: 4px;
                cursor: pointer;
            }

            .custom-file-input label span {
                display: none;
            }

            .custom-file-input label button {
                background: linear-gradient(60deg, #ec407a, #d81b60);
                box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(233, 30, 99, 0.4);
                color: white;
                border: none;
                border-radius: 4px;
                padding: 8px 16px;
                cursor: pointer;
            }

            .picture-src,
            .picture-src img {
                border-radius: 50%;
                width: 150px !important;
            }
        </style>
        <div class="container-fluid">
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card active" data-color="rose" id="wizardProfile">
                        <form action="" method="" novalidate="novalidate" multipart>
                            <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                            <div class="wizard-navigation">
                                <ul class="nav nav-pills">
                                    <li class="active" style="width: 33.3333%;">
                                        <a href="#about" data-toggle="tab" aria-expanded="true">個人情報</a>
                                    </li>
                                </ul>
                                <div class="moving-tab"
                                    style="width: 222.443px; transform: translate3d(-8px, 0px, 0px); transition: all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1) 0s;">
                                    個人情報</div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="about">
                                    <div class="row">
                                        <h4 class="info-text">ここで個人情報を変更できます。</h4>
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="picture-container">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new img-no-padding">
                                                        {{--  --}}
                                                        <img src=" {{ $user->getAvatar() ? $user->getAvatar() : $avatar_default }}"
                                                            alt="..." class="picture-src">
                                                    </div>
                                                    <div class="fileinput-preview picture-src"></div>
                                                    <div>
                                                        <span class="btn btn-primary btn-file btn-round"><span
                                                                class="fileinput-new">変え</span><span
                                                                class="fileinput-exists">変え</span>
                                                            <input type="file" name="image" id="avatar"></span>
                                                        <br>
                                                        <a href="#paper-kit" class="fileinput-exists" id="btnDestroy"
                                                            data-dismiss="fileinput"><i class="fa fa-times"></i> 滅ぼす</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group label-floating is-empty">

                                                    <input name="name" type="text" class="form-control"
                                                        aria-required="true" value="{{ $user->name }}" id="name">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                
                                                <div class="form-group label-floating ">

                                                    <input name="email" type="email" class="form-control"
                                                        aria-required="true" value="{{ $user->email }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-next btn-fill btn-rose btn-wd" value="Next"
                                        id="update">更新</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="orange">
                                    <h4 class="card-title">アサイン確認</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <tr>
                                                
                                                <th>プロジェクト名</th>
                                                <th>会社名</th>
                                                <th>合計時間</th>
                                                <th>アクション</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->getProjectOfCreator as $relate)
                                                
                                            
                                            <tr>
                                                
                                                <td>{{$relate->getProject->name}}</td>
                                                <td>{{$relate->getProject->getClient->name}}</td>
                                                <td>{{$relate->getTime()}}</td>
                                                <td>
                                                    <a href="{{route('project.index',$relate->getProject->id)}}" class="btn btn-success">ディテール</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <!-- wizard container -->
                
            </div>
        </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
    @endsection
    @push('js')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // update
            $(document).on('click', '#update', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var image = $('#avatar').prop('files')[0];

                if (name) {
                    var formData = new FormData();
                    formData.append('name', name);
                    if (image) {
                        formData.append('image', image);
                    }

                    $.ajax({
                        url: "{{ route('user.update', '') }}" + '/' + {{ $user->id }},
                        contentType: 'multipart/form-data',
                        cache: false,
                        method: 'POST', // Sử dụng phương thức POST thay vì PUT
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            swal("Good job!", "Update profile!", "success");
                        },
                        error: function(response) {
                            // Xử lý lỗi (nếu có)
                        }
                    });
                }
            });
            // Lắng nghe sự kiện khi người dùng chọn hình ảnh
        </script>
    @endpush
  
