<?php
/**
 * PayPal REST Fetch Authorization Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Fetch Authorization Request
 *
 * Use this call to get details about payments that have been authorized
 *
 * ### Example
 *
 * See RestAuthorizeRequest for the first part of this example transaction:
 *
 * <code>
 *   // Fetch the transaction so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchAuthorization();
 *   $transaction->setTransactionReference($authorization_id);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchTransaction response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see RestAuthorizeRequest
 * @link https://developer.paypal.com/docs/api/payments/v1/#authorization_get
 */
class RestFetchAuthorizationRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        return [];
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/payments/authorization/' . $this->getTransactionReference();
    }
}
