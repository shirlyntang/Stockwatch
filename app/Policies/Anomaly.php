<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Anomaly extends BasePolicy
{
    use HandlesAuthorization;

    protected $model = 'anomaly';

}
