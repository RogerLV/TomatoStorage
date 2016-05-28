<?php

namespace App\Logic;

use DB;

class Pomodoro
{
    public static function completePomo($taskID)
    {
        // get used Pomos in task table
        // this part should be get from object
        $entry = DB::table('Task')
                    ->select('usedPomos')
                    ->where('id', '=', $taskID)
                    ->first();
        $usedPomos = $entry->usedPomos;
        $usedPomos++;

        // update DB: Task table update usedPomos
        DB::table('Task')
            ->where('id', '=', $taskID)
            ->update(['usedPomos' => $usedPomos]);

        // update DB: Pomodoro table insert record
        DB::table('Pomodoro')->insert([
            'date' => date('Y-m-d'),
            'taskID' => $taskID,
            'seq' => $usedPomos,
            'addedTime' => date('H:i:s')
        ]);

    }

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