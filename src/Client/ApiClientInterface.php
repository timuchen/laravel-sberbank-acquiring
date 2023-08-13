<?php

namespace Timuchen\SberbankAcquiring\Client;

interface ApiClientInterface
{
    public const URI_PROD = 'https://securepayments.sberbank.ru';
    public const URI_TEST = 'https://3dsec.sberbank.ru';

    public const PATH_REGISTER = '/payment/rest/register.do';
    public const PATH_REGISTER_PRE_AUTH = '/payment/rest/registerPreAuth.do';
    public const PATH_DEPOSIT = '/payment/rest/deposit.do';
    public const PATH_REVERSE = '/payment/rest/reverse.do';
    public const PATH_REFUND = '/payment/rest/refund.do';
    public const PATH_GET_ORDER_STATUS_EXTENDED = '/payment/rest/getOrderStatusExtended.do';
    public const PATH_APPLE_PAY = '/payment/applepay/payment.do';
    public const PATH_SAMSUNG_PAY = '/payment/samsung/payment.do';
    public const PATH_GOOGLE_PAY = '/payment/google/payment.do';
    public const PATH_GET_RECEIPT_STATUS = '/payment/rest/getReceiptStatus.do';
    public const PATH_UNBIND = '/payment/rest/unBindCard.do';
    public const PATH_BIND = '/payment/rest/bindCard.do';
    public const PATH_GET_BINDINGS = '/payment/rest/getBindings.do';
    public const PATH_GET_BINDINGS_BY_CARD_OR_ID = '/payment/rest/getBindingsByCardOrId.do';
    public const PATH_EXTEND_BINDING = '/payment/rest/extendBinding.do';
    public const PATH_VERIFY_ENROLLMENT = '/payment/rest/verifyEnrollment.do';

