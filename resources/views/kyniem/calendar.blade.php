@extends('layouts/template2/layout')
@section('title_page','Lịch')

@section('body')
    <div id="calendar"></div>
@endsection

@section('custom_js')
    <script src="/assets/bower_components/bootstrap-year-calendar/js/bootstrap-year-calendar.js"></script>
    <script>
        if($('#calendar').length == 1){
            var currentYear = new Date().getFullYear();
            $('#calendar').calendar({
                enableContextMenu: true,
                enableRangeSelection: true,
                selectRange: function (e) {
                    editEvent({startDate: e.startDate, endDate: e.endDate});
                },
                mouseOutDay: function(e) {
                    if(e.events.length > 0) {
                        $(e.element).popover('hide');
                    }
                },
                mouseOnDay: function (e) {
                    if (e.events.length > 0) {
                        var content = '';

                        for (var i in e.events) {
                            content += '<div class="event-tooltip-content">'
                                + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                                + '<div class="event-location">' + e.events[i].location + '</div>'
                                + '</div>';
                        }

                        $(e.element).popover({
                            trigger: 'manual',
                            container: 'body',
                            html: true,
                            content: content
                        });

                        $(e.element).popover('show');
                    }
                },
                dataSource: []
            })
            $.post('/get_calendar', function (data) {
                var data_d = [];
                $.each(data,function(k,v){
                    data_d[k] =
                        {
                            id: k,
                            name: v.name,
                            location: v.location,
                            startDate: new Date(v.year, v.month-1, v.date),
                            endDate: new Date(v.year, v.month-1, v.date)
                        };
                })
                $('.calendar').calendar().setDataSource(data_d);
            })
        }



    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-year-calendar/css/bootstrap-year-calendar.css">
@endsection
