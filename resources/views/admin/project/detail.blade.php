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
    <div class="content">
        <div class="container-fluid">
            <div class="header text-center">
                <h3 class="title">{{ $relate->getProject->name }}</h3>
                <p class="category">
                    {{ $relate->getProject->getClient->name }}

                </p>
            </div>

            <div class="row">
                <a type="button" href="{{ route('admin.index') }}" class="btn-danger btn"
                    style="float: left;margin-left: 125px">
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
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('/assets') }}/js/fullcalendar.min.js"></script>
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
                eventLimit: false,
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
                    titleSpan.textContent = title.substring(0, 10) + '...';

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


                eventClick: function(arg) {
                    var id = arg.event.id;
                    swal({
                        type: 'info',
                        html: `
                        <div class="swal2-modal swal2-show" style="display: block; width: 200px; background: rgb(255, 255, 255);">
                            <div class="swal2-content" style="display: block;font-weight:bold">仕事内容: <i class="text-warning"> ${arg.event.title}</i> </div>
                            <div class="swal2-content" style="display: block;font-weight:bold">時間:  <i class="text-success"> ${arg.event.extendedProps.hour} 時</i></div>
                        </div>`,

                    });
                },
                datesSet: function(arg) {
                    refreshTime();
                }
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
                console.log(start, end);
                var events = calendar.getEvents(); // Lấy danh sách sự kiện hiện tại
                var total = 0;

                events.forEach(function(event) {
                    if (event.extendedProps.hour) {
                        // Kiểm tra sự kiện có trong khoảng thời gian của tháng hiện tại không
                        if (event.start >= start && event.end <= end) {
                            total += event.extendedProps.hour;
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
