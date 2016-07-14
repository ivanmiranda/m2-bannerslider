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
 * Impress action
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class Impress extends \Pengo\Bannerslider\Controller\Index
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
        $slider = $this->_sliderFactory->create()->load($sliderId);
        if ($slider->getId()) {
            $sliderOwnBannerCollection = $slider->getOwnBanerCollection();
            if ($slider->getStyleSlide() == \Pengo\Bannerslider\Model\Slider::STYLESLIDE_POPUP) {
                $sliderOwnBannerCollection->setPageSize(1)->setCurPage(1);
            }
            $bannerIds = $sliderOwnBannerCollection->getColumnValues('banner_id');
            if ($this->_cookieManager->getCookie('bannerslider_user_code_impress_slider'.$sliderId) === null) {
                $this->_cookieManager->setPublicCookie('bannerslider_user_code_impress_slider'.$sliderId, $userCode);
                // $reportCollection = $this->_reportCollectionFactory->create()
                //     ->addFieldToFilter('date_click', $date)
                //     ->addFieldToFilter('slider_id', $sliderId)
                //     ->addFieldToFilter('banner_id', array('in' => $bannerIds));

                // foreach ($reportCollection as $report) {
                //     $report->setImpmode($report->getImpmode() + 1);
                //     try {
                //         $report->save();
                //     } catch (\Exception $e) {
                //         $this->_monolog->addError($e->getMessage());
                //     }
                // }

                // //Banner Ids reported
                // $bannerIdsReported = $reportCollection->getColumnValues('banner_id');

                // //Banner Ids reported
                // $bannerIdsNotReported = array_diff($bannerIds, $bannerIdsReported);
                // foreach ($bannerIdsNotReported as $bannerId) {
                //     $report = $this->_reportFactory->create()
                //         ->setBannerId($bannerId)
                //         ->setSliderId($slider->getId())
                //         ->setImpmode(1)
                //         ->setData('date_click', $date);
                //     try {
                //         $report->save();
                //     } catch (\Exception $e) {
                //         $this->_monolog->addError($e->getMessage());
                //     }
                // }
            }
        }

        return $resultRaw;
    }
}
