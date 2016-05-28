<?php

namespace App\Logic\Activity;

use DB;

class Story extends Activity
{
    private $projectID;
    private $name;
    private $priority;

    public function __construct($info)
    {
        // var_dump($info['projectID'], $info['activityname'], $info['priority']); exit;
        if (empty($info['projectID']) 
            || empty($info['activityName'])
            || empty($info['priority'])) {

            // TODO: policies and algorithms should be seperated.
            echo json_encode([
                'status' => 'bad',
                'message' => "Data Missed"
            ]);
            exit;
        }

        $this->projectID = $info['projectID'];
        $this->name = $info['activityName'];
        $this->priority = $info['priority'];
        $this->tableName = 'Story';
    }

    public function save()
    {
        DB::table($this->tableName)
            ->insert([
                'name' => $this->name,
                'priority' => $this->priority,
                'projectID' => $this->projectID
        ]);
    }
}