<?php

namespace CFPP\Common;

class Sanitize
{

    /**
    *   Sanitizes a Shipping Cost Ajax Request from CFPP
    */
    public static function cfppShippingCostAjaxRequest(array $post)
    {
        $sanitized_post = array();

        $sanitized_post['destination_postcode'] = preg_replace('/[^0-9]/', '', $post['destination_postcode']);
        $sanitized_post['height'] = filter_var($post['height'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['width'] = filter_var($post['width'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['length'] = filter_var($post['length'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['weight'] = filter_var($post['weight'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['price'] = filter_var($post['price'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['id'] = filter_var($post['id'], FILTER_VALIDATE_INT);
        $sanitized_post['quantity'] = filter_var($post['quantity'], FILTER_VALIDATE_INT);
        $sanitized_post['cfpp_nonce'] = preg_replace('/[^0-9a-zA-Z]/', '', $post['cfpp_nonce']);

        return $sanitized_post;
    }
}
