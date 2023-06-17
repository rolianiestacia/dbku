    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];
    $(function() {
        if (!!scheds) {
            Object.keys(scheds).map(k => {
                var row = scheds[k]
                events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime, color:row.color });
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
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                var _details2 = $('#event-details-modal2')
                var _details3 = $('#event-details-modal3')

                var id = info.event.id
                if (!!scheds[id]) {
                    if(scheds[id].type=='task')
                    {
                        _details2.find('#title2').text(scheds[id].title)
                        _details2.find('#description2').text(scheds[id].description)
                        _details2.find('#start2').text(scheds[id].sdate)
                        _details2.modal('show')

                    }
                    else if(scheds[id].type=='reminder')
                    {
                        _details3.find('#title3').text(scheds[id].title)
                        _details3.find('#description3').text(scheds[id].description)
                        _details3.find('#start3').text(scheds[id].sdate)
                        _details3.find('#edit2,#delete2').attr('data-id', id)
                        _details3.modal('show')
                    }
                    else{
                        _details.find('#title').text(scheds[id].title)
                        _details.find('#description').text(scheds[id].description)
                        _details.find('#start').text(scheds[id].sdate)
                        _details.find('#end').text(scheds[id].edate)
                        _details.find('#edit,#delete').attr('data-id', id)
                        _details.modal('show')
                    }
                } else {
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
                _form.find('[name="title"]').val(scheds[id].title)
                _form.find('[name="description"]').val(scheds[id].description)
                _form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"))
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