<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\PayPal;

/**
 * PayPal Refund Request
 */
class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $data = $this->getBaseData('RefundTransaction');

        $request->validate(array('gatewayReference'));

        $data['TRANSACTIONID'] = $request->getGatewayReference();
        $data['REFUNDTYPE'] = 'Full';

        return $data;
    }
}