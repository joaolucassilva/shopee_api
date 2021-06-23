<?php

include "AbstractShoppe.php";

class Shop extends AbstractShoppe
{
    public function getShopsByPartner($params)
    {
        $path = '/api/v2/public/get_shops_by_partner';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $path . $timestamp);

        $queryParams = [
            'page_size' => 1,
            'page_no' => 1,
            'partner_id' => $this->partnerId,
            'sign' => $sign,
            'timestamp' => $timestamp
        ];

        if (!empty($params['page_size'])) {
            $queryParams['page_size'] = $params['page_size'];
        }

        if (!empty($params['page_no'])) {
            $queryParams['page_no'] = $params['page_no'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Perfil da Loja
     * Shop API
     * Use this call to get information of shop
     * URL:https://partner.shopeemobile.com/api/v2/shop/get_shop_info
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop/get_shop_info
     * @method GET
     */
    public function getShopInfo()
    {
        $path = '/api/v2/shop/get_shop_info';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Perfil da Loja
     * Shop API
     * This API support to get information of shop.
     * URL:https://partner.shopeemobile.com/api/v2/shop/get_profile
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop/get_profile
     * @method GET
     */
    public function getProfile()
    {
        $path = '/api/v2/shop/get_profile';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Atualizar Perfil da Loja
     * Shop API
     * This API support to let sellers to update the shop name, shop logo, and shop description
     * URL:https://partner.shopeemobile.com/api/v2/shop/update_profile
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop/update_profile
     * @method POST
     */
    public function updateProfile($params)
    {
        $path = '/api/v2/shop/update_profile';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Buscar Penalidades da Loja
     * AccountHealth API
     * This API To get the information of shop penalty.
     * URL:https://partner.shopeemobile.com/api/v2/account_health/shop_penalty
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/account_health/shop_penalty
     * @method GET
     */
    public function getShopPenalty()
    {
        $path = '/api/v2/account_health/shop_penalty';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Buscar Métricas da Loja
     * AccountHealth API
     * This API The data metrics of shop performance
     * URL:https://partner.shopeemobile.com/api/v2/account_health/shop_performance
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/account_health/shop_performance
     * @method GET
     */
    public function getShopPerformance()
    {
        $path = '/api/v2/account_health/shop_performance';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Retornar detalhes
     * Returns API
     * Use this api to get detail information of a return by return id.
     * URL:https://partner.shopeemobile.com/api/v2/returns/get_return_detail
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/returns/get_return_detail
     * @method GET
     */
    public function getReturnDetail($params)
    {
        if (empty($params['return_sn'])) {
            return 'Parametro return_sn não encontrado';
        }
        $path = '/api/v2/returns/get_return_detail';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId,
            'access_token' => $this->accessToken,
            'sign' => $sign,
            'timestamp' => $timestamp
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Retornar Lista
     * Returns API
     * Use this api to get detail information of many return by shop id.
     * URL:https://partner.shopeemobile.com/api/v2/returns/get_return_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/returns/get_return_list
     * @method GET
     */
    public function getReturnList($params)
    {
        if (empty($params['return_sn'])) {
            return 'Parametro return_sn não encontrado';
        }
        $path = '/api/v2/returns/get_return_list';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId,
            'access_token' => $this->accessToken,
            'sign' => $sign,
            'timestamp' => $timestamp
        ];

        if ($params['create_time_from']) {
            $queryParams['create_time_from'] = $params['create_time_from'];
        }

        if ($params['create_time_to']) {
            $queryParams['create_time_to'] = $params['create_time_to'];
        }


        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'GET');
    }

    /**
     * Confirmar Retorno
     * Returns API
     * Use this api to Confirm return
     * URL:https://partner.shopeemobile.com/api/v2/returns/confirm
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/returns/confirm
     * @method POST
     */
    public function confirm($params)
    {
        if (empty($params['return_sn'])) {
            return 'Parametro return_sn não encontrado';
        }
        $path = '/api/v2/returns/confirm';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId,
            'access_token' => $this->accessToken,
            'sign' => $sign,
            'timestamp' => $timestamp
        ];


        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Returns API
     * Use this api to Dispute return
     * URL:https://partner.shopeemobile.com/api/v2/returns/dispute
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/returns/dispute
     * @method POST
     */
    public function dispute($params)
    {
        if (empty($params['return_sn'])) {
            return 'Parametro return_sn não encontrado';
        }
        $path = '/api/v2/returns/dispute';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId,
            'access_token' => $this->accessToken,
            'sign' => $sign,
            'timestamp' => $timestamp
        ];


        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);
        return $this->sendCurl($url, 'POST', $params);
    }

}
