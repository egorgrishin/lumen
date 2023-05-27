<?php

namespace Core\Parents;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Lumen\Routing\Controller;

abstract class BaseController extends Controller
{
    /**
     * @template Action
     * @param class-string<Action> $abstract
     * @return Action
     */
    public function action(string $abstract): BaseAction
    {
        try {
            return Container::getInstance()->make($abstract);
        } catch (BindingResolutionException) {
            return new $abstract;
        }
    }
}
