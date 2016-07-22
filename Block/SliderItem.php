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

namespace Pengo\Bannerslider\Block;

use Pengo\Bannerslider\Model\Slider as SliderModel;
use Pengo\Bannerslider\Model\Status;

/**
 * Slider item.
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class SliderItem extends \Magento\Framework\View\Element\Template
{
    /**
     * template for evolution slider.
     */
    const STYLESLIDE_EVOLUTION_TEMPLATE = 'Pengo_Bannerslider::slider/evolution.phtml';

    /**
     * template for popup.
     */
    const STYLESLIDE_POPUP_TEMPLATE = 'Pengo_Bannerslider::slider/popup.phtml';

    /**
     * template for note slider.
     */
    const STYLESLIDE_SPECIAL_NOTE_TEMPLATE = 'Pengo_Bannerslider::slider/special/note.phtml';

    /**
     * template for flex slider.
     */
    const STYLESLIDE_FLEXSLIDER_TEMPLATE = 'Pengo_Bannerslider::slider/flexslider.phtml';

    /**
     * template for vertical slider.
     */
    const STYLESLIDE_VERTICAL_TEMPLATE = 'Pengo_Bannerslider::slider/vertical.phtml';

    /**
     * template for custom slider.
     */
    const STYLESLIDE_CUSTOM_TEMPLATE = 'Pengo_Bannerslider::slider/custom.phtml';

    /**
     * Date conversion model.
     *
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_stdlibDateTime;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * slider factory.
     *
     * @var \Pengo\Bannerslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * slider model.
     *
     * @var \Pengo\Bannerslider\Model\Slider
     */
    protected $_slider;

    /**
     * slider id.
     *
     * @var int
     */
    protected $_sliderId;

    /**
     * banner slider helper.
     *
     * @var \Pengo\Bannerslider\Helper\Data
     */
    protected $_bannersliderHelper;

    /**
     * @var \Pengo\Bannerslider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $_bannerCollectionFactory;

    /**
     * scope config.
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * stdlib timezone.
     *
     * @var \Magento\Framework\Stdlib\DateTime\Timezone
     */
    protected $_stdTimezone;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productFactory;

    /**
     * @var \Magento\ConfigurableProduct\Api\Data\OptionValueInterfaceFactory
     */
    protected $optionValueFactory;

    /**
     * @var \Magento\ConfigurableProduct\Model\ConfigurableAttributeData
     */
    protected $configurableAttributeData;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory $categoryFactory,
     */
    protected $categoryFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory
     */
    protected $bestSellers;

    /**
     * @var \Magento\Reports\Model\ResourceModel\Product\CollectionFactory
     */
    protected $mostViewed;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     *
     * @param \Magento\Framework\View\Element\Template\Context                $context
     * @param \Pengo\Bannerslider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory
     * @param \Pengo\Bannerslider\Model\SliderFactory                     $sliderFactory
     * @param SliderModel $slider
     * @param \Magento\Framework\Stdlib\DateTime\DateTime                     $stdlibDateTime
     * @param \Pengo\Bannerslider\Helper\Data                             $bannersliderHelper
     * @param \Magento\Store\Model\StoreManagerInterface                      $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\Timezone                     $_stdTimezone
     * @param array                                                           $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Pengo\Bannerslider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Pengo\Bannerslider\Model\SliderFactory $sliderFactory,
        SliderModel $slider,
        \Magento\Framework\Stdlib\DateTime\DateTime $stdlibDateTime,
        \Pengo\Bannerslider\Helper\Data $bannersliderHelper,
        \Magento\Framework\Stdlib\DateTime\Timezone $_stdTimezone,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\ConfigurableProduct\Api\Data\OptionValueInterfaceFactory $optionValueFactory,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableInstance,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory $bestSellers,
        \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $mostViewed,
        \Magento\Catalog\Helper\Image $image,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_sliderFactory = $sliderFactory;
        $this->_slider = $slider;
        $this->_stdlibDateTime = $stdlibDateTime;
        $this->_bannersliderHelper = $bannersliderHelper;
        $this->_storeManager = $context->getStoreManager();
        $this->_bannerCollectionFactory = $bannerCollectionFactory;
        $this->_scopeConfig = $context->getScopeConfig();
        $this->_stdTimezone = $_stdTimezone;
        $this->productFactory = $productFactory;
        $this->optionValueFactory = $optionValueFactory;
        $this->configurableInstance = $configurableInstance;
        $this->categoryFactory = $categoryFactory;
        $this->bestSellers = $bestSellers;
        $this->mostViewed = $mostViewed;
        $this->imageHelper = $image;
        $this->_registry = $registry;
    }

    /**
     * @return
     */
    protected function _toHtml()
    {
        $store = $this->_storeManager->getStore()->getId();

        $configEnable = $this->_scopeConfig->getValue(
            SliderModel::XML_CONFIG_BANNERSLIDER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );

        if (!$configEnable
            || $this->_slider->getStatus() === Status::STATUS_DISABLED
            || !$this->_slider->getId()
            || !$this->getBannerCollection()->getSize()) {
            return '';
        }

        return parent::_toHtml();
    }

    /**
     * set slider Id and set template.
     *
     * @param int $sliderId
     */
    public function setSliderId($sliderId)
    {
        $this->_sliderId = $sliderId;

        $slider = $this->_sliderFactory->create()->load($this->_sliderId);
        if ($slider->getId()) {
            $this->setSlider($slider);

            if ($slider->getStyleContent() == SliderModel::STYLE_CONTENT_NO) {
                $this->setTemplate(self::STYLESLIDE_CUSTOM_TEMPLATE);
            } else {
                $this->setStyleSlideTemplate($slider->getStyleSlide());
            }
        }

        return $this;
    }

    /**
     * set style slide template.
     *
     * @param int $styleSlideId
     *
     * @return string
     */
    public function setStyleSlideTemplate($styleSlideId)
    {
        switch ($styleSlideId) {
            //Evolution slide
            case SliderModel::STYLESLIDE_EVOLUTION_ONE:
            case SliderModel::STYLESLIDE_EVOLUTION_TWO:
            case SliderModel::STYLESLIDE_EVOLUTION_THREE:
            case SliderModel::STYLESLIDE_EVOLUTION_FOUR:
                $this->setTemplate(self::STYLESLIDE_EVOLUTION_TEMPLATE);
                break;

            case SliderModel::STYLESLIDE_POPUP:
                $this->setTemplate(self::STYLESLIDE_POPUP_TEMPLATE);
                break;
            //Note all page
            case SliderModel::STYLESLIDE_SPECIAL_NOTE:
                $this->setTemplate(self::STYLESLIDE_SPECIAL_NOTE_TEMPLATE);
                break;
            //Vertica
            case SliderModel::STYLESLIDE_VERTICAL_ONE:
            case SliderModel::STYLESLIDE_VERTICAL_TWO:
            case SliderModel::STYLESLIDE_VERTICAL_THREE:
                $this->setTemplate(self::STYLESLIDE_VERTICAL_TEMPLATE);
                break;
            // Flex slide
            default:
                $this->setTemplate(self::STYLESLIDE_FLEXSLIDER_TEMPLATE);
                break;
        }
    }

    /**
     * show titile on top o slider?
     * @return boolean
     */
    public function isShowTitle()
    {
        return $this->_slider->getShowTitle() == SliderModel::SHOW_TITLE_YES ? true : false;
    }

    /**
     * get banner collection of slider.
     *
     * @return \Pengo\Bannerslider\Model\ResourceModel\Banner\Collection
     */
    public function getBannerCollection()
    {
        $storeViewId = $this->_storeManager->getStore()->getId();
        $dateTimeNow = $this->_stdTimezone->date()->format('Y-m-d H:i:s');

        /** @var \Pengo\Bannerslider\Model\ResourceModel\Banner\Collection $bannerCollection */
        $bannerCollection = $this->_bannerCollectionFactory->create()
            ->setStoreViewId($storeViewId)
            ->addFieldToFilter('slider_id', $this->_slider->getId())
            ->addFieldToFilter('status', Status::STATUS_ENABLED)
            ->addFieldToFilter('start_time', ['lteq' => $dateTimeNow])
            ->addFieldToFilter('end_time', ['gteq' => $dateTimeNow])
            ->setOrder('order_banner', 'ASC');

        if ($this->_slider->getSortType() == SliderModel::SORT_TYPE_RANDOM) {
            $bannerCollection->setOrderRandByBannerId();
        }

        return $bannerCollection;
    }

    /**
     * get products collection based on slider definition
     * @return \Magento\Catalog\Model\ProductFactory
     */
    public function getProductCollection()
    {
        switch ($this->_slider->getSliderAttachmentMode()) {
            // Category Mode
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_CATEGORY:
                $category = $this->categoryFactory->create()->load($this->_slider->getSliderCategory());
                if ($this->_slider->getMaxProducts() > 0) {
                    $_products = $category->getProductCollection()->addAttributeToSelect('*')->setPageSize($this->_slider->getMaxProducts());
                } else {
                    $_products = $category->getProductCollection()->addAttributeToSelect('*');
                }
                break;
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_BESTSELLER:
                $_products = $this->bestSellers->create()->setModel('Magento\Catalog\Model\Product');
                break;
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_MOSTVIEWED:
                $_products = $this->mostViewed->create()->addAttributeToSelect('*')->addViewsCount()->setStoreId($this->_storeManager->getStore()->getId())->addStoreFilter($this->_storeManager->getStore()->getId());
                break;
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_RELATEDPRODUCTS:
                if ($currentProduct = $this->_registry->registry('current_product')) {
                    $_products = $currentProduct->getRelatedProducts();
                } else {
                    $_products = [];
                }
                break;
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_UPSELLPRODUCTS:
                if ($currentProduct = $this->_registry->registry('current_product')) {
                    $_products = $currentProduct->getUpSellProducts();
                } else {
                    $_products = [];
                }
                break;
            case \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_CROSSSELLPRODUCTS:
                if ($currentProduct = $this->_registry->registry('current_product')) {
                    $_products = $currentProduct->getCrossSellProducts();
                } else {
                    $_products = [];
                }
                break;
            default:
                $_products = [];
                break;
        }
        if ($this->_slider->getSortType() == \Pengo\Bannerslider\Model\Slider::SORT_TYPE_RANDOM && $this->_slider->getSliderAttachmentMode() != \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_RELATEDPRODUCTS && $this->_slider->getSliderAttachmentMode() != \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_UPSELLPRODUCTS && $this->_slider->getSliderAttachmentMode() != \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_CROSSSELLPRODUCTS) {
            if (!is_array($_products)) {
                $_products->getSelect()->orderRand();
            }
        }
        $products = [];
        foreach ($_products as $_product) {
            $products[] = $_product->getSku();
        }
        return $products;
    }

    /**
     * get first banner.
     *
     * @return \Pengo\Bannerslider\Model\Banner
     */
    public function getFirstBannerItem()
    {
        return $this->getBannerCollection()
            ->setPageSize(1)
            ->setCurPage(1)
            ->getFirstItem();
    }

    /**
     * get position note.
     *
     * @return string
     */
    public function getPositionNote()
    {
        return $this->_slider->getPositionNoteCode();
    }

    /**
     * set slider model.
     *
     * @param \Pengo\Bannerslider\Model\Slider $slider [description]
     */
    public function setSlider(\Pengo\Bannerslider\Model\Slider $slider)
    {
        $this->_slider = $slider;

        return $this;
    }

    /**
     * @return \Pengo\Bannerslider\Model\Slider
     */
    public function getSlider()
    {
        return $this->_slider;
    }

    /**
     * get banner image url.
     *
     * @param \Pengo\Bannerslider\Model\Banner $banner
     *
     * @return string
     */
    public function getBannerImageUrl(\Pengo\Bannerslider\Model\Banner $banner)
    {
        return $this->_bannersliderHelper->getBaseUrlMedia($banner->getImage());
    }

    /**
     * get flexslider html id.
     *
     * @return string
     */
    public function getFlexsliderHtmlId()
    {
        return 'pengo-bannerslider-flex-slider-'.$this->getSlider()->getId().$this->_stdlibDateTime->gmtTimestamp();
    }

    /**
     * get product asociatted to a banner
     * @param  \Pengo\Bannerslider\Model\Banner $banner banner
     * @return product
     */
    public function getBannerProduct(\Pengo\Bannerslider\Model\Banner $banner)
    {
        $_product = $this->productFactory->create();
        if (trim($banner->getSku()) != '') {
            $product = $_product->load($_product->getIdBySku($banner->getSku()));
            if ($product->isSaleable()) {
                return $product;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * get product object from banner's sku
     * @param  string $sku
     * @return product
     */
    public function getProduct($sku)
    {
        $_product = $this->productFactory->create();
        $product = $_product->load($_product->getIdBySku($sku));
        if ($product->isSaleable()) {
            return $product;
        } else {
            return false;
        }
    }

    /**
     * return media image URL
     * @param  \Magento\Catalog\Model\Product $product product from banner
     * @return string URL
     */
    public function getImageUrl(\Magento\Catalog\Model\Product $product)
    {
        return $this->imageHelper->init($product, 'product_base_image')->getUrl();
    }

    /**
     * get super attribute data from a product
     * @param  \Magento\Catalog\Model\Product $product product from banner
     * @return attribute data
     */
    public function getSuperAttribute(\Magento\Catalog\Model\Product $product)
    {
        $options = [];
        /** @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable $typeInstance */
        $typeInstance = $product->getTypeInstance();
        $attributeCollection = $typeInstance->getConfigurableAttributes($product);
        /** @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable\Attribute $option */
        foreach ($attributeCollection as $attribute) {
            $values = [];
            $attributeOptions = $attribute->getOptions();
            if (is_array($attributeOptions)) {
                foreach ($attributeOptions as $option) {
                    /** @var \Magento\ConfigurableProduct\Api\Data\OptionValueInterface $value */
                    $value = $this->optionValueFactory->create();
                    $value->setValueIndex($option['value_index']);
                    $values[] = $value;
                }
            }
            $attribute->setValues($values);
            $options[] = $attribute;
        }
        return $options;
    }

    /**
     * get url to add product on cart
     * @param  \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getAddToCartUrl(\Magento\Catalog\Model\Product $product)
    {
        return $product->getAddToCartUrl();
    }
}
