<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Logic\Activity\Activity;
use App\Logic\Activity\ActivityFactory;
use App\Logic\Activity\Project;
use App\Logic\Activity\Story;
use App\Logic\Activity\Task;
use App\Logic\Pomodoro;


class PomodoroController extends Controller
{
    public function listStory(Request $request)
    {
        $projectID = $request->input('projectID');
        echo json_encode(Story::getList($projectID));
        return;
    }

    public function listProjects()
    {
        $projects = Project::getList();
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
        return view('display')
                ->with('projects', Project::getList())
                ->with('stories', Story::getList())
                ->with('tasks', Task::getList());
    }

    public function addTodo(Request $request)
    {
        $taskID = $request->input('taskID');
        Pomodoro::addTodayTodo($taskID);
        echo json_encode(['status' => 'good']);
    }
}
