<?php

namespace App\Logic\Activity;

use DB;

class Project extends Activity
{
    private $name;

    public function __construct($info)
    {
        if (empty($info['activityName'])) {

            // TODO: policies and algorithms should be seperated.
            echo json_encode([
                'status' => 'bad',
                'message' => "Data Missed"
            ]);
            exit;
        }

        $this->name = $info['activityName'];
        $this->tableName = 'Project';
    }

    public function save()
    {
        DB::table($this->tableName)
            ->insert(['name' => $this->name]);
    }
}