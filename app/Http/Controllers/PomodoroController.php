<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Logic\Activity\Activity;
use App\Logic\Activity\ActivityFactory;


class PomodoroController extends Controller
{
    private function getProjectList()
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

    public function listStory(Request $request)
    {
        $projectID = $request->input('projectID');

        $rawData = DB::table('Story')
                    ->select('id', 'name')
                    ->where('projectID', '=', $projectID)
                    ->get();

        $stories = [];
        foreach ($rawData as $entry) {
            $stories[$entry->id] = $entry->name;
        }

        echo json_encode($stories);
        return;
    }

    public function listProjects()
    {
        $projects = $this->getProjectList();
        echo json_encode($projects);
        return;
    }

    public function addActivity(Request $request)
    {
        $activityInfo = $request->all();
        $activity = ActivityFactory::create($activityInfo);
        $activity->save();

        echo json_encode(['status' => 'good']);
    }

    public function display()
    {
        // get stories info
        $rawData = DB::table('Story')
                    ->join('Project', 'Project.id', '=', 'Story.projectID')
                    ->select(
                        'Story.id',
                        'Story.name',
                        'Story.projectID'
                    )
                    ->get();
        $stories = [];
        foreach ($rawData as $entry) {
            $stories[$entry->projectID][$entry->id] = $entry->name;
        }

        //get all task info

        return view('display')
                ->with('projects', $this->getProjectList())
                ->with('stories', $stories);
    }
}
