<?php

namespace App\Logic\Activity;

class ActivityFactory
{
    public static function create($activityInfo)
    {
        switch ($activityInfo['activityType']) {
            case ACTIVITY_TYPE_PROJECT:
                return new Project($activityInfo);

            case ACTIVITY_TYPE_STORY:
                return new Story($activityInfo);

            case ACTIVITY_TYPE_TASK:
                return new Task($activityInfo);

            default:
                // TODO: policies and algorithms should be seperated.
                echo json_encode([
                    'status' => 'bad',
                    'message' => "Incorrect Activity Type"
                ]);
                exit;
        }
    }
}