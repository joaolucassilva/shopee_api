<?php

require 'Client.php';

$client = new Client();

$params = [
    'name' => 'OA_V2_11',
    'sort_weight' => 214748350
];

$client->addShopCategory($params);

/**
 * page_size int (Required) - Specifies the starting entry of data to return in the current call. range(1, 2147483647)
 * page_no int (Required) - Specifies the total returned data per entry. range(1, 100)
 */
$params = [
    'page_size' => 1,
    'page_no' => 100,
];

$client->getShopCategoryList($params);

/**
 * shop_category_id int (Required) - ShopCategory unique identifier.
 */
$params = [
    'shop_category_id' => 29431
];
$client->deleteShopCategory($params);

/**
 * shop_category_id int (Required) - ShopCategory unique identifier.
 * name string - ShopCategory name
 * sort_weight - ShopCategory sort weight
 * status string  - ShopCategory status, applicable Values: 'NORMAL', 'INACTIVE','DELETED'
 */
$params = [
    'shop_category_id' => 29333,
    'name' => 'OA_V2_11',
    'sort_weight' => '',
    'status' => 'NORMAL',
];
$client->deleteShopCategory($params);
