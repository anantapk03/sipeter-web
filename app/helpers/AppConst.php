<?php

namespace App\Helpers;

class AppConst{
    public const LABEL = 'label';
    public const DATA = 'data';
    public const BORDER_COLOR = 'borderColor';
    public const BACKGROUND_COLOR = 'backgroundColor';
    public const POINT_BACKGROUND_COLOR = 'pointBackgroundColor';
    public const POINT_HOVER_RADIUS = 'pointHoverRadius';
    public const POINT_RADIUS = 'pointRadius';

    public static function randomColor()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);

        return "rgb($r, $g, $b)";
    }

    public static function randomColorWithOpacity($opacity = 0.25)
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);

        return "rgba($r, $g, $b, $opacity)";
    }
}