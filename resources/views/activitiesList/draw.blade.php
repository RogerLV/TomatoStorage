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
    });
</script>