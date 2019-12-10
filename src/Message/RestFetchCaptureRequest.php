<?php
/**
 * PayPal REST Fetch Purchase Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Fetch Capture Request
 *
 * Use this call to get details about captures.
 *
 * ### Example
 *
 * See RestCaptureRequest for the first part of this example transaction:
 *
 * <code>
 *   // Fetch the capture so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchCapture();
 *   $transaction->setTransactionReference($capture_id);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchCapture response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see RestPurchaseRequest
 * @link https://developer.paypal.com/docs/api/#look-up-a-payment-resource
 */
class RestFetchCaptureRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchTransaction requests must be GET.
     * Using POST results in an error 500 from PayPal.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/payments/capture/' . $this->getTransactionReference();
    }
}
