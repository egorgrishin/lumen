<?php

namespace Core\Parents;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseAction
{
    /**
     * @template Task
     * @param class-string<Task> $abstract
     * @return Task
     */
    public function task(string $abstract): BaseTask
    {
        try {
            return Container::getInstance()->make($abstract);
        } catch (BindingResolutionException) {
            return new $abstract;
        }
    }
}
