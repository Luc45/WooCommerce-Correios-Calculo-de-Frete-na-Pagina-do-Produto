<?php

namespace CFPP\Frontend\Shipping\ShippingMethods\Traits;

use CFPP\Common\Cep;

trait WC_Correios_Webservice_Trait
{
    /**
    *   Instance of Correios Web Service
    */
    public function correiosWebService($request)
    {
        $correiosWebService = new \WC_Correios_Webservice;

        $correiosWebService->set_height($request['produto_altura']);
        $correiosWebService->set_width($request['produto_largura']);
        $correiosWebService->set_length($request['produto_comprimento']);
        $correiosWebService->set_weight($request['produto_peso']);
        $correiosWebService->set_destination_postcode($request['cep_destinatario']);
        $correiosWebService->set_origin_postcode(Cep::getOriginCep());
        $correiosWebService->set_service($this->shipping_method->get_code());

        // Valor Declarado
        $correiosWebService->set_declared_value($this->checkDeclaredValue($request['produto_preco']));

        // Mão Própria
        $correiosWebService->set_own_hands = $this->checkOwnHands();

        // Peso extra
        $correiosWebService->set_extra_weight($this->checkExtraWeight());

        // Aviso de recebimento
        $correiosWebService->set_receipt_notice($this->checkReceiptNotice());

        // Call the WebService
        $entrega = $correiosWebService->get_shipping();

        // Check if WebService response is valid
        $response = $this->checkIsValidWebServiceResponse($entrega);
        if ($response['success'] == false) {
            return array(
                'name' => $this->shipping_method->method_title,
                'status' => 'show',
                'price' => 'Prossiga com a compra normalmente para ver o preço deste método de entrega.',
                'days' => '-',
                'debug' => $response['message'],
                'additional_class' => 'cfpp_shipping_method_not_available',
                'priceColSpan' => 2
            );
        }

        // Normalize Shipping Price
        $price = $this->normalizeShippingPrice($entrega->Valor);

        // Prepara o Prazo de Entrega, com dias adicionais, se houver configurado
        $prazo = $this->prepareEstimatedDeliveryDate($entrega);
        $entrega->PrazoEntrega = $prazo['PrazoEntrega'];
        $entrega->DiasAdicionais = $prazo['DiasAdicionais'];

        // Custo Adicional
        $costs = $this->checkAdditionalCosts($price);
        $price = $costs['price'];
        $entrega->Fee = $costs['fee'];

        $return = array();

        $dia_ou_dias = (int) $entrega->PrazoEntrega > 1 ? 'dias' : 'dia';

        $return['name'] = $this->shipping_method->method_title;
        $return['price'] = 'R$ ' . number_format($price, 2, ',', '.');
        $return['days'] = 'Em até ' . (int) $entrega->PrazoEntrega . ' ' . $dia_ou_dias;
        $return['debug'] = $entrega;

        return $return;
    }

    /**
     * Check if we should add a Declared Value
     */
    private function checkDeclaredValue($preco)
    {
        if (
            property_exists($this->shipping_method, 'declare_value') &&
            $this->shipping_method->declare_value == 'yes' &&
            $preco > 18.50
        ) {
            return $preco;
        }
        return 0;
    }

    /**
     * Check if we should add Own Hands
     */
    private function checkOwnHands()
    {
        if (
            property_exists($this->shipping_method, 'own_hands') &&
            $this->shipping_method->own_hands == 'yes'
        ) {
            return 'S';
        }
        return 'N';
    }

    /**
     * Check if we should add Extra Weight
     */
    private function checkExtraWeight()
    {
        if (
            property_exists($this->shipping_method, 'extra_weight') &&
            is_numeric($this->shipping_method->extra_weight)
        ) {
            return $this->shipping_method->extra_weight;
        }
        return 0;
    }

    /**
     * Check if we should add Receipt Notice
     */
    private function checkReceiptNotice()
    {
        if (
            property_exists($this->shipping_method, 'receipt_notice') &&
            $this->shipping_method->receipt_notice == 'yes'
        ) {
            return 'S';
        }
        return 'N';
    }

    /**
     * Normalize product shipping
     */
    private function normalizeShippingPrice($price)
    {
        return floatval(str_replace(',', '.', str_replace('.', '', $price)));
    }

    /**
     * Prepare estimated delivery date, according to additional delivery days, etc
     */
    private function prepareEstimatedDeliveryDate($entrega)
    {
        $dias_adicionais = 0;
        if (
            property_exists($this->shipping_method, 'additional_time') &&
            is_numeric($this->shipping_method->additional_time)
        ) {
            $dias_adicionais = $this->shipping_method->additional_time;
        }
        return array(
            'PrazoEntrega' => $entrega->PrazoEntrega + $dias_adicionais,
            'DiasAdicionais' => $dias_adicionais
        );
    }

    /**
     * Maybe add additional costs
     */
    private function checkAdditionalCosts($price)
    {
        // Custo adicional
        $fee = 0;
        if (property_exists($this->shipping_method, 'fee') && !empty($this->shipping_method->fee)) {
            if (substr($this->shipping_method->fee, -1) == '%') {
                $porcentagem = preg_replace('/[^0-9]/', '', $this->shipping_method->fee);
                $price = ($price/100)*(100+$porcentagem);
                $fee = $porcentagem.'%';
            } else {
                $price = $price + $this->shipping_method->fee;
                $fee = $this->shipping_method->fee;
            }
        }
        return array(
            'price' => $price,
            'fee' => $fee
        );
    }

    /**
     * Check if the WebService response is valid
     */
    private function checkIsValidWebServiceResponse($response)
    {
        if (isset($response->Erro) && $response->Erro == 0) {
            return array(
                'success' => true
            );
        } else {
            return array(
                'success' => false,
                'message' => $response->MsgErro
            );
        }
    }
}
