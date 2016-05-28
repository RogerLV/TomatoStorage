<?php

namespace App\Logic;

use DB;

class Pomodoro
{
    public static function getTodoTasks()
    {
        $today = date('Y-m-d');
        $rawData = DB::table('Pomodoro')
                        ->join('Task', 'Task.id', '=', 'Pomodoro.taskID')
                        ->select(
                            'Task.id', 
                            'Task.name', 
                            'Task.priority',
                            'Task.estPomos',
                            'Task.usedPomos'
                        )
                        ->where('Pomodoro.date', '=', $today)
                        ->orderBy('Pomodoro.id')
                        ->distinct()
                        ->get();
        
        $todoTasks = [];
        foreach ($rawData as $entry) {
            $todoTasks[] = get_object_vars($entry);
        }

        return $todoTasks;
    }

    public static function exists($where)
    {
        $addedTime = DB::table('Pomodoro')
                        ->select('addedTime')
                        ->where($where)
                        ->first();

        if (!empty($addedTime)) {
            return $addedTime->addedTime;
        }

        return false;
    }

    public static function addTodayTodo($taskID)
    {
        //check if it is duplicated
        $today = date('Y-m-d');
        $where = [
            ['taskID', '=', $taskID],
            ['date', '=', $today]
        ];
        if (self::exists($where)) {
            return false;
        }

        DB::table('Pomodoro')->insert([
            'date' => $today,
            'taskID' => $taskID,
            'seq' => TASK_NEWLY_ADDED,
            'addedTime' => date('H:i:s')
        ]);
        return true;
    }
}