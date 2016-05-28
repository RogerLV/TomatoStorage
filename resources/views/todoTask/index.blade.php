<h2>Today's task</h2>
<br>
<table class="table">
    <thead>
        <th>TaskID</th>
        <th>Name</th>
        <th>Priority</th>
        <th>Est. Pomos</th>
        <th>Used Pomos</th>
    </thead>
    <tbody>
        @foreach ($todoTasks as $entry)
            <tr>
                <td>{{ $entry['id'] }}</td>
                <td>{{ $entry['name'] }}</td>
                <td>{{ $entry['priority'] }}</td>
                <td>{{ $entry['estPomos'] }}</td>
                <td>{{ $entry['usedPomos'] }}</td>
                <td>
                    <button class="btn btn-primary btn-xs complete-pomo"
                            data-taskid="{{ $entry['id'] }}">Complete Pomo</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $('button.complete-pomo').click(function(){
        var taskID = $(this).data('taskid');
        $.ajax({
            url: "{{ url('completePomo') }}",
            data: {taskID, taskID},
            type: 'POST',
            success: function(data){
                data = $.parseJSON(data);
                if ('good' == data.status) {
                    location.reload();
                }
            }
        });
    });
</script>