<?php

namespace CFPP\Common;

class Sanitize {

    /**
    *   Sanitizes a Shipping Cost Ajax Request from CFPP
    */
    public static function cfppShippingCostAjaxRequest(array $post)
    {
        $sanitized_post = array();

        $sanitized_post['cep_origem'] = preg_replace('/[^0-9]/', '', $post['cep_origem']);
        $sanitized_post['produto_altura'] = filter_var($post['produto_altura'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['produto_largura'] = filter_var($post['produto_largura'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['produto_comprimento'] = filter_var($post['produto_comprimento'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['produto_peso'] = filter_var($post['produto_peso'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['produto_preco'] = filter_var($post['produto_preco'], FILTER_VALIDATE_FLOAT);
        $sanitized_post['id_produto'] = filter_var($post['id_produto'], FILTER_VALIDATE_INT);

        return $sanitized_post;
    }

}
