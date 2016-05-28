<?php

namespace App\Logic\Activity;

use App\Logic\Util;

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
                Util::returnError("Incorrect Activity Type");
        }
    }
}