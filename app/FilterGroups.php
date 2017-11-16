<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class FilterGroups extends Eloquent {
    protected $collection = 'filter_groups';

}
