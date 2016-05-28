<div id="activity-list">
    @foreach ($projects as $projectID => $projectName)
        <h4>{{ $projectName }}</h4>

        <div data-projectid="{{ $projectID }}">
            @if (isset($stories[$projectID]))
            @foreach ($stories[$projectID] as $storyID => $storyName)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $storyName }}</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Name</th>
                                <th>Priority</th>
                                <th>Est. Pomos</th>
                                <th>Used Pomos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($tasks[$storyID]))
                            @foreach ($tasks[$storyID] as $taskID => $taskInfo)
                                <tr>
                                    <td>{{ $taskID }}</td>
                                    <td>{{ $taskInfo['name'] }}</td>
                                    <td>{{ $taskInfo['priority'] }}</td>
                                    <td>{{ $taskInfo['estPomos'] }}</td>
                                    <td>{{ $taskInfo['usedPomos'] }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs add-to-do" 
                                                data-taskid="{{ $taskID }}">Do it!</button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endforeach
            @endif


        </div>
    @endforeach
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#activity-list').accordion();

        $('button.add-to-do').click(function(){
            var taskID = $(this).data('taskid');
            $.ajax({
                url: "{{ url('addTodo') }}",
                data: {taskID: taskID},
                type: 'POST',
                success: function(data){
                    data = $.parseJSON(data);
                    if ('good' == data.status) {
                        location.reload();
                    }
                }
            });
        });
    });
</script>