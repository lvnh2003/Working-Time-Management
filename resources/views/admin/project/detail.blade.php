@extends('user.layout.main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="header text-center">
                <h3 class="title">Project A</h3>
                <p class="category">
                    X company

                </p>
            </div>

            <div class="row">
                <div class="col-md-3" style="margin: auto;float: right;margin-right: 114px">
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
    <script src="{{ asset('assets/js/ja.global.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
    start: '2023-06-01', // Ngày bắt đầu hợp lệ
    end: '2023-06-30' // Ngày kết thúc hợp lệ
  },
                locale: 'ja',
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true, // allow "more" link when too many events
                expandRows: true,
                eventLimit: false,
                eventContent: function(arg) {
                    var title = arg.event.title;
                    var hour = arg.event.extendedProps.hour;

                    var eventDivContent = document.createElement('div');
                    eventDivContent.classList.add('text-content');
                    eventDivContent.textContent = "Nội dung"
                    var eventDivHour = document.createElement('div');
                    eventDivHour.classList.add('text-content');
                    eventDivHour.textContent = "Thời gian"
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
                        type: 'question',
                        html: `
                        <div class="swal2-modal swal2-show" style="display: block; width: 500px; padding: 20px; background: rgb(255, 255, 255);">
                            <h2>What do you want?</h2>
                            <div class="swal2-content" style="display: block;">You will not be able to recover this imaginary file!</div>
                        </div>`,
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-warning',
                        confirmButtonText: 'Delete it!',
                        cancelButtonText: "Update it!",
                        buttonsStyling: false
                    }).then((result) => {
                        swal({
                            type: 'warning',
                            html: `
                            <div class="swal2-modal swal2-show" style="display: block; width: 500px; padding: 20px; background: rgb(255, 255, 255);">
                                <h2>What do you want?</h2>
                                <div class="swal2-content" style="display: block;">You will not be able to recover this imaginary file!</div>
                            </div>`,
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            confirmButtonText: 'Yes, Delete it!',
                            cancelButtonText: "No, keep it!",
                            buttonsStyling: false
                        }).then((result) => {

                            $.ajax({
                                url: "{{ route('project.destroy', '') }}" +
                                    '/' + id,
                                type: "DELETE",
                                dataType: 'json',
                                success: function(response) {
                                    arg.event.remove();
                                    swal("Good job!", "Event Deleted!",
                                        "success");
                                },
                                error: function(error) {
                                    console.log(error)
                                },
                            });
                        });


                    }).catch(() => {
                        swal({
                            type: 'info',
                            title: 'Update an Event',
                            html: `<div class="card-content">
                                    <div class="form-group label-floating">
                                        <input class="form-control" name="title" type="text" email="true" placeholder="Content.." id="title" required="true" autocomplete="off" value="${arg.event.title}">
                                    </div>
                                    <div class="form-group label-floating">
                                        <input class="form-control" name="hour" min="1" max="24" type="number" placeholder="Time.." required="true" id="hour" autocomplete="off" value="${arg.event.extendedProps.hour}">
                                    </div>
                                </div>`,
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            buttonsStyling: false
                        }).then((result) => {
                            var hour = $('#hour').val();
                            var title = $('#title').val();
                            $.ajax({
                                url: "{{ route('project.update', '') }}" +
                                    '/' + id,
                                method: 'PUT',
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

                                    swal("Good job!", "Update time!",
                                        "success");
                                },
                                error: function(error) {
                                    swal("Error!", error.message, "error");
                                },
                            });
                        })
                    })

                },
            });

            calendar.render();
            // go to event wanna follow
            $(document).on('click', '#dateBtn', function() {
                calendar.gotoDate($("#dateField").val());
            });
        });
    </script>
@endpush
