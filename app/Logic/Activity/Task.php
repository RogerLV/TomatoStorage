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

            $this->dataMissing();
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

    public static function getList()
    {
        $rawData = DB::table('Task')
                        ->select(
                            'Task.id',
                            'Task.name',
                            'Task.priority',
                            'Task.estPomos',
                            'Task.usedPomos',
                            'Task.storyID'
                        )
                        ->get();
        $tasks = [];
        foreach ($rawData as $entry) {
            $tasks[$entry->storyID][$entry->id] = [
                'name' => $entry->name,
                'priority' => $entry->priority,
                'estPomos' => $entry->estPomos,
                'usedPomos' => $entry->usedPomos
            ];
        }

        return $tasks;
    }
}