<?php

/**
 * Copyright Shopgate Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Shopgate Inc, 804 Congress Ave, Austin, Texas 78701 <interfaces@shopgate.com>
 * @copyright Shopgate Inc
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class Shopgate_Framework_Model_Sales_Invoice_Total_ShopgatePaymentFee
    extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    /**
     * @inheritdoc
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        parent::collect($invoice);

        $order = $invoice->getOrder();
        if ($order->getData('shopgate_payment_fee') && $order->getData('base_shopgate_payment_fee')) {
            $shopgateBaseGrandTotal = $invoice->getBaseGrandTotal() + $order->getData('base_shopgate_payment_fee');
            $shopgateGrandTotal     = $invoice->getGrandTotal() + $order->getData('shopgate_payment_fee');

            $invoice->setBaseGrandTotal($shopgateBaseGrandTotal);
            $invoice->setGrandTotal($shopgateGrandTotal);

            $invoice->setData('base_shopgate_payment_fee', $order->getData('base_shopgate_payment_fee'));
            $invoice->setData('shopgate_payment_fee', $order->getData('shopgate_payment_fee'));
        }

        return $this;
    }
}
