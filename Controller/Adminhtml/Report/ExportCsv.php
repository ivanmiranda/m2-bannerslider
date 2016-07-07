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

namespace Pengo\Bannerslider\Controller\Adminhtml\Report;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportCsv action
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class ExportCsv extends \Pengo\Bannerslider\Controller\Adminhtml\Report
{
    public function execute()
    {
        $fileName = 'reports.csv';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Pengo\Bannerslider\Block\Adminhtml\Report\Grid')->getCsv();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
