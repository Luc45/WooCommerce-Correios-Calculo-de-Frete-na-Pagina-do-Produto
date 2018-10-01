<?php

namespace CFPP\Frontend;

class Template
{

    /**
    *   Enqueues CSS for the front-end
    */
    public static function include(string $template, array $data = array())
    {
        extract($data);
        include_once(CFPP_BASE_PATH.'/src/Templates/'.$template.'.php');
    }
}
