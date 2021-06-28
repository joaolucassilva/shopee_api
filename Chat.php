<?php

include "AbstractShoppe.php";

/**
 * Class Chat
 * Rotinas do Chat
 */
class Chat extends AbstractShoppe
{
    private $pathBase = '/api/v2/sellerchat';

    /**
     * Rotina para Buscar histórico de mensagens de uma conversa específica
     * Shop API
     * To get messages history for a specific conversation, which can display the messages detail from sender and receiver.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/get_message
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/get_message
     * @method GET
     */
    public function getMessage($params)
    {
        $path = "$this->pathBase/get_message";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
            'conversation_id' => $params['conversation_id']
        ];

        if (!empty($params['offset'])) {
            $queryParams['offset'] = $params['offset'];
        }

        if (!empty($params['page_size'])) {
            $queryParams['page_size'] = $params['page_size'];
        }

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'GET');
    }

    /**
     * Rotina para enviar mensagem
     * Shop API
     * 1.To send a message and select the correct message type (Do not use this API to send batch messages)
     * 2.Currently TW region is not supported to send messages.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/send_message
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/send_message
     * @method POST
     */
    public function sendMessage($params)
    {
        if (!empty($params['to_id'])) {
            return 'Parametro to_id não encontrado';
        }

        if (!empty($params['message_type'])) {
            return 'Parametro message_type não encontrado';
        }

        if (!empty($params['content'])) {
            return 'Parametro content não encontrado';
        }

        $path = "$this->pathBase/send_message";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina para buscar conversas
     * Shop API
     * To get conversation list and its params data
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/get_conversation_list
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/get_conversation_list
     * @method GET
     */
    public function getConversationList($params)
    {
        if (!empty($params['direction'])) {
            return 'Parametro direction não encontrado';
        }

        if (!empty($params['type'])) {
            return 'Parametro type não encontrado';
        }

        $path = "$this->pathBase/get_conversation_list";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        if (!empty($params['next_timestamp_nano'])) {
            $queryParams['next_timestamp_nano'] = $params['next_timestamp_nano'];
        }

        if (!empty($params['page_size'])) {
            $queryParams['page_size'] = $params['page_size'];
        }

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'GET');
    }

    /**
     * Rotina para buscar conversa especifica
     * Shop API
     * To get a specific conversation's basic information.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/get_one_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/get_one_conversation
     * @method GET
     */
    public function getOneConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        $path = "$this->pathBase/get_one_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
            'conversation_id' => $params['conversation_id']
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'GET');
    }


    /**
     * Rotina para deletar conversa
     * Shop API
     * To delete a specific conversation
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/delete_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/delete_conversation
     * @method POST
     */
    public function deleteConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        $path = "$this->pathBase/delete_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina para buscar conversas não lidas
     * Shop API
     * To get the number of unread conversations from a shop (not unread messages)
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/get_unread_conversation_count
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/get_unread_conversation_count
     * @method GET
     */
    public function getUnreadConversationCount()
    {
        $path = "$this->pathBase/get_unread_conversation_count";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'GET');
    }

    /**
     * Rotina para fixar uma conversa especifica
     * Shop API
     * To pin a specific conversation
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/pin_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/pin_conversation
     * @method POST
     */
    public function pinConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        $path = "$this->pathBase/pin_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina para desafixar uma conversa especifica
     * Shop API
     * To unpin a specific conversation
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/unpin_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/unpin_conversation
     * @method POST
     */
    public function unpinConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        $path = "$this->pathBase/unpin_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina para enviar pedido de leitura para uma conversa especifica
     * Shop API
     * To send read request for a specific conversation
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/read_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/read_conversation
     * @method POST
     */
    public function readConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        if (!empty($params['last_read_message_id'])) {
            return 'Parametro last_read_message_id não encontrado';
        }

        $path = "$this->pathBase/read_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina para marcar uma conversao como nao lida
     * Shop API
     * To mark a conversation as unread
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/unread_conversation
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/unread_conversation
     * @method POST
     */
    public function unreadConversation($params)
    {
        if (!empty($params['conversation_id'])) {
            return 'Parametro conversation_id não encontrado';
        }

        $path = "$this->pathBase/unread_conversation";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Rotina Para obter o status de alternância para verificar se a loja permitiu que o comprador negocie o preço com o vendedo
     * Shop API
     * To get the toggle status to check if the shop has allowed buyer to negotiate price with seller.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/get_offer_toggle_status
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/get_offer_toggle_status
     * @method GET
     */
    public function getOfferToggleStatus()
    {
        $path = "$this->pathBase/get_offer_toggle_status";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'GET');
    }

    /**
     * Para definir o status de alternância. Se definido como "ativado", o vendedor não permite que o comprador negocie o preço.
     * Shop API
     * To set the toggle status.If set as "enabled", then seller doesn't allow buyer negotiate the price.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/set_offer_toggle_status
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/set_offer_toggle_status
     * @method POST
     */
    public function setOfferToggleStatus($params)
    {
        if (empty($params['make_offer_status'])) {
            return "Parametro make_offer_status nao encontrado";
        }

        if (!in_array($params['make_offer_status'], ['disabled', 'enabled'])) {
            return "Parametro make_offer_status com valor invalido.  Os Valores que são validos - (disabled/enabled)";
        }

        $path = "$this->pathBase/set_offer_toggle_status";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }

    /**
     * Quando você precisar enviar uma mensagem de tipo de imagem, solicite esta API primeiro para fazer upload do arquivo de imagem para obter o url da imagem.
     * Em seguida, prossiga para solicitar a API de envio de mensagem com o URL da imagem.
     * Shop API
     * When you need to send an image type message, please request this API first to upload the image file to get image url.
     * Then proceed to request the send message API with the image url.
     * URL:https://partner.shopeemobile.com/api/v2/sellerchat/upload_image
     * URL Test: https://partner.test-stable.shopeemobile.com/api/v2/sellerchat/upload_image
     * @method POST
     */
    public function uploadImage($params)
    {
        if (empty($params['file'])) {
            return "Parametro file nao encontrado";
        }

        $path = "$this->pathBase/upload_image";
        $timestamp = time();

        $queryParams = [
            'partner_id' => $this->partnerId,
            'timestamp' => $timestamp,
            'access_token' => $this->accessToken,
            'shop_id' => $this->shopId,
            'sign' => $this->generateSignature($path, $timestamp),
        ];

        return $this->sendCurl("{$this->defaultBaseUrl}{$path}?" . http_build_query($queryParams), 'POST', $params);
    }


}