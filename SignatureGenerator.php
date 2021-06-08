<?php


class SignatureGenerator
{
    private $partnerKey;

    public function __construct($partnerKey)
    {
        $this->partnerKey = $partnerKey;
    }

    public function generateSignature($url)
    {
        return hash_hmac('sha256', $url, $this->partnerKey);
    }

}