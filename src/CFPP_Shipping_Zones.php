<?php

class CFPP_Shipping_Zones {

    /**
    *   Retorna a lista de métodos de entrega
    */
    public function get_metodos_de_entrega($cep_destinatario) {

        $metodos_de_entrega = [];

        $delivery_zones = WC_Shipping_Zones::get_zones();

        // Temos zonas de entrega?
        if (count($delivery_zones) < 1) {
            $metodos_de_entrega['erro'] = 'Não há Áreas de Entrega configuradas no WooCommerce. Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/';
            return $metodos_de_entrega;
        }

        // Inicia o array de métodos de entrega desta delivery_zone
        $metodos_de_entrega = [
            'retirar_no_local' => '',
            'shipping_methods' => []
        ];

        // Temos. Temos algum dos métodos de entrega suportados lá?
        foreach ($delivery_zones as $key_delivery_zone => $delivery_zone) {

            // Temos efetivamente algum Shipping Method cadastrado nesta Delivery Zone?
            if (count($delivery_zone['shipping_methods']) < 1) {
                $metodos_de_entrega['erro'] = 'Não há Áreas de Entrega configuradas no WooCommerce. Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/';
                return $metodos_de_entrega;
            }

            // O CEP informado participa desta delivery zone?
            $cep_destinatario_permitido = false;
            foreach ($delivery_zone['zone_locations'] as $zone_location) {
                switch ($zone_location->type) {
                    case 'country':
                            // Pais: Brasil
                            if ($zone_location->code == 'BR')
                                $cep_destinatario_permitido = true;
                        break;
                    case 'postcode':
                        // CEPs Específicos
                        // Vamos dar um foreach nas linhas
                        $ceps = explode(PHP_EOL, $zone_location->code);
                        foreach ($ceps as $key => $value) {
                            // É um range?
                            if (strpos($zone_location->code, '...') !== false) {
                                $ranges = explode('...', $value);
                                if (count($ranges) == 2 && is_numeric($ranges[0]) && is_numeric($ranges[1])) {
                                    if ($cep_destinatario > (int) $ranges[0] && $cep_destinatario < (int) $ranges[1]) {
                                        $cep_destinatario_permitido = true;
                                    }
                                }
                                continue;
                            }
                            // É um wildcard?
                            if (strpos($zone_location->code, '*') !== false) {
                                $before_wildcard = strtok($zone_location->code, '*');
                                $tamanho_string = strlen($before_wildcard);
                                if (substr($cep_destinatario, 0, $tamanho_string) == $before_wildcard) {
                                    $cep_destinatario_permitido = true;
                                }
                            } else {
                                // É uma comparação literal?
                                if ($cep_destinatario == $zone_location->code) {
                                    $cep_destinatario_permitido = true;
                                }
                            }
                        }
                        break;
                    case 'state':
                        // Estados específicos
                        $tmp = explode(':', $zone_location->code);
                        if ($tmp[0] == 'BR') {
                            if ($this->is_cep_from_state($cep_destinatario, $tmp[1])) {
                                $cep_destinatario_permitido = true;
                            }
                        }
                        break;
                }

            }

            // Loop pelas shipping zones
            foreach ($delivery_zone['shipping_methods'] as $key => $shipping_method) {
                // Retirar no local?
                if (get_class($shipping_method) == 'WC_Shipping_Local_Pickup') {
                    if ($shipping_method->enabled == 'yes' && $cep_destinatario_permitido) {
                        $metodos_de_entrega['retirar_no_local'] = 'sim';
                    }
                    continue;
                }
                // Queremos sobrescrever os métodos permitidos?
                if (defined('WOO_CORREIOS_SHIPPING_METHODS') && is_array(WOO_CORREIOS_SHIPPING_METHODS)) {
                    $allowed_shipping_methods = WOO_CORREIOS_SHIPPING_METHODS;
                } else {
                    $allowed_shipping_methods = ['WC_Correios_Shipping_PAC', 'WC_Correios_Shipping_SEDEX'];
                }
                // O método atual é permitido?
                if (!in_array(get_class($shipping_method), $allowed_shipping_methods)) {
                    continue;
                } else {
                    // O método atual está habilitado?
                    if ($shipping_method->enabled != 'yes') {
                        continue;
                    } else {
                        $metodos_de_entrega['shipping_methods'][] = [
                            'title' => $shipping_method->title,
                            'code' => $shipping_method->get_code(),
                            'additional_time' => $shipping_method->additional_time,
                            'receipt_notice' => $shipping_method->receipt_notice,
                            'declare_value' => $shipping_method->declare_value,
                            'own_hands' => $shipping_method->own_hands,
                            'fee' => $shipping_method->fee,
                            'extra_weight' => $shipping_method->extra_weight,
                            'cep_destinatario_permitido' => $cep_destinatario_permitido
                        ];
                    }
                }
            }
        }

        if (empty($metodos_de_entrega['shipping_methods'])) {
            $metodos_de_entrega['erro'] = 'Não foi possível encontrar um método de entrega compatível com o WooCommerce Correios Cálculo de Frete na Página do Produto. Métodos compatíveis: '.implode(', ', $allowed_shipping_methods);
            return $metodos_de_entrega;
        } else {
            return $metodos_de_entrega;
        }

    }

