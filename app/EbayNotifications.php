<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class EbayNotifications extends Eloquent {

    protected $collection = 'EbayNotifications';

}
