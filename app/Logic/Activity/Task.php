<?php

namespace App\Logic\Activity;

use DB;

class Task extends Activity
{
    private $storyID;
    private $name;
    private $priority;
    private $estPomos;

    public function __construct($info)
    {
        if (empty($info['storyID'])
            || empty($info['activityName'])
            || empty($info['priority'])
            || empty($info['estPomos'])) {

            // TODO: policies and algorithms should be seperated.
            echo json_encode([
                'status' => 'bad',
                'message' => "Data Missed"
            ]);
            exit;
        }

        $this->storyID = $info['storyID'];
        $this->name = $info['activityName'];
        $this->priority = $info['priority'];
        $this->estPomos = $info['estPomos'];
        $this->tableName = 'Task';
    }

    public function save()
    {
        DB::table($this->tableName)
            ->insert([
                'name' => $this->name,
                'priority' => $this->priority,
                'estPomos' => $this->estPomos,
                'storyID' => $this->storyID
        ]);
    }
}