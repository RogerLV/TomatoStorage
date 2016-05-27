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

            <button class="btn btn-primary btn-xs" 
                    data-toggle="modal" data-target="#add-activity-modal">Add Story</button>
            <br>
            <br>

            <div id="activity-list">
                @foreach ($projects as $projectID => $projectName)
                    <h4>{{ $projectName }}</h4>

                    <div data-projectid="{{ $projectID }}">
                        @if (isset($stories[$projectID]))
                        @foreach ($stories[$projectID] as $storyID => $storyName)
                            <div class="panel panel-default">
                                <div class="panel-heading">{{ $storyName }}</div>
                                <table class="table"></table>
                            </div>
                        @endforeach
                        @endif

        
                    </div>
                @endforeach
            </div>

            <div class="modal fade" id="add-activity-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4>Add New Activity</h4>
                        </div>

                        <div class="modal-body">
                            <div class="well well-sm">
                                <label for="select-activity-type" class="control-label">Add Type</label>
                                <select class="form-control" id="select-activity-type">
                                    <option value=0 disabled selected></option>
                                    <option value="project">Project</option>
                                    <option value="story">Story</option>
                                    <option value="task">Task</option>
                                </select>

                                <label for="select-project" class="control-label">Select Project</label>
                                <select disabled class="form-control modal-input story task" id="select-project"></select>

                                <label for="select-story" class="control-label">Select Story</label>
                                <select disabled class="form-control modal-input" id="select-story"></select>
                            </div>

                            <div class="well well-sm">
                                <label for="fill-activity-name" class="control-label">Activity Name</label>
                                <input disabled class="form-control modal-input project story task" id="fill-activity-name">

                                <label for="fill-activity-priority" class="control-label">Priority</label>
                                <input disabled class="form-control modal-input story task" type="number" id="fill-activity-priority">

                                <label for="fill-est-pomos" class="control-label">Estimated Pomodoros</label>
                                <input disabled class="form-control modal-input task" type="number" id="fill-est-pomos">
                            </div>
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

        $('#activity-list').accordion();

        var createLevel = null;

        var resetDisabledInput = function(){
            $('#add-activity-modal').find('.modal-input').prop('disabled', true);
        };

        var assembleOption = function(returnData, selector){
            var optionStr = "<option disabled selected></option>";
            $.each(returnData, function(id, name){
                optionStr += "<option value='"+id+"'>"+name+"</option>";
            });
            selector.empty().append(optionStr);
        }

        $('#add-activity-modal').on('show.bs.modal', function(event){
            resetDisabledInput();
            $('#select-activity-type').val(0);
        });

        $('#select-activity-type').change(function(){
            resetDisabledInput();
            createLevel = $(this).val();

            // enable related inputs
            $('#add-activity-modal').find('.modal-input.'+createLevel).prop('disabled', false);
            
            if (createLevel != 'project') {
                // get project list
                $.ajax({
                    url: "{{ url('getProjectList') }}",
                    type: 'GET',
                    success: function(data){
                        var data = $.parseJSON(data);
                        assembleOption(data, $('#select-project'));
                    }
                });
            }
        });

        $('#select-project').change(function(){
            // check create level
            if ('task' != createLevel) {
                return;
            }

            // enable story selector
            $('#select-story').prop('disabled', false);

            // get story values
            var projectID = $(this).val();

            $.ajax({
                url: "{{ url('getStoryList') }}",
                data: {projectID: projectID},
                type: 'GET',
                success: function(data){
                    var data = $.parseJSON(data);
                    assembleOption(data, $('#select-story'));
                }
            });
        });
    });
</script>