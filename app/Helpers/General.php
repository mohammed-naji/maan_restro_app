<?php

function Active($resource)
{
    return request()->routeIs($resource.'.index') || request()->routeIs($resource.'.create') || request()->routeIs($resource.'.edit') ? 'active' : '';
}
