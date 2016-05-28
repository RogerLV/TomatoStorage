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
                    <label for="input-activity-name" class="control-label">Activity Name</label>
                    <input disabled class="form-control modal-input project story task" id="input-activity-name">

                    <label for="input-activity-priority" class="control-label">Priority</label>
                    <input disabled class="form-control modal-input story task" type="number" id="input-activity-priority">

                    <label for="input-est-pomos" class="control-label">Estimated Pomodoros</label>
                    <input disabled class="form-control modal-input task" type="number" id="input-est-pomos">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="btn-add-activity">Add</button>
            </div>
        </div>
    </div>
</div>