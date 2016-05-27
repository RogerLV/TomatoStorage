<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

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

    public function newStory(Request $request)
    {
        if (empty($projectID = $request->input('projectID'))
            || empty($newStoryName = $request->input('newStoryName'))) {
            echo json_encode([
                'status' => 'error',
                'message' => 'data error'
            ]);
            return;
        }

        $id = DB::table('Story')->insertGetId([
            'name' => $request->input('newStoryName'),
            'projectID' => $request->input('projectID')
        ]);

        echo json_encode([
            'status' => 'good',
            'id' => $id
        ]);
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

        // //get all task info
        // $rawData = DB::table('Project')
        //             ->join('Story', 'Project.id', '=', 'Story.projectID')
        //             ->join('Task', 'Story.id', '=', 'Task.storyID')
        //             ->select(
        //                 'Project.name',
        //                 'Story.name',
        //                 'Task.id',
        //                 'Task.name',
        //                 'Task.priority',
        //                 'Task.estPomo',
        //                 'Task.usedPomo'
        //             )
        //             ->get();
        // $taskInfo = [];
        // foreach ($rawData as $entry) {
        //     $taskInfo[$entry]
        // }
        return view('display')
                ->with('projects', $this->getProjectList())
                ->with('stories', $stories);
    }
}
