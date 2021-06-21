<?php

require 'SignatureGenerator.php';

class Client
{
    private $signatureGenerator;
    /**
     * @var string
     */
    private $defaultBaseUrl;
    /**
     * @var string
     */
    private $partnerKey;
    /**
     * @var int
     */
    private $partnerId;
    /**
     * @var int
     */
    private $shopId;

    private $accessToken;

    private $refreshToken;

    public $image;

    public function __construct()
    {
        $this->defaultBaseUrl = 'https://partner.test-stable.shopeemobile.com';
        $this->partnerKey = 'de4f6b273e329fb86b56779a86e2d902cc665fc372fb89a5ee420b182d765656';
        $this->partnerId = 1000624;
        $this->shopId = 5934;
        $this->accessToken = '7faabd49adde991856e1701af5d121a0';
        $this->refreshToken = 'b7a6d34e31859f478858658e2ff2f5d2';

        $this->signatureGenerator = new SignatureGenerator($this->partnerKey);
    }

    public function getShops()
    {
        $path = '/api/v2/public/get_shops_by_partner';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $path . $timestamp);

        $query = http_build_query(
            [
                'page_size' => 1,
                'page_no' => 1,
                'partner_id' => $this->partnerId,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, 'GET');
    }

    /**
     * MediaSpace API
     * Init video upload session. Video duration should be between 10s and 60s.
     * URL:https://partner.shopeemobile.com/api/v2/media_space/init_video_upload
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/media_space/init_video_upload
     * @method POST
     */
    public function initVideoUpload($params)
    {
        $path = '/api/v2/media_space/init_video_upload';
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

        $this->sendCurl($url, "POST", $params);
    }

    /**
     * MediaSpace API
     * Upload video file by part using the upload_id in initiate_video_upload.
     * IMPORTANT: The request Content-Type of this API should be of multipart/form-data.
     * URL:https://partner.shopeemobile.com/api/v2/media_space/upload_video_part
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/media_space/upload_video_part
     * @method POST
     */
    public function uploadVideoPart($params)
    {
        $path = "/api/v2/media_space/upload_video_part";
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $path . $timestamp);

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'sign' => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, "POST", $params, true);
    }

    /**
     * MediaSpace API
     * URL Documentation: https://open.shopee.com/documents?module=91&type=1&id=533&version=2
     * Complete the video upload and starts the transcoding process when all parts are uploaded successfully.
     * URL API:https://partner.shopeemobile.com/api/v2/media_space/complete_video_upload
     * URL Test API: https://partner.test-stable.shopeemobile.com/api/v2/media_space/complete_video_upload
     * @method POST
     */
    public function completeVideoUpload($params)
    {
        $path = '/api/v2/media_space/complete_video_upload';
        $timestamp = time();
        $sign = $this->signatureGenerator
            ->generateSignature($this->partnerId . $path . $timestamp);

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'sign' => $sign,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, "POST", $params);
    }

    /**
     * MediaSpace API
     * Query the upload status and result of video upload.
     * URL:https://partner.shopeemobile.com/api/v2/media_space/get_video_upload_result
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/media_space/get_video_upload_result
     * @method POST
     */
    public function getVideoUploadResult($params)
    {
        $path = '/api/v2/media_space/get_video_upload_result';
        $timestamp = time();
        $sign = $this->signatureGenerator
            ->generateSignature($this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId);

        $query = http_build_query(
            [
                'video_upload_id' => $params['video_upload_id'],
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, "GET");
    }

    public function cancelVideoUpload($params)
    {
        $path = '/api/v2/media_space/cancel_video_upload';
        $timestamp = time();
        $sign = $this->signatureGenerator
            ->generateSignature($this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId);

        $query = http_build_query(
            [
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'sign' => $sign,
                'timestamp' => $timestamp,
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, "POST", $params);
    }

    /**
     * MediaSpace API
     * Upload video image file.
     * URL:https://partner.shopeemobile.com/api/v2/media_space/upload_image
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/media_space/upload_image
     * @method POST
     */
    public function uploadImage($params = [])
    {
        $path = '/api/v2/media_space/upload_image';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $path . $timestamp);

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'sign' => $sign,
                'timestamp' => $timestamp
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $this->sendCurl($url, 'POST', $params);
    }

    /**
     * ShopCategory API
     * Use this call to add a new shop collecion
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
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $this->accessToken . $this->shopId);

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

    /**
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

        $query = http_build_url(
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

        $query = http_build_url(
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

    //ORDERS

    /**
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

        $query = http_build_url(
            [
                'shop_id' => $this->shopId,
                'partner_id' => $this->partnerId,
                'access_token' => $this->accessToken,
                'sign' => $sign,
                'timestamp' => $timestamp,
                'time_range_field' => $params['time_range_field'],
                'time_from' => $params['time_from'],
                'time_to' => $params['time_to'],
                'page_size' => $params['page_size'],
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
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

        $query = http_build_url(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign,
                'page_size' => $params['page_size']
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    public function getOrderDetail($params)
    {
        $path = '/api/v2/order/get_order_detail';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $query = http_build_url(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'access_token' => $this->accessToken,
                'shop_id' => $this->shopId,
                'sign' => $sign,
                'order_sn_list' => $params['order_sn_list']
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }

    /**
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

        $query = http_build_url(
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

        $query = http_build_url(
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

        $query = http_build_url(
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
     * Rotina para buscar os detalhes de pagamento de determinado pedido.
     * Payment API
     * Get the payout detail for CB.
     * URL:https://partner.shopeemobile.com/api/v2/payment/get_payout_detail
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/payment/get_payout_detail
     * @method GET
     */
    public function getPayoutDetail($params)
    {
        $path = '/api/v2/payment/get_payout_detail';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $paramsQuery = [
            'page_size' => $params['page_size'],
            'page_no' => $params['page_no'],
            'payout_time_from' => $params['payout_time_from'],
            'payout_time_to' => $params['payout_time_to'],
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $query = http_build_query($paramsQuery);

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }
}