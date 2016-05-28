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
            </tr>
        @endforeach
    </tbody>
</table>