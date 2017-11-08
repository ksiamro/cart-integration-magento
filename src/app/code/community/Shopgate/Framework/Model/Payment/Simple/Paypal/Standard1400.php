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

/**
 * PayPal Standard handler for mage v.1.4.0.0
 *
 * @author Konstantin Kiritsenko <konstantin@kiritsenko.com>
 */
class Shopgate_Framework_Model_Payment_Simple_Paypal_Standard1400
    extends Shopgate_Framework_Model_Payment_Pp_Abstract
    implements Shopgate_Framework_Model_Payment_Interface
{
    const PAYMENT_IDENTIFIER = ShopgateOrder::PAYPAL;
    const XML_CONFIG_ENABLED = 'payment/paypal_standard/active';
    const PAYMENT_MODEL = 'paypal/standard';

    /**
     * Partial, online refund not supported
     *
     * @param Mage_Sales_Model_Order $magentoOrder
     * @return Mage_Sales_Model_Order
     */
    public function manipulateOrderWithPaymentData($magentoOrder)
    {
        $info         = $this->getShopgateOrder()->getPaymentInfos();
        $magentoOrder = parent::manipulateOrderWithPaymentData($magentoOrder);
        $magentoOrder->getPayment()->setLastTransId($info['transaction_id']);
        return $magentoOrder;
    }
}