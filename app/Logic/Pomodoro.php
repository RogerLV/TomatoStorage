<?php

namespace App\Logic;

use DB;

class Pomodoro
{
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
            'addedTime' => date('H:i:s')
        ]);
        return true;
    }
}