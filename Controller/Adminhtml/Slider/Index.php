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

namespace Pengo\Bannerslider\Controller\Adminhtml\Slider;

/**
 * Slider Index action
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class Index extends \Pengo\Bannerslider\Controller\Adminhtml\Slider
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');

            return $resultForward;
        }

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
