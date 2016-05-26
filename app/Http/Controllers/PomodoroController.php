<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PomodoroController extends Controller
{
    //
    public function display()
    {
        //first select all projects
        $rawData = DB::table('Project')
                        ->select('id', 'name')
                        ->get();
        $projects = [];
        foreach ($rawData as $entry) {
            $projects[$entry->id] = $entry->name;
        }
        // echo "<pre>"; var_dump($projects); exit;

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
                ->with('projects', $projects);
    }
}
