<?php

namespace WebDirectory\admin\app\actions;

abstract class Action
{
    abstract public function __invoke($request, $response, $args);

}