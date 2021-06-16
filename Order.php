<?php

require 'Client.php';

$client = new Client();

// BUSCAR LISTA DE VENDAS
$params = [
    'time_range_field' => 'create_time',
    'time_from' => '1607235072',
    'time_to' => '1608271872',
    'page_size' => 20,
];

$client->getOrderList($params);

// BUSCAR LISTA DE VENDAS PRONTAS PARA ENVIO
$params = [
    'page_size' => 20
];
$client->getOrderShipmentList($params);

// DETALHES DA VENDA
$params = [
    'order_sn_list' => '201214JAJXU6G7,201214JASXYXY6'
];
$client->getOrderDetail($params);

// CANCELAR VENDA
$params = [
    'order_sn' => '201020SQQ5K2EP', // REQUIRED
    'cancel_reason' => 'OUT_OF_STOCK', // REQUIRED
    'item_list' => [
        'item_id' => 1680783, // REQUIRED
        'model_id' => 327890123 // REQUIRED
    ]
];

$client->cancelOrder($params);

// ACEITAR CANCELAMENTO DE COMPRA
$params = [
    'order_sn' => '201020SQQ5K2EP', // REQUIRED (Shopee's unique identifier for an order.)
    'operation' => 'ACCEPT' // REQUIRED (The operation you want to handle.Avaiable value: ACCEPT, REJECT)
];

$client->handleBuyerCancelledOrder($params);

// ANOTAÇÕES NA VENDA
$params = [
    'order_sn' => '201224EM1FMFG1',
    'note' => 'Thank you'
];

$client->setNoteOrder($params);