<script type="text/javascript">
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
        if ('task' != $('#select-activity-type').val()) {
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

    $('#btn-add-activity').click(function(){
        $.ajax({
            url: "{{ url('addActivity') }}",
            data: {
                activityType: $('#select-activity-type').val(),
                projectID: $('#select-project').val(),
                storyID: $('#select-story').val(),
                activityName: $('#input-activity-name').val(),
                priority: $('#input-activity-priority').val(),
                estPomos: $('#input-est-pomos').val()
            },
            type: 'POST',
            success: function(data){
                data = $.parseJSON(data);
                if ('good' == data.status) {
                    location.reload();
                } else {
                    var div = "<div class='alert alert-danger'>"+data.message+"</div>";
                    $('#add-activity-modal').find('div.modal-content').prepend(div);
                    setTimeout(function(){
                        $('.alert').hide('slow', function(){
                            $(this).remove();
                        });
                    }, 2000);
                }
            }
        });
    });
</script>