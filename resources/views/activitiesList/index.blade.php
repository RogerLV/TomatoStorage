<h2>Activities List</h2>

<button class="btn btn-primary btn-xs" 
        data-toggle="modal" data-target="#add-activity-modal">Add Story</button>
<br>
<br>

@include('activitiesList.draw')

@include('activitiesList.addActivityModal')

@include('activitiesList.addActivityJS')