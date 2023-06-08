@extends('user.layout.main')
@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .fc-event {
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
            height: 100px;
            width: 100%;
        }

        .control-label {
            position: relative;
            float: left;
        }

        .text-content {
            float: left
        }

        .fc-daygrid-event-harness {
            margin: 5px
        }

        .fc-list-event-title {
            width: 100%
        }
    </style>
@endpush
@section('content')
    @include('user.layout.navbar')
    <div class="content">
        <div class="container-fluid">
            <div class="header text-center">
                <h3 class="title">{{ $project->name }}</h3>
                <p class="category">
                    {{ $project->getClient->name }}

                </p>
            </div>

            <div class="row">
                <a type="button" href="{{ route('home') }}" class="btn-danger btn" style="float: left;margin-left: 125px">
                    ホーム
                    <span class="btn-label">
                        <i class="material-icons">keyboard_return</i>
                    </span>
                </a>
                <div class="col-md-3" style="margin: auto;float: right;margin-right: 114px">
                    <h4 style="font-weight: bold" id="totalHour">

                    </h4>
                    <input type="date" id="dateField" class="form-control" />
                    <button type="button" id="dateBtn" class="btn-warning btn" style="float: right;">
                        検索
                        <span class="btn-label">
                            <i class="material-icons">search</i>
                        </span>
                    </button>

                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="card card-calendar">
                        <div class="card-content">
                            <div id="fullCalendar" class="fc fc-unthemed fc-ltr">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script> --}}
    <script src="{{ asset('assets/js/ja.global.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dateInput = $('#dateField');
        var currentDate = moment().format('YYYY-MM-DD');
        var nextDate = moment(currentDate).add(1, 'days').format('YYYY-MM-DD');
        dateInput.val(currentDate);
        var times = @json($events);
        var totalHour = $('#totalHour');
        var idWork = {{ $id }};
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('fullCalendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: '100%',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                validRange: {
                    end: nextDate // Ngày kết thúc hợp lệ
                },
                locale: 'ja',
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true, // allow "more" link when too many events
                expandRows: true,
                events: times,
                eventContent: function(arg) {
                    var title = arg.event.title;
                    var hour = arg.event.extendedProps.hour;

                    var eventDivContent = document.createElement('div');
                    eventDivContent.classList.add('text-content');
                    eventDivContent.textContent = "内容："
                    var eventDivHour = document.createElement('div');
                    eventDivHour.classList.add('text-content');
                    eventDivHour.textContent = "時間："
                    var brItem = document.createElement('br');
                    var eventDiv = document.createElement('div');

                    // Tạo phần tử span chứa tiêu đề
                    var titleSpan = document.createElement('span');
                    titleSpan.title = title;
                    titleSpan.classList.add('fc-title');
                    titleSpan.textContent = title.lenght > 10 ? title.substring(0, 10) + '...' : title

                    // Tạo phần tử span chứa mô tả
                    var hourSpan = document.createElement('span');

                    hourSpan.classList.add('fc-hour');
                    hourSpan.textContent = hour;

                    // Thêm tiêu đề và mô tả vào phần tử sự kiện
                    eventDiv.appendChild(eventDivContent);
                    eventDiv.appendChild(titleSpan);
                    eventDiv.appendChild(brItem);
                    eventDiv.appendChild(eventDivHour);
                    eventDiv.appendChild(hourSpan);
                    let arrayOfDomNodes = [eventDiv]
                    return {
                        domNodes: arrayOfDomNodes
                    }

                },
                // add new event
                select: function(start) {
                    swal({
                        type: 'info',
                        title: '稼働時間を入力します。',
                        html: `<div class="card-content">
                        <div class="form-group label-floating">
                            
                            <input class="form-control" name="title" type="text" email="true" placeholder="内容.." id="title" required="true" autocomplete="off">
                        </div>
                        <div class="form-group label-floating">
                            
                            <input class="form-control" name="hour" min="1" max="24" type="number" placeholder="時間.." required="true" id="hour" autocomplete="off">
                        </div>
                        
                        
                    </div>`,
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        confirmButtonText: 'はい!',
                        cancelButtonText: "滅ぼす!",
                        buttonsStyling: false
                    }).then((result) => {
                        var hour = $('#hour').val();
                        var title = $('#title').val();

                        var start_date = start.startStr;
                        var end_date = start.endStr;
                        $.ajax({
                            url: "{{ route('project.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                hour,
                                title,
                                idWork,
                                start_date,
                                end_date
                            },
                            success: function(response) {
                                calendar.addEvent({
                                    'id': response.id,
                                    'title': response.title,
                                    'hour': response.hour,
                                    'start': response.start,
                                    'end': response.end,
                                })

                                swal("完了!", "作品内容を追加!", "success");
                                refreshTime();
                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors
                                        .title);
                                }
                            },
                        })
                    }).catch((error) => {
                        console.log(error);
                    });

                },
                // move date event
                eventDrop: function(arg) {
                    var id = arg.event.id;
                    var start_date = moment(arg.event.start).format('YYYY-MM-DD');

                    var end_date = moment(arg.event.end).format('YYYY-MM-DD');
                    $.ajax({
                        url: "{{ route('project.update', '') }}" + '/' + id,
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            swal("完了!", "更新されたジョブ内容!", "success");
                            refreshTime();
                        },
                        error: function(error) {
                            swal("Error!", error, "error");
                        },
                    });

                },

                eventClick: function(arg) {
                    var id = arg.event.id;
                    swal({
                        type: 'question',
                        html: `
                            <div class="swal2-modal swal2-show" style="display: block; width: 500px; padding: 20px; background: rgb(255, 255, 255);">
                                <h2>何を達成したいですか?</h2>
                                <div class="swal2-content" style="display: block;">不可逆的な変更後のコンテンツ!</div>
                            </div>`,
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-warning',
                        confirmButtonText: '削除!',
                        cancelButtonText: "更新!",
                        buttonsStyling: false
                    }).then((result) => {
                        swal({
                            type: 'warning',
                            html: `
                                <div class="swal2-modal swal2-show" style="display: block; width: 500px; padding: 20px; background: rgb(255, 255, 255);">
                                    <h2>確かですか?</h2>
                                    <div class="swal2-content" style="display: block;">不可逆的な変更後のコンテンツ!</div>
                                </div>`,
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            confirmButtonText: 'はい!',
                            cancelButtonText: "滅ぼす!",
                            buttonsStyling: false
                        }).then((result) => {

                            $.ajax({
                                url: "{{ route('project.destroy', '') }}" +
                                    '/' + id,
                                type: "DELETE",
                                dataType: 'json',
                                success: function(response) {
                                    arg.event.remove();
                                    swal("完了!", "削除された作業内容!",
                                        "success");
                                    refreshTime(arg);
                                },
                                error: function(error) {
                                    console.log(error)
                                },
                            });
                        });


                    }).catch(() => {
                        swal({
                            type: 'warning',
                            title: '作業内容の更新',
                            html: `<div class="card-content">
                                        <div class="form-group label-floating">
                                            <input class="form-control" name="title" type="text" placeholder="内容.." id="title" required="true" autocomplete="off" value="${arg.event.title}">
                                        </div>
                                        <div class="form-group label-floating">
                                            <input class="form-control" name="hour" min="1" max="24" type="number" placeholder="時間.." required="true" id="hour" autocomplete="off" value="${arg.event.extendedProps.hour}">
                                        </div>
                                    </div>`,
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            confirmButtonText: 'はい!',
                            cancelButtonText: "滅ぼす!",
                            buttonsStyling: false
                        }).then((result) => {
                            var hour = $('#hour').val();
                            var title = $('#title').val();
                            $.ajax({
                                url: "{{ route('project.update', '') }}" +
                                    '/' + id,
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    hour,
                                    title,
                                },
                                success: function(response) {
                                    arg.event.setProp('title', response
                                        .title);
                                    arg.event.setExtendedProp('hour',
                                        response.hour);

                                    swal("完了!", "更新されたジョブ内容!",
                                        "success");
                                    refreshTime(arg);
                                },
                                error: function(error) {
                                    swal("Error!", error.message, "error");
                                },
                            });
                        })
                    })

                },
                datesSet: function(arg) {
                    refreshTime();

                },
            });

            calendar.render();

            function refreshTime() {

                var currentView = calendar.view;
                var monthView = calendar.view.type === 'dayGridMonth';
                if (monthView) {
                    var month = (calendar.view.currentStart).getMonth() + 1;
                    var currentStart = currentView.currentStart;
                    var currentEnd = currentView.currentEnd;
                    totalHours = calculateTotalHours(currentStart, currentEnd);
                    totalHour.text(month + 'ヶ月の合計時間: ' + totalHours + '時');
                }


            }

            function calculateTotalHours(start, end) {
                var events = calendar.getEvents();
                var total = 0;
                events.forEach(function(event) {
                    if (event.extendedProps.hour) {
                        if (event.start >= start && event.end <= end) {
                            total += parseInt(event.extendedProps.hour);
                        }


                    }
                });
                return total;
            }
            // go to event wanna follow
            $(document).on('click', '#dateBtn', function() {
                calendar.gotoDate($("#dateField").val());
            });
        });
    </script>
@endpush
