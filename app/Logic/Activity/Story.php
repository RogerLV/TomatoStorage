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
        if (empty($info['projectID']) 
            || empty($info['activityName'])
            || empty($info['priority'])) {

            $this->dataMissing();
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

    public static function getList($projectID = null)
    {
        $queryByProject = false;

        $query = DB::table('Story')
                    ->select(
                        'Story.id',
                        'Story.name',
                        'Story.priority',
                        'Story.projectID'
                    );

        if (!is_null($projectID)) {
            $query = $query->where('projectID', '=', $projectID);
            $queryByProject = true;
        }
        $rawData = $query->get();

        $stories = [];
        foreach ($rawData as $entry) {
            $stories[$entry->projectID][$entry->id] = $entry->name;
        }

        return $queryByProject ? $stories[$projectID] : $stories;
    }
}