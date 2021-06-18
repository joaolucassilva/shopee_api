<?php

require 'Client.php';

$client = new Client();

// Rotina para obter o parâmetro de envio de determinada venda
$client->getShippingParameter('201224EM1FMFG1');

// Rotina para buscar e obter o número de rastreamento de uma venda ao enviar.
$params = [
    'order_sn' => '201224EM1FMFG1', // REQUERID
    'package_number' => '123123', // NOT REQUIRED
    'response_optional_fields' => '123123' // NOT REQUIRED
];
$client->getTrackingNumber($params);

// Rotina para obter as informações do envio, status do envio.
$params = [
    'order_sn' => '201224EM1FMFG1', // REQUERID
    'package_number' => '123123', // NOT REQUIRED
];

$client->getTrackingInfo($params);

// Rotina para obtenção da etiqueta para impressão do envio da venda.
$params = [
    'order_sn' => '201224EM1FMFG1', // REQUERID
    'package_number' => '123123', // NOT REQUIRED
];
$client->getShippingDocumentInfo($params);