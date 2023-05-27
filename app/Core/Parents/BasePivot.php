<?php

namespace Core\Parents;

use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

abstract class BasePivot extends BaseModel
{
    use AsPivot;

    public    $incrementing = false;
    protected $guarded = [];
}
