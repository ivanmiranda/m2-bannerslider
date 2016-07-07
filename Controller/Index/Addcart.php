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

class Addcart extends \Pengo\Bannerslider\Controller\Index 
{
    /**
     * Creates the user session and redirect to the product's catalog
     * Receives a base_64 encoded email address (linked with a customer)
     * @return none
     */
    public function execute() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $data = $this->getRequest()->getParams();

        $cart = $objectManager->get('Magento\Checkout\Model\Cart');
        $productRepository = $objectManager->get('Magento\Catalog\Model\ProductRepository');

        $product = $productRepository->getById( $data[ 'product' ] );
        $options = [ 'qty'=>1, 'super_attribute'=>[ trim($data['superattribute']) => intval($data['attribute']) ] ];

        $cart->addProduct( $product, $options );
        $cart->save();

        echo json_encode(['response'=>true]);
    }
}
