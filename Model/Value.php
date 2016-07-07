<?php

/**
 * Pengo
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Pengo.com license that is
 * available through the world-wide-web at this URL:
 * http://www.pengostores.com/
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Pengo
 * @package     Pengo_Bannerslider
 * @author      @deivanmiranda
 * @license     http://www.pengostores.com/
 */

namespace Pengo\Bannerslider\Model;

/**
 * Value Model
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class Value extends \Magento\Framework\Model\AbstractModel
{
    /**
     * constructor.
     *
     * @param \Magento\Framework\Model\Context                        $context
     * @param \Magento\Framework\Registry                             $registry
     * @param \Pengo\Bannerslider\Model\ResourceModel\Value            $resource
     * @param \Pengo\Bannerslider\Model\ResourceModel\Value\Collection $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Pengo\Bannerslider\Model\ResourceModel\Value $resource,
        \Pengo\Bannerslider\Model\ResourceModel\Value\Collection $resourceCollection
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }

    /**
     * load attribute value.
     *
     * @param int    $bannerId
     * @param int    $storeViewId
     * @param string $attributeCode
     *
     * @return $this
     */
    public function loadAttributeValue($bannerId, $storeViewId, $attributeCode)
    {
        $attributeValue = $this->getResourceCollection()
            ->addFieldToFilter('banner_id', $bannerId)
            ->addFieldToFilter('store_id', $storeViewId)
            ->addFieldToFilter('attribute_code', $attributeCode)
            ->setPageSize(1)->setCurPage(1)
            ->getFirstItem();

        $this->setData('banner_id', $bannerId)
            ->setData('store_id', $storeViewId)
            ->setData('attribute_code', $attributeCode);
        if ($attributeValue->getId()) {
            $this->addData($attributeValue->getData())
                ->setId($attributeValue->getId());
        }

        return $this;
    }
}
