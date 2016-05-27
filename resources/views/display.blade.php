<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <script type="text/javascript" src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <title>Tomato Storage</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
            <h2>Activities List</h2>
            <div id="activity-list">
                @foreach($projects as $projectID => $projectName)
                    <h4>{{ $projectName }}</h4>
                    <div data-projectid="{{ $projectID }}">
                        <button class="btn btn-primary btn-xs show-modal" 
                            data-toggle="modal" data-target="#add-story-modal">Add Story</button>
                    </div>
                    <!-- <div class="panel panel-default">
                        <div class="panel-heading">Panel heading</div>
                        <table class="table"></table>
                    </div> -->

                    
                @endforeach
            </div>

            <div class="modal fade" id="add-story-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4>Add New Story</h4>
                        </div>

                        <div class="modal-body">
                            <h4 id="project-name-in-modal"></h4>
                            <input type="text" id="new-story-name">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" id="add-story">Add</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <h2>Today's task</h2>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        var projectID = 0;
        $('#activity-list').accordion();

        $('#add-story').click(function(){
            var newStoryName = $('#new-story-name').val();

            //ajax to add  new story
            $.ajax({
                url: "{{ url('newstory') }}",
                data: {
                    projectID: projectID,
                    newStoryName: newStoryName
                },
                type: "POST",
                success: function(data){
                    console.log(data);
                }
            });
        });

        $('#add-story-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            projectID = button.parent().data('projectid');
            var projectName = button.parent().prev().text();

            $('#project-name-in-modal').text(projectName);
        });
    });
</script>