    @extends('user.layout.main')
    @push('css')
        <style>
            .container {
                margin: 20px auto;
                max-width: 800px;
            }
            .col-md-3 {
                margin: auto;
                float: right;
                margin-right: 114px;
            }
            .form-group {
                position: relative;
            }

            /* .form-group input[type="date"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            } */
            h1 {
                margin-top: 50px;
                text-align: center;
            }

            .project-list {
                margin-top: 100px;
            }

            .project {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 10px;
                background-color: white;
                min-height: 140px;
                box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4);


            }

            .project h2 {
                margin: 0;
                font-size: 24px;
                margin-bottom: 10px;

                margin: -20px 15px 0;
                border-radius: 3px;
                padding: 15px;
                background: linear-gradient(60deg, #26c6da, #00acc1);
                box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4);
                position: relative;
                color: white
            }

            .project .project-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .project .project-info .project-name {
                font-weight: bold;
                font-size: 16px;
            }

            .project .project-info .total-time {
                font-size: 14px;
            }

            .users {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .user {
                width: 48%;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
            }

            .user img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
            }

            .user .detail {
                display: flex;
                flex-direction: column
            }

            .user .detail span {
                font-size: 14px;
            }

            .user .detail .total-time {
                font-weight: bold;
            }

            .float-r {
                float: right
            }
        </style>
    @endpush
    @section('content')
        @include('user.layout.navbar')
        <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="5debe795-bb7b-2b9a-0eff-7f7668fb62a0">

            <div class="container">
                <h2 class="text-center">プロジェクトリスト</h2>
                <div class="col-md-3" style="margin: auto;float: right;">
                    <div class="form-group">
                        <input type="date" id="dateField" class="form-control">
                        <span class="material-input"></span>
                    </div>
                    <button type="button" id="dateBtn" class="btn-warning btn" style="float: right;">
                        検索
                        <span class="btn-label">
                            <i class="material-icons">search</i>
                        </span>
                    </button>
                </div>
                
                <br>
                <div class="project-list">

                </div>
            </div>


        </div>
    @endsection
    @push('js')
        <script>
            var dateInput = $('#dateField');
            var currentDate = moment().format('YYYY-MM-DD');
            dateInput.val(currentDate);
            $(document).ready(function() {
                // Lấy phần tử có class 'project-list'
                var projectList = $('.project-list');

                // Lặp qua mỗi dự án
                @foreach ($client->getProject as $project)
                    // Tạo phần tử dự án
                    var project = $('<div>').addClass('project');

                    // Tạo phần tử chứa thông tin dự án
                    var projectInfo = $('<div>').addClass('project-info');
                    project.append(projectInfo);

                    // Thêm tên dự án vào phần tử thông tin dự án
                    var projectName = $('<h2>').text('{{ $project->name }}');
                    projectInfo.append(projectName);

                    // Thêm phần tử tổng thời gian vào phần tử thông tin dự án
                    var projectTime = $('<div>').addClass('total-time-' + '{{ $project->id }}').text('合計時間：' +
                        '{{ $project->getTotalTimeProject() }}');
                    projectInfo.append(projectTime);

                    // Tạo phần tử danh sách người dùng
                    var userList = $('<div>').addClass('users');
                    project.append(userList);

                    // Lặp qua mỗi người dùng trong dự án
                    @foreach ($project->getRelate as $relate)
                        // Tạo phần tử người dùng
                        var user = $('<div>').addClass('user');
                        user.data('user-id', '{{ $relate->getCreator->id }}');
                        // Tạo input chứa giá trị idProject
                        var inputHidden = $('<input>').attr('value', '{{ $project->id }}').attr('type', 'hidden')
                            .addClass('idProject');
                        user.append(inputHidden);

                        // Thêm hình ảnh avatar vào phần tử người dùng
                        
                        var userAvatar = $('<img>').attr('src', '{{ $relate->getCreator->getAvatar() ? $relate->getCreator->getAvatar() : $avatar_default }}').attr('alt',
                            'Avatar');
                        user.append(userAvatar);

                        // Tạo phần tử chi tiết người dùng
                        var userDetail = $('<div>').addClass('detail');

                        // Thêm tên người dùng vào phần tử chi tiết người dùng
                        var userName = $('<span>').text('{{ $relate->getCreator->name }}');
                        userDetail.append(userName);
                        // Thêm thời gian tổng của người dùng vào phần tử chi tiết người dùng
                        var userTotalTime = $('<span>').addClass('total-time').text(
                            '{{ $relate->getCreator->getToTalTime($project->id) }}'+'時間');
                        userDetail.append(userTotalTime);

                        // Thêm phần tử chi tiết người dùng vào phần tử người dùng
                        user.append(userDetail);

                        // Thêm phần tử người dùng vào danh sách người dùng
                        userList.append(user);
                    @endforeach

                    // Thêm phần tử dự án vào danh sách dự án
                    projectList.append(project);
                @endforeach

                $('#dateBtn').click(function() {
                    var date = $('#dateField').val();
                    // swal("Searching","Please wait...","success");
                    demo.showSwal('auto-close', 'ちょっと待って')
                    updateTotalTime(date);
                });

                function updateTotalTime(selectedDate) {
                    // Lặp qua mỗi người dùng trong dự án
                    $('.user').each(function() {
                        var idUser = $(this).data('user-id');
                        var idProject = $(this).find('.idProject').val();
                        var totalTimeElement = $(this).find('.total-time');
                        // Gửi yêu cầu AJAX để lấy dữ liệu getTotalTime từ máy chủ dựa trên ngày được chọn
                        var url =
                            "{{ route('getTotalTimeWithDate', ['idUser' => ':idUser', 'idProject' => ':idProject', 'date' => ':selectedDate']) }}";
                        url = url.replace(':idUser', idUser).replace(':idProject', idProject).replace(
                            ':selectedDate', selectedDate)

                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                totalTimeElement.text(response.total+'時間');
                                $('.total-time-' + idProject).text('合計時間：' + response.totalProject);
                            },
                            error: function() {
                                console.log('Lỗi khi lấy dữ liệu getTotalTime từ máy chủ');
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
