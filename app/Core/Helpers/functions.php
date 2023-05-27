<?php

if (!function_exists('route_action')) {
    function route_action(array $action): string
    {
        return implode('@', $action);
    }
}