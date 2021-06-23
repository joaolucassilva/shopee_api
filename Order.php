<?php

include "AbstractShoppe.php";

class Order extends AbstractShoppe
{
    /**
     * Rotina para Buscar Lista de Vendas.
     * Order API
     * Use this api to search orders.
     * URL:https://partner.shopeemobile.com/api/v2/order/get_order_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/get_order_list
     * @method GET
     */
    public function getOrderList($params)
    {
        $path = '/api/v2/order/get_order_list';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $paramsQuery = [
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId,
            'access_token' => $this->accessToken,
            'sign' => $sign,
            'timestamp' => $timestamp,
            'time_range_field' => $params['time_range_field'],
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'page_size' => $params['page_size'],
        ];

        if (!empty($params['cursor'])) {
            $paramsQuery['cursor'] = $params['cursor'];
        }

        if (!empty($params['order_status'])) {
            $paramsQuery['order_status'] = $params['order_status'];
        }

        if (!empty($params['response_optional_fields'])) {
            $paramsQuery['response_optional_fields'] = $params['response_optional_fields'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($paramsQuery);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Lista de Vendas Prontas para Envio
     * Order API
     * Use this api to get order list which order_status is READY_TO_SHIP
     * URL:https://partner.shopeemobile.com/api/v2/order/get_shipment_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/get_shipment_list
     * @method GET
     */
    public function getOrderShipmentList($params)
    {
        $path = '/api/v2/order/get_shipment_list';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'page_size' => $params['page_size']
        ];

        if (!empty($params['cursor'])) {
            $queryParams['cursor'] = $params['cursor'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Detalhes da Venda
     * Order API
     * Use this api to get order detail.
     * URL:https://partner.shopeemobile.com/api/v2/order/get_order_detail
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/get_order_detail
     * @method GET
     */
    public function getOrderDetail($params)
    {
        $path = '/api/v2/order/get_order_detail';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'order_sn_list' => $params['order_sn_list']
        ];

        if (!empty($params['response_optional_fields'])) {
            $queryParams['response_optional_fields'] = $params['response_optional_fields'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Cancelar Venda
     * Order API
     * Use this api to cancel an order
     * URL:https://partner.shopeemobile.com/api/v2/order/cancel_order
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/cancel_order
     * @method POST
     */
    public function cancelOrder($params)
    {
        $path = '/api/v2/order/cancel_order';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina Aceitar Cancelamento de Compra
     * Order API
     * Use this api to handle buyer's cancellation application
     * URL:https://partner.shopeemobile.com/api/v2/order/handle_buyer_cancellation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/handle_buyer_cancellation
     * @method POST
     */
    public function handleBuyerCancelledOrder($params)
    {
        $path = '/api/v2/order/handle_buyer_cancellation';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para setar Anotações na Venda
     * Order API
     * Use this api to set note for an order
     * URL:https://partner.shopeemobile.com/api/v2/order/set_note
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/order/set_note
     * @method POST
     */
    public function setNoteOrder($params)
    {
        $path = '/api/v2/order/set_note';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'POST', $params);
    }
}