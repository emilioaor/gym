function birthdayCalendar(element, events) {
    $(element).fullCalendar({
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'today' 
        },
        editable: false,
        weekends:true,
        selectable: true,
        height:560,
        displayEventTime:false,
        events: events,
        /*eventClick: function (event, jsEvent, view) {
            $('#imgMember').attr('src', event.image)
            $('#nameMember').html(event.title)
            $('#dateMember').html(event.start._i)
            $('#modalBirthdayCalendar').modal('show')
        },*/
    });
}