<?php

include 'AbstractShoppe.php';

class Logistics extends AbstractShoppe
{
    /*    public function __construct()
        {
            parent::__construct();
        }*/

    /**
     * Rotina para obter o parametro de envio de determinado
     * Logistics API
     * Use this api to get shipping parameter.
     * URL:https://partner.shopeemobile.com/api/v2/logistics/get_shipping_parameter
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/logistics/get_shipping_parameter
     * @method GET
     */
    public function getShippingParameter($orderId)
    {
        $path = '/api/v2/logistics/get_shipping_parameter';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'order_id' => $orderId,
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign
            ]
        );

        $url = $this->defaultBaseUrl . $path . "?" . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para buscar e obter o numero de rastreamento de uma venda ao enviar.
     * Logistics API.
     * Use this api to get tracking_number when you have shipped order.
     * URL:https://partner.shopeemobile.com/api/v2/logistics/get_tracking_number
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/logistics/get_tracking_number
     * @method GET
     */
    public function getTrackingNumber($params)
    {
        $path = '/api/v2/logistics/get_tracking_number';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $paramsQuery = [
            'order_sn' => $params['order_sn'],
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign
        ];

        if (!empty($params['package_number'])) {
            $paramsQuery['package_number'] = $params['package_number'];
        }

        if (!empty($params['response_optional_fields'])) {
            $paramsQuery['response_optional_fields'] = $params['response_optional_fields'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($paramsQuery);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para obter as informações do envio, status do envio.
     * Logistics API.
     * Use this api to get the logistics tracking information of an order.
     * URL:https://partner.shopeemobile.com/api/v2/logistics/get_tracking_info
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/logistics/get_tracking_info
     * @method GET
     */
    public function getTrackingInfo($params)
    {
        $path = '/api/v2/logistics/get_tracking_info';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $paramsQuery = [
            'order_sn' => $params['order_sn'],
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign
        ];

        if (!empty($params['package_number'])) {
            $paramsQuery['package_number'] = $params['package_number'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($paramsQuery);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para obtenção da etiqueta para impressão do envio da venda.
     * Logistics API
     * Use this api to get the logistics tracking information of an order
     * URL:https://partner.shopeemobile.com/api/v2/logistics/get_shipping_document_info
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/logistics/get_shipping_document_info
     * @method GET
     */
    public function getShippingDocumentInfo($params)
    {
        $path = '/api/v2/logistics/get_shipping_document_info';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $paramsQuery = [
            'order_sn' => $params['order_sn'],
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        if (!empty($params['package_number'])) {
            $paramsQuery['package_number'] = $params['package_number'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($paramsQuery);
        return $this->sendCurl($url, 'GET');
    }
}