<?php

include "AbstractShoppe.php";

class Shop extends AbstractShoppe
{
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

}
