<?php

include "AbstractShoppe.php";

class Payment extends AbstractShoppe
{
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

        $query = http_build_query([
            'page_size' => $params['page_size'],
            'page_no' => $params['page_no'],
            'payout_time_from' => $params['payout_time_from'],
            'payout_time_to' => $params['payout_time_to'],
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ]);

        $url = $this->defaultBaseUrl . $path . '?' . $query;
        return $this->sendCurl($url, 'GET');
    }
}
