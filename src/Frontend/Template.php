<?php

namespace CFPP\Frontend;

class Template
{

    /**
    *   Enqueues CSS for the front-end
    */
    public static function include($template, array $data = array())
    {
        // String type-hinting for older versions of PHP
        if (gettype($template) != 'string') return;

        extract($data);
        include_once(CFPP_BASE_PATH.'/src/Templates/'.$template.'.php');
    }
}
