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

namespace Pengo\Bannerslider\Controller\Index;

/**
 * Click action
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class Click extends \Pengo\Bannerslider\Controller\Index
{
    /**
     * Default customer account page.
     */
    public function execute()
    {
        $resultRaw = $this->_resultRawFactory->create();
        $userCode = $this->getUserCode(null);
        $date = $this->_stdTimezone->date()->format('Y-m-d');
        $sliderId = $this->getRequest()->getParam('slider_id');
        $bannerId = $this->getRequest()->getParam('banner_id');
        $slider = $this->_sliderFactory->create()->load($sliderId);
        $banner = $this->_bannerFactory->create()->load($bannerId);

        if ($banner->getId() && $slider->getId()) {
            if ($this->_cookieManager->getCookie('bannerslider_user_code_click'.$bannerId) === null) {
                $this->_cookieManager->setPublicCookie('bannerslider_user_code_click'.$bannerId, $userCode);
                $reportCollection = $this->_reportCollectionFactory->create()
                    ->addFieldToFilter('date_click', $date)
                    ->addFieldToFilter('slider_id', $sliderId)
                    ->addFieldToFilter('banner_id', $bannerId)
                    ->setPageSize(1)->setCurPage(1);

                if ($reportCollection->getSize()) {
                    $reportFirstItem = $reportCollection->getFirstItem();
                    $reportFirstItem->setClicks($reportFirstItem->getClicks() + 1);
                    try {
                        $reportFirstItem->save();
                    } catch (\Exception $e) {
                        $this->_monolog->addError($e->getMessage());
                    }
                } else {
                    $report = $this->_reportFactory->create()
                        ->setBannerId($banner->getId())
                        ->setSliderId($slider->getId())
                        ->setClicks(1)
                        ->setData('date_click', $date);
                    try {
                        $report->save();
                    } catch (\Exception $e) {
                        $this->_monolog->addError($e->getMessage());
                    }
                }
            }
        }

        return $resultRaw;
    }
}
