<?php

namespace App\Logic\Activity;

abstract class Activity
{
    protected $tableName;
    abstract public function save();
}