    /**
     * Регистрация заказа
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:register
     *
     * @param int $amount       Сумма платежа в минимальных единицах валюты
     * @param string $returnUrl Адрес, на который требуется перенаправить пользователя в случае успешной оплаты
     * @param array $params     Необязательные параметры
     * @param string $method    Тип HTTP-запроса
     * @param array $headers    Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function register(
        int $amount,
        string $returnUrl,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Регистрация заказа с предавторизацией
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:registerpreauth
     *
     * @param int $amount       Сумма платежа в минимальных единицах валюты
     * @param string $returnUrl Адрес, на который требуется перенаправить пользователя в случае успешной оплаты
     * @param array $params     Необязательные параметры
     * @param string $method    Тип HTTP-запроса
     * @param array $headers    Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function registerPreAuth(
        int $amount,
        string $returnUrl,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос завершения оплаты заказа
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:deposit
     *
     * @param int|string $orderId Номер заказа в платёжном шлюзе
     * @param int $amount         Сумма платежа в минимальных единицах валюты
     * @param array $params       Необязательные параметры
     * @param string $method      Тип HTTP-запроса
     * @param array $headers      Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function deposit(
        $orderId,
        int $amount,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос отмены оплаты заказа
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:reverse
     *
     * @param int|string $orderId Номер заказа в платёжном шлюзе
     * @param array $params       Необязательные параметры
     * @param string $method      Тип HTTP-запроса
     * @param array $headers      Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function reverse(
        $orderId,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос возврата средств оплаты заказа
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:refund
     *
     * @param int|string $orderId Номер заказа в платёжном шлюзе
     * @param int $amount         Сумма платежа в минимальных единицах валюты
     * @param array $params       Необязательные параметры
     * @param string $method      Тип HTTP-запроса
     * @param array $headers      Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function refund(
        $orderId,
        int $amount,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Получение статуса заказа
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:getorderstatusextended
     *
     * @param array $params  Параметры
     * @param string $method Тип HTTP-запроса
     * @param array $headers Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function getOrderStatusExtended(
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос оплаты через Apple Pay
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:payment_applepay
     *
     * @param string $merchant     Логин продавца в платёжном шлюзе
     * @param string $paymentToken Токен, полученный от системы Apple Pay
     * @param array $params        Необязательные параметры
     * @param string $method       Тип HTTP-запроса
     * @param array $headers       Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function payWithApplePay(
        string $merchant,
        string $paymentToken,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос оплаты через Samsung Pay
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:payment_samsungpay
     *
     * @param string $merchant     Логин продавца в платёжном шлюзе
     * @param string $paymentToken Содержимое параметра 3ds.data из ответа, полученного от Samsung Pay
     * @param array $params        Необязательные параметры
     * @param string $method       Тип HTTP-запроса
     * @param array $headers       Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function payWithSamsungPay(
        string $merchant,
        string $paymentToken,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос оплаты через Google Pay
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:payment_googlepay
     *
     * @param string $merchant     Логин продавца в платёжном шлюзе
     * @param string $paymentToken Токен, полученный от Google Pay и закодированный в Base64
     * @param int $amount          Сумма платежа в минимальных единицах валюты
     * @param string $returnUrl    Адрес, на который требуется перенаправить пользователя в случае успешной оплаты
     * @param array $params        Необязательные параметры
     * @param string $method       Тип HTTP-запроса
     * @param array $headers       Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function payWithGooglePay(
        string $merchant,
        string $paymentToken,
        int $amount,
        string $returnUrl,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос сведений о кассовом чеке
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:getreceiptstatus
     *
     * @param array $params  Параметры
     * @param string $method Тип HTTP-запроса
     * @param array $headers Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function getReceiptStatus(
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос активации связки
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:bindcard
     *
     * @param string $bindingId Идентификатор связки
     * @param array $params     Необязательные параметры
     * @param string $method    Тип HTTP-запроса
     * @param array $headers    Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function bindCard(
        string $bindingId,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос деактивации связки
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:unbindcard
     *
     * @param string $bindingId Идентификатор связки
     * @param array $params     Необязательные параметры
     * @param string $method    Тип HTTP-запроса
     * @param array $headers    Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function unBindCard(
        string $bindingId,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос списка всех связок клиента
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:getbindings
     *
     * @param string $clientId Номер (идентификатор) клиента в системе продавца
     * @param array $params    Необязательные параметры
     * @param string $method   Тип HTTP-запроса
     * @param array $headers   Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function getBindings(
        string $clientId,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос списка связок определённой банковской карты
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:getbindingsbycardorid
     *
     * @param array $params  Необязательные параметры
     * @param string $method Тип HTTP-запроса
     * @param array $headers Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function getBindingsByCardOrId(
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос изменения срока действия связки
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:extendbinding
     *
     * @param string $bindingId Идентификатор созданной ранее связки
     * @param int $newExpiry    Новая дата (год и месяц) окончания срока действия в формате ГГГГДД
     * @param array $params     Необязательные параметры
     * @param string $method    Тип HTTP-запроса
     * @param array $headers    Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function extendBinding(
        string $bindingId,
        int $newExpiry,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Запрос проверки вовлечённости карты в 3DS
     *
     * @see https://securepayments.sberbank.ru/wiki/doku.php/integration:api:rest:requests:verifyenrollment
     *
     * @param string $pan    Маскированный номер карты, которая использовалась для оплаты
     * @param array $params  Необязательные параметры
     * @param string $method Тип HTTP-запроса
     * @param array $headers Хэдеры HTTP-клиента
     *
     * @return SberbankResponse Ответ сервера
     *
     * @throws \Timuchen\SberbankAcquiring\Exceptions\HttpClientException
     * @throws \Timuchen\SberbankAcquiring\Exceptions\NetworkException
     * @throws \InvalidArgumentException
     */
    public function verifyEnrollment(
        string $pan,
        array $params = [],
        string $method = HttpClientInterface::METHOD_POST,
        array $headers = []
    ): SberbankResponse;

    /**
     * Устанавливает адрес сервера
     *
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri): void;
}
