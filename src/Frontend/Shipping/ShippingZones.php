<?php

namespace CFPP\Frontend\Shipping;

use Exception,
    WC_Shipping_Zones,
    CFPP\Frontend\Notifications;

class ShippingZones {

    /**
    *   Returns an array based on delivery zones registered on WooCommerce
    */
    public function get($cep_destination, $preco_produto, $allowed_shipping_methods)
    {
        $delivery_zones = WC_Shipping_Zones::get_zones();

        // Do we have any delivery zones?
        if (count($delivery_zones) < 1)
            wp_send_json_error('Não há Áreas de Entrega configuradas no WooCommerce. Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/');

        foreach ($delivery_zones as $key_delivery_zone => $delivery_zone) {

            // Do we have any Shipping Method on this delivery zone?
            if (count($delivery_zone['shipping_methods']) < 1)
                wp_send_json_error('Não há Métodos de Entrega configurados para a Delivery Zone "'.$key_delivery_zone.'". Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/');

            dd($delivery_zone['shipping_methods']);

            // Does the CEP participates in this delivery zone?
            $is_cep_allowed = $this->isCepAllowedInShippingZone($delivery_zone['zone_locations'], $cep_destination);

            // Loop through shipping methods of this shipping zone
            foreach ($delivery_zone['shipping_methods'] as $key => $shipping_method) {

                // Let's proccess here only the Shipping Methods we oficially support
                if (!array_key_exists(get_class($shipping_method), $allowed_shipping_methods)) {
                    continue 2;
                }

                // Local Pickup
                $metodos_de_entrega['retirar_no_local'] = $this->checkLocalPickup($shipping_method);

                // Free Shipping
                $metodos_de_entrega['frete_gratis'] = $this->checkFreeShipping($shipping_method, $preco_produto);

                // O método atual está habilitado?
                if ($shipping_method->enabled != 'yes') {
                    continue;
                } else {
                    dd($shipping_method);
                    $metodos_de_entrega['shipping_methods'][] = [
                        'title' => $shipping_method->title,
                        'code' => $shipping_method->get_code(),
                        'additional_time' => $shipping_method->additional_time,
                        'receipt_notice' => $shipping_method->receipt_notice,
                        'declare_value' => $shipping_method->declare_value,
                        'own_hands' => $shipping_method->own_hands,
                        'fee' => $shipping_method->fee,
                        'extra_weight' => $shipping_method->extra_weight,
                        'cep_destinatario_permitido' => $is_cep_allowed
                    ];
                }

            }
        }

        if (empty($metodos_de_entrega['shipping_methods']))
            wp_send_json_error('Não foi possível encontrar um método de entrega compatível com o WooCommerce Correios Cálculo de Frete na Página do Produto.');

        return $metodos_de_entrega;
    }

    /**
    *   Recebe um CEP e retorna true se pertencer à um determinado estado
    */
    public function isCepFromState($cep, $estado) {

        $cep = substr($cep, 0, 5); // 5 primeiros dígitos
        $cep = (int)$cep;

        switch ($estado) {
            case ('AC'): if ($cep > 69900 && $cep < 69999) return true; break;
            case ('AL'): if ($cep > 57000 && $cep < 57999) return true; break;
            case ('AP'): if ($cep > 68900 && $cep < 68999) return true; break;
            case ('AM'): if ($cep > 69400 && $cep < 69899) return true; break;
            case ('BA'): if ($cep > 40000 && $cep < 48999) return true; break;
            case ('CE'): if ($cep > 60000 && $cep < 63999) return true; break;
            case ('CE'): if ($cep > 60000 && $cep < 63999) return true; break;
            case ('DF'): if ($cep > 70000 && $cep < 73699) return true; break;
            case ('ES'): if ($cep > 29000 && $cep < 29999) return true; break;
            case ('GO'): if ($cep > 72800 && $cep < 76799) return true; break;
            case ('MA'): if ($cep > 65000 && $cep < 65999) return true; break;
            case ('MT'): if ($cep > 78000 && $cep < 78899) return true; break;
            case ('MS'): if ($cep > 79000 && $cep < 79999) return true; break;
            case ('MG'): if ($cep > 30000 && $cep < 39999) return true; break;
            case ('PA'): if ($cep > 66000 && $cep < 68899) return true; break;
            case ('PB'): if ($cep > 58000 && $cep < 58999) return true; break;
            case ('PR'): if ($cep > 80000 && $cep < 87999) return true; break;
            case ('PE'): if ($cep > 50000 && $cep < 56999) return true; break;
            case ('PI'): if ($cep > 64000 && $cep < 64999) return true; break;
            case ('RJ'): if ($cep > 20000 && $cep < 28999) return true; break;
            case ('RN'): if ($cep > 59000 && $cep < 59999) return true; break;
            case ('RS'): if ($cep > 90000 && $cep < 99999) return true; break;
            case ('RO'): if ($cep > 78900 && $cep < 78999) return true; break;
            case ('RR'): if ($cep > 69300 && $cep < 69389) return true; break;
            case ('SC'): if ($cep > 88000 && $cep < 89999) return true; break;
            case ('SP'): if ($cep > 01000 && $cep < 19999) return true; break;
            case ('SE'): if ($cep > 49000 && $cep < 49999) return true; break;
            case ('TO'): if ($cep > 77000 && $cep < 77995) return true; break;
            default:
                return false;
        }
    }

    private function isCepAllowedInShippingZone($delivery_zones, $cep_destinatario)
    {
        foreach ($delivery_zones as $zone_location) {
            switch ($zone_location->type) {
                case 'country':
                        // Pais: Brasil
                        if ($zone_location->code == 'BR')
                            return true;
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
                                    return true;
                                }
                            }
                            continue;
                        }
                        // É um wildcard?
                        if (strpos($zone_location->code, '*') !== false) {
                            $before_wildcard = strtok($zone_location->code, '*');
                            $tamanho_string = strlen($before_wildcard);
                            if (substr($cep_destinatario, 0, $tamanho_string) == $before_wildcard) {
                                return true;
                            }
                        } else {
                            // É uma comparação literal?
                            if ($cep_destinatario == $zone_location->code) {
                                return true;
                            }
                        }
                    }
                    break;
                case 'state':
                    // Estados específicos
                    $tmp = explode(':', $zone_location->code);
                    if ($tmp[0] == 'BR') {
                        if ($this->isCepFromState($cep_destinatario, $tmp[1])) {
                            return true;
                        }
                    }
                    break;
            }
        }
        return false;
    }

    /**
     * Check if Local Pickup is available
     */
    private function checkLocalPickup($shipping_method)
    {
        return get_class($shipping_method) == 'WC_Shipping_Local_Pickup' && $shipping_method->enabled == 'yes';
    }

    /**
     * Check if Free Shipping is available
     */
    private function checkFreeShipping($shipping_method, $preco_produto)
    {
        if (get_class($shipping_method) == 'WC_Shipping_Free_Shipping') {
            if (empty($shipping_method->requires)) {
                return true;
            } elseif ($shipping_method->requires == 'min_amount' || $shipping_method->requires == 'either') {
                if (is_numeric($shipping_method->min_amount)) {
                    if ($preco_produto > $shipping_method->min_amount) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
