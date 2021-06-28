<?php

require 'SignatureGenerator.php';

abstract class AbstractShoppe
{
    public $signatureGenerator;
    /**
     * @var string
     */
    public $defaultBaseUrl;
    /**
     * @var string
     */
    public $partnerKey;
    /**
     * @var int
     */
    public $partnerId;
    /**
     * @var int
     */
    public $shopId;

    public $accessToken;

    public $refreshToken;

    public function __construct()
    {
        $this->defaultBaseUrl = 'https://partner.test-stable.shopeemobile.com';
        $this->partnerKey = 'de4f6b273e329fb86b56779a86e2d902cc665fc372fb89a5ee420b182d765656';
        $this->partnerId = 1000624;
        $this->shopId = 5934;
        $this->accessToken = '32fd7c6ad8fb9c1f5e822f592fa3c64d';
        $this->refreshToken = '0ed1b74374541317794befcfb1dd14f2';

        $this->signatureGenerator = new SignatureGenerator($this->partnerKey);
    }

    public function authorization(): string
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

        return $this->defaultBaseUrl . $path . '?' . $query;
    }

    public function getToken()
    {
        $timestamp = time();
        $body = [
            'code' => '0e52253686bece3018d800dfb40fb01c',
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

        return $this->sendCurl($url, 'POST', $body);
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

        return $this->sendCurl($url, 'POST', $body);
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

        if ($this->verifyAccessTokenIsValid($result)) {
            return $result;
        }

        return 'Token Invalido';
    }

    public function verifyAccessTokenIsValid($result): bool
    {
        if (!empty(json_decode($result)->error) &&
            json_decode($result)->error === 'error_auth' &&
            json_decode($result)->message === 'Invalid access_token.'
        ) {
            return false;
        }

        return true;
    }

    public function generateSignature($path, $timestamp)
    {
        $sign = $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId;
        return hash_hmac('sha256', $sign, $this->partnerKey);
    }
}