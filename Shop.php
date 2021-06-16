<?php

require 'Client.php';

$client = new Client();


$shopInfo = $client->getShopInfo();
$shopProfile = $client->getProfile();

$params = [
    'shop_name' => 'Shopee 24h Offical Shop',
    'shop_logo' => 'https://cf.shopee.sg/file/8424390be4677b0b3c37ce6499ce261a',
    'description' => 'Welcome to our shop. All checp prices while good quality'
];

$profileUpdated = $client->updateProfile($params);