    /**
    *   Recebe um CEP e retorna true se pertencer à um determinado estado
    */
    public function is_cep_from_state($cep, $estado) {

        $cep = substr($cep, 0, 5); // 5 primeiros dígitos
        $cep = (int)$cep;

        switch ($estado) {
            case ('AC'):
                if ($cep > 69900 && $cep < 69999)
                    return true;
                break;
            case ('AL'):
                if ($cep > 57000 && $cep < 57999)
                    return true;
                break;
            case ('AP'):
                if ($cep > 68900 && $cep < 68999)
                    return true;
                break;
            case ('AM'):
                if ($cep > 69400 && $cep < 69899)
                    return true;
                break;
            case ('BA'):
                if ($cep > 40000 && $cep < 48999)
                    return true;
                break;
            case ('CE'):
                if ($cep > 60000 && $cep < 63999)
                    return true;
                break;
            case ('CE'):
                if ($cep > 60000 && $cep < 63999)
                    return true;
                break;
            case ('DF'):
                if ($cep > 70000 && $cep < 73699)
                    return true;
                break;
            case ('ES'):
                if ($cep > 29000 && $cep < 29999)
                    return true;
                break;
            case ('GO'):
                if ($cep > 72800 && $cep < 76799)
                    return true;
                break;
            case ('MA'):
                if ($cep > 65000 && $cep < 65999)
                    return true;
                break;
            case ('MT'):
                if ($cep > 78000 && $cep < 78899)
                    return true;
                break;
            case ('MS'):
                if ($cep > 79000 && $cep < 79999)
                    return true;
                break;
            case ('MG'):
                $debug[] = 'MG';
                if ($cep > 30000 && $cep < 39999)
                    return true;
                break;
            case ('PA'):
                if ($cep > 66000 && $cep < 68899)
                    return true;
                break;
            case ('PB'):
                if ($cep > 58000 && $cep < 58999)
                    return true;
                break;
            case ('PR'):
                if ($cep > 80000 && $cep < 87999)
                    return true;
                break;
            case ('PE'):
                if ($cep > 50000 && $cep < 56999)
                    return true;
                break;
            case ('PI'):
                if ($cep > 64000 && $cep < 64999)
                    return true;
                break;
            case ('RJ'):
                if ($cep > 20000 && $cep < 28999)
                    return true;
                break;
            case ('RN'):
                if ($cep > 59000 && $cep < 59999)
                    return true;
                break;
            case ('RS'):
                if ($cep > 90000 && $cep < 99999)
                    return true;
                break;
            case ('RO'):
                if ($cep > 78900 && $cep < 78999)
                    return true;
                break;
            case ('RR'):
                if ($cep > 69300 && $cep < 69389)
                    return true;
                break;
            case ('SC'):
                if ($cep > 88000 && $cep < 89999)
                    return true;
                break;
            case ('SP'):
                if ($cep > 01000 && $cep < 19999)
                    return true;
                break;
            case ('SE'):
                if ($cep > 49000 && $cep < 49999)
                    return true;
                break;
            case ('TO'):
                if ($cep > 77000 && $cep < 77995)
                    return true;
                break;
            default:
                return false;
        }
    }

}
