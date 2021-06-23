<?php

include "AbstractShoppe.php";

class Product extends AbstractShoppe
{
    /**
     * Rotina para Buscar Comentários
     * Product API
     * Use this api to get comment by shop_id, item_id, or comment_id.
     * URL:https://partner.shopeemobile.com/api/v2/product/get_comment
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/get_comment
     * @method GET
     */
    public function getComment($params)
    {
        $path = '/api/v2/product/get_comment';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'cursor' => !empty($params['cursor']) ? $params['cursor'] : "",
            'page_size' => $params['page_size'],
        ];

        if (!empty($params['item_id'])) {
            $queryParams['item_id'] = $params['item_id'];
        }

        if (!empty($params['comment_id'])) {
            $queryParams['comment_id'] = $params['comment_id'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Responder Comentários
     * Product API
     * Use this api to reply comments from buyers in batch.
     * URL: https://partner.shopeemobile.com/api/v2/product/reply_comment
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/reply_comment
     * @method POST
     */
    public function replyComment($params)
    {
        $path = '/api/v2/product/reply_comment';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = http_build_query([
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ]);

        $url = $this->defaultBaseUrl . $path . '?' . $queryParams;

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Buscar Informações Base Produto
     * Product API
     * Use this api to get basic info of item by item_id list.
     * URL: https://partner.shopeemobile.com/api/v2/product/get_item_base_info
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/get_item_base_info
     * @method GET
     */
    public function getItemBaseInfo($params)
    {
        $path = '/api/v2/product/get_item_base_info';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = http_build_query([
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'item_id_list' => $params['item_id_list']
        ]);

        $url = $this->defaultBaseUrl . $path . '?' . $queryParams;

        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Informações Extra Produto
     * Product API
     * Use this api to get extra info of item by item_id list.
     * URL: https://partner.shopeemobile.com/api/v2/product/get_item_extra_info
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/get_item_extra_info
     * @method GET
     */
    public function getItemExtraInfo($params)
    {
        $path = '/api/v2/product/get_item_extra_info';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = http_build_query([
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'item_id_list' => $params['item_id_list']
        ]);

        $url = $this->defaultBaseUrl . $path . '?' . $queryParams;

        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Buscar Informações Produto
     * Product API
     * Use this call to get a list of items.
     * URL: https://partner.shopeemobile.com/api/v2/product/get_item_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/get_item_list
     * @method GET
     */
    public function getItemList($params)
    {
        $path = '/api/v2/product/get_item_list';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'offset' => $params['offset'],
            'page_size' => $params['page_size'],
            'item_status' => $params['item_status'],
        ];

        if (!empty($params['update_time_from'])) {
            $queryParams['update_time_from'] = $params['update_time_from'];
        }

        if (!empty($params['update_time_to'])) {
            $queryParams['update_time_to'] = $params['update_time_to'];
        }

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Excluir Produto
     * Product API
     * Use this call to delete a product item.
     * URL: https://partner.shopeemobile.com/api/v2/product/delete_item
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/delete_item
     * @method POST
     */
    public function deleteItem($params)
    {
        $path = '/api/v2/product/delete_item';
        $timestamp = time();
        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    private function verifyParamsToCreateProduct($params): bool
    {
        $returnValue = true;

        if (empty($params['original_price'])) {
            $returnValue = false;
        }

        if (empty($params['description'])) {
            $returnValue = false;
        }

        if (empty($params['item_name'])) {
            $returnValue = false;
        }

        if (empty($params['normal_stock'])) {
            $returnValue = false;
        }

        if (empty($params['category_id'])) {
            $returnValue = false;
        }

        if (empty($params['image']) || empty($params['image_id_list'])) {
            $returnValue = false;
        }

        if (empty($params['logistic_info']) ||
            empty($params['logistic_info']['enabled']) ||
            empty($params['logistic_info']['logistic_ids'])
        ) {
            $returnValue = false;
        }


        return $returnValue;
    }

    /**
     * Rotina para Inclusão de Produto Novo
     * Product API
     * Use this call to Add a new item.
     * URL: https://partner.shopeemobile.com/api/v2/product/add_item
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/add_item
     * @method POST
     */
    public function addItem($params)
    {
        if (!$this->verifyParamsToCreateProduct($params)) {
            return 'Parametro inválido';
        }

        $path = '/api/v2/product/add_item';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Atualizar Produto
     * Product API
     * Use this call to Update item.
     * URL: https://partner.shopeemobile.com/api/v2/product/update_item
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/update_item
     * @method POST
     */
    public function updateItem($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }

        $path = '/api/v2/product/update_item';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Atualizar Preço do Produto
     * Product API
     * Use this call to Update price.
     * URL: https://partner.shopeemobile.com/api/v2/product/update_price
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/update_price
     * @method POST
     */
    public function updatePrice($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }
        if (empty($params['price_list'])) {
            return 'Array Preço  não encontrado';
        }

        $path = '/api/v2/product/update_price';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Atualizar Estoque do Produto
     * Product API
     * Use this call to Update stock.
     * URL: https://partner.shopeemobile.com/api/v2/product/update_stock
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/update_stock
     * @method POST
     */
    public function updateStock($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }
        if (empty($params['stock_list'])) {
            return 'Parametro stock_list não encontrado';
        }

        $path = '/api/v2/product/update_stock';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Buscar Categoria Recomendada
     * Product API
     * Use this call to Recommend category by item name.
     * URL: https://partner.shopeemobile.com/api/v2/product/category_recommend
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/category_recommend
     * @method GET
     */
    public function getCategoryRecommend($params)
    {
        if (empty($params['item_name'])) {
            return 'Parametro item_name não encontrado';
        }

        $path = '/api/v2/product/category_recommend';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
            'item_name' => $params['item_name']
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'GET');
    }

    /**
     * Rotina para Inclusão de Modelo de Produto
     * Product API
     * Use this call to Add model.
     * URL: https://partner.shopeemobile.com/api/v2/product/add_model
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/add_model
     * @method POST
     */
    public function addModel($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }

        if (empty($params['model_list'])) {
            return 'Parametro model_list não encontrado';
        }

        $path = '/api/v2/product/add_model';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Atualizar Modelo de Produto
     * Product API
     * Use this call to Update seller sku for model.
     * URL: https://partner.shopeemobile.com/api/v2/product/update_model
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/update_model
     * @method POST
     */
    public function updateModel($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }

        if (empty($params['model'])) {
            return 'Parametro model não encontrado';
        }

        $path = '/api/v2/product/update_model';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }

    /**
     * Rotina para Deletar Modelo de Produto
     * Product API
     * Use this call to Delete item model.
     * URL: https://partner.shopeemobile.com/api/v2/product/delete_model
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/product/delete_model
     * @method POST
     */
    public function deleteModel($params)
    {
        if (empty($params['item_id'])) {
            return 'Parametro item_id não encontrado';
        }

        if (empty($params['model_id'])) {
            return 'Parametro model_id não encontrado';
        }

        $path = '/api/v2/product/delete_model';
        $timestamp = time();

        $sign = $this->signatureGenerator->generateSignature(
            $this->partnerId . $path . $timestamp . $this->accessToken . $this->shopId
        );

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $sign,
        ];

        $url = $this->defaultBaseUrl . $path . '?' . http_build_query($queryParams);

        return $this->sendCurl($url, 'POST', $params);
    }


}