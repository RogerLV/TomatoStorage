<?php

namespace App\Logic\Activity;

use App\Logic\Util;

abstract class Activity
{
    protected $tableName;
    abstract public function save();

    protected function dataMissing()
    {
    	Util::returnError('Data Missing');
    }
}