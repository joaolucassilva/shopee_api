<?php

require 'Client.php';

$client = new Client();

// Rotina para buscar os detalhes de pagamento de determinado pedido.
$params = [
    'page_size' => 1, // REQUERID
    'page_no' => 1, // REQUERID
    'payout_time_from' => time(), // REQUERID
    'payout_time_to' => time(), // REQUERID
];
$client->getPayoutDetail($params);

