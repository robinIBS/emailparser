<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class FilterKeywords extends Eloquent {
    protected $collection = 'filter_keywords';

}
