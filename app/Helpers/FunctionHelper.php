<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FunctionHelper {

    public static function get_rec($table, $arr = array()) {
        $rec = DB::table($table)->where(array($arr['matching_field'] => $arr['value']))->get();
        return $rec;
    }

    public static function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }

}
