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

    public function authorization()
    {
        $path = '/api/v2/shop/auth_partner';
        $time = time();
        $redirectUrl = 'https://eno39k1u3a0lzoa.m.pipedream.net/';
        $sign = $this->signatureGenerator->generateSignature($this->partnerId . $path . $time);

        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'redirect' => $redirectUrl,
                'sign' => $sign,
                'timestamp' => $time,
            ]
        );
        $url = $this->defaultBaseUrl . $path . '?' . $query;
        $result = $this->sendCurl($url, 'GET');
    }

    public function getToken()
    {
        $timestamp = time();
        $body = [
            'code' => '1a51462d6f8cea67087a9e93d6d8d031',
            'shop_id' => $this->shopId,
            'partner_id' => $this->partnerId
        ];
        $path = '/api/v2/auth/token/get';
        $baseString = $this->partnerId . $path . $timestamp;
        $sign = $this->signatureGenerator->generateSignature($baseString);
        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'sign' => $sign
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;


        $result = $this->sendCurl($url, 'POST', $body);
    }

    public function refreshAccessToken($refreshToken)
    {
        $path = '/api/v2/auth/access_token/get';

        $timestamp = time();
        $query = http_build_query(
            [
                'partner_id' => $this->partnerId,
                'timestamp' => $timestamp,
                'sign' => $this->signatureGenerator->generateSignature($this->partnerId . $path . $timestamp)
            ]
        );

        $url = $this->defaultBaseUrl . $path . '?' . $query;

        $body = [
            'partner_id' => $this->partnerId,
            'shop_id' => $this->shopId,
        ];

        $body['refresh_token'] = $refreshToken;

        $result = $this->sendCurl($url, 'POST', $body);
    }

    public function sendCurl($url, $method, $data = null, $sendFile = null)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if (!is_null($data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $contentType = 'Content-Type: application/json';

        if ($method == 'POST' && !is_null($sendFile)) {
            $contentType = "Content-Type: multipart/form-data";
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, [$contentType]);

        $result = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $result;
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
}