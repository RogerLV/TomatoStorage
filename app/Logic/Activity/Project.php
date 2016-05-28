<?php

namespace App\Logic\Activity;

use DB;

class Project extends Activity
{
    private $name;

    public function __construct($info)
    {
        if (empty($info['activityName'])) {
            $this->dataMissing();
        }

        $this->name = $info['activityName'];
        $this->tableName = 'Project';
    }

    public function save()
    {
        DB::table($this->tableName)
            ->insert(['name' => $this->name]);
    }

    public static function getList()
    {
        $rawData = DB::table('Project')
                ->select('id', 'name')
                ->get();
        $projects = [];
        foreach ($rawData as $entry) {
            $projects[$entry->id] = $entry->name;
        }

        return $projects;
    }
}