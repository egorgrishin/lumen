<?php

namespace Core\Parents;

use Illuminate\Queue\SerializesModels;

abstract class BaseEvent
{
    use SerializesModels;
}
