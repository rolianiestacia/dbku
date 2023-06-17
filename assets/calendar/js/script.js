    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];
    $(function() {
        if (!!scheds) {
            Object.keys(scheds).map(k => {
                var row = scheds[k]
                events.push({ id: row.id, title: row.event_name, start: row.start_datetime, end: row.end_datetime });
            })
        }
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,timeGridWeek,listDay',
                center: 'title',
            },
             buttonText: {
                today: 'Today',
                dayGridMonth: 'Month',
                timeGridWeek: 'Week',
                listDay: 'Day'
            },

            selectable: true,
            themeSystem: 'bootstrap',
            eventDisplay: 'block',
            contentHeight: 450,
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                
                var id = info.event.id
                if (!!scheds[id]) {

                        _details.find('#id').text(scheds[id].id)
                        _details.find('#title').text(scheds[id].event_name)
                        _details.find('#venue').text(scheds[id].room_num)
                        _details.find('#description').text(scheds[id].description)
                        _details.find('#quota').text(scheds[id].event_attendees_quota)
                        _details.find('#start').text(scheds[id].sdate)
                        _details.find('#end').text(scheds[id].edate)
                        _details.find('#endreg').text(scheds[id].erdate)
                        _details.find('#status').text(scheds[id].status)
                        _details.find('#edit,#delete').attr('data-id', id)
                        _details.modal('show')

                } 
                else {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function(info) {
                // Do Something after events mounted
            },
            editable: true
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })

        // Edit Button
        $('#edit').click(function() {
            $("#bttn").hide();
            $("#titleform").show();
            $("#showform").show();
            $("#thebutton").show();
            document.getElementById("add-edit").innerText="Edit Event";  
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form')
                console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="title"]').val(scheds[id].event_name)
                _form.find('[name="description"]').val(scheds[id].description)
                _form.find('[name="quota"]').val(scheds[id].event_attendees_quota)
                _form.find('[name="venue"]').val(scheds[id].room_num)
                _form.find('[name="status"]').val(scheds[id].status)
                _form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"))
                _form.find('[name="endreg_datetime"]').val(String(scheds[id].endreg_datetime).replace(" ", "T"))
                $('#event-details-modal').modal('hide')
                _form.find('[name="title"]').focus()
            } else {
                alert("Event is undefined");
            }
        })

         // Edit Button
        $('#edit2').click(function() {
            $("#bttn").hide();
            $("#titleform2").show();
            $("#showform2").show();
            $("#thebutton2").show();
            document.getElementById("add-edit2").innerText="Edit Reminders";  
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#reminder-form')
                console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="title"]').val(scheds[id].title)
                _form.find('[name="description"]').val(scheds[id].description)
                _form.find('[name="reminder_time"]').val(String(scheds[id].start_datetime).replace(" ", "T"))

                $('#event-details-modal3').modal('hide')
                 _form.find('[name="title"]').focus()
               
            } else {
                alert("Event is undefined");
            }
        })

        // Delete Button / Deleting an Event
        $('#delete').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this scheduled event?");
                if (_conf === true) {
                    location.href = "./delete_schedule.php?id=" + id;
                }
            } else {
                alert("Event is undefined");
            }
        })
         // Delete Button / Deleting an Event
        $('#delete2').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this reminder?");
                if (_conf === true) {
                    location.href = "./delete_schedule.php?id=" + id;
                }
            } else {
                alert("Event is undefined");
            }
        })
    })