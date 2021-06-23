<?php

include "AbstractShoppe.php";

class ShopCategory extends AbstractShoppe
{
    /**
     * ShopCategory API
     * Use this call to add a new shop collection
     * URL:https://partner.shopeemobile.com/api/v2/shop_category/add_shop_category
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop_category/add_shop_category
     * @method POST
     */
    public function addShopCategory($params = [])
    {
        $path = '/api/v2/shop_category/add_shop_category';
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
     * ShopCategory API
     * Use this call to get list of shop categories
     * URL:https://partner.shopeemobile.com/api/v2/shop_category/get_shop_category_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop_category/get_shop_category_list
     * @method GET
     */
    public function getShopCategoryList($params = [])
    {
        $path = '/api/v2/shop_category/get_shop_category_list';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $this->accessToken . $this->shopId
        );

        $query = http_build_query(
            [
                "page_size" => $params['page_size'],
                "page_no" => $params['page_no'],
                "partner_id" => $this->partnerId,
                "timestamp" => $timestamp,
                "access_token" => $this->accessToken,
                "shop_id" => $this->shopId,
                "sign" => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        return $this->sendCurl($url, 'GET', $params);
    }

    /**
     * ShopCategory API
     * Use this call to delete a existing shop collection
     * URL:https://partner.shopeemobile.com/api/v2/shop_category/delete_shop_category
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop_category/delete_shop_category
     * @method POST
     */
    public function deleteShopCategory($params)
    {
        $path = '/api/v2/shop_category/delete_shop_category';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );
        $query = http_build_query(
            [
                "partner_id" => $this->partnerId,
                "timestamp" => $timestamp,
                "access_token" => $this->accessToken,
                "shop_id" => $this->shopId,
                "sign" => $sign,
            ]
        );
        $url = $this->defaultBaseUrl . $path . '?' . $query;

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * ShopCategory API
     * Use this call to update a existing collection
     * URL:https://partner.shopeemobile.com/api/v2/shop_category/update_shop_category
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/shop_category/update_shop_category
     * @method POST
     */
    public function updateShopCategory($params)
    {
        $path = '/api/v2/shop_category/update_shop_category';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );
        $query = http_build_query(
            [
                "partner_id" => $this->partnerId,
                "timestamp" => $timestamp,
                "access_token" => $this->accessToken,
                "shop_id" => $this->shopId,
                "sign" => $sign,
            ]
        );
        $url = $this->defaultBaseUrl . $path . '?' . $query;

        return $this->sendCurl($url, 'POST', $params);
    }
}