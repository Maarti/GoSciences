$(document).ready(init_timepicker);

function init_timepicker(){
    $('input.timepicker').timepicker({
                        timeFormat: 'HH:mm',
                        interval: 15,
                        minTime: '08:00',
                        maxTime: '22:00',
                        defaultTime: '18:30',
                        startTime: '08:00',
                        dynamic: false,
                        dropdown: true,
                        scrollbar: true
                });
}