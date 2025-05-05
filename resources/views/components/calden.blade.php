<style>
    .calendar-widget {
    width: 250px;
    height: 250px;
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #fff;
    border-radius: 8px;
}
</style>
    <div class="dashboard">
        <!-- Other dashboard content -->

        <!-- Calendar Widget Section -->
        <div class="calendar-widget">
            <div id="calendar" style="width: 250px; height: 250px;"></div>
        </div>

        <!-- Additional dashboard content -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: [],
                dayRender: function(date, cell) {
                    if (date.isSame(new Date(), 'day')) {
                        cell.css("background-color", "#ff6347"); // Bubble color
                        cell.append('<div style="width: 10px; height: 10px; border-radius: 50%; background-color: #fff; position: absolute; top: 10px; left: 10px;"></div>');
                    }
                },
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                editable: false,
                droppable: false
            });
        });
    </script>

