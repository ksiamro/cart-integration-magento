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
class Shopgate_Framework_Model_Redirect_Route_Type_Category extends Shopgate_Framework_Model_Redirect_Route_Type_Generic
{
    const CONTROLLER_KEY = 'category';

    /**
     * @inheritdoc
     */
    public function callScriptBuilder(\Shopgate_Helper_Redirect_Type_TypeInterface $redirect)
    {
        return $redirect->loadCategory($this->getSpecialId());
    }

    /**
     * Returns the ID of the page
     *
     * @inheritdoc
     */
    protected function getSpecialId()
    {
        return Mage::app()->getRequest()->getParam('id');
    }

    /**
     * Returns the page name
     *
     * @inheritdoc
     */
    protected function getTitle()
    {
        /** @var Mage_Catalog_Model_Category $category */
        $category = Mage::getModel('catalog/category')
                        ->setStoreId(Mage::app()->getStore()->getId())
                        ->load($this->getSpecialId());
        $title    = $category->getName() ?: parent::getTitle();

        return $title;
    }
}
