<?php
if (!function_exists('activeSegment')) {
    function activeSegment($name, $segment = 0, $class = 'active')
    {
        $seg = request()->segments();

        $segment = $seg[0];

        return $segment == $name ? $class : '';
    }
}
