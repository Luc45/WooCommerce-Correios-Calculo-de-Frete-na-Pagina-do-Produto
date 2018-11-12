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
        $sanitized_post['id'] = filter_var($post['id'], FILTER_VALIDATE_INT);
        $sanitized_post['quantity'] = filter_var($post['quantity'], FILTER_VALIDATE_INT);
        $sanitized_post['cfpp_nonce'] = preg_replace('/[^0-9a-zA-Z]/', '', $post['cfpp_nonce']);

        if (!empty($post['selected_variation'])) {
            $selected_variation = json_decode(stripslashes($post['selected_variation']));
            if (json_last_error() === JSON_ERROR_NONE) {
                $sanitized_post['selected_variation'] = $selected_variation;
            }
        }

        if (!empty($post['variation_data'])) {
            $variation_data = json_decode(stripslashes($post['variation_data']));
            if (json_last_error() === JSON_ERROR_NONE) {
                $sanitized_post['variation_data'] = $variation_data;
            }
        }

        return $sanitized_post;
    }
}
