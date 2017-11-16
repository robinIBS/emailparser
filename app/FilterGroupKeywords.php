<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class FilterGroupKeywords extends Eloquent {
    protected $collection = 'filter_group_keywords';

}
