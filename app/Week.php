<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    public static function getTotalWeeksNumber()
    {
        return self::max('id');
    }
}
