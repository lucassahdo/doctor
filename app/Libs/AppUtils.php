<?php

class AppUtils {

    /**
     * Active logic for menu navigation
     */
    public static function isActiveRoute($route_name, $output='active') {        
        if (Route::currentRouteName() == $route_name) {
            return $output;
        }
    }
}