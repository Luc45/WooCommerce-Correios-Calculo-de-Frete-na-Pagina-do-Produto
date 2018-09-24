<?php

/**
 * Debug function
 */
if (!function_exists('dd')) {
    function dd($a){echo '<pre>';var_dump($a);echo '</pre>';exit;}
}
