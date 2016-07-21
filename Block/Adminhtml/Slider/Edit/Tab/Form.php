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

namespace Pengo\Bannerslider\Block\Adminhtml\Slider\Edit\Tab;

use Pengo\Bannerslider\Model\Status;

/**
 * Slider Form.
 * @category Pengo
 * @package  Pengo_Bannerslider
 * @module   Bannerslider
 * @author   @deivanmiranda
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    const FIELD_NAME_SUFFIX = 'slider';

    /**
     * @var \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory
     */
    protected $_fieldFactory;

    /**
     * [$_bannersliderHelper description].
     *
     * @var \Pengo\Bannerslider\Helper\Data
     */
    protected $_bannersliderHelper;

    /**
     * [__construct description].
     *
     * @param \Magento\Backend\Block\Template\Context                                $context            [description]
     * @param \Pengo\Bannerslider\Helper\Data                                    $bannersliderHelper [description]
     * @param \Magento\Framework\Registry                                            $registry           [description]
     * @param \Magento\Framework\Data\FormFactory                                    $formFactory        [description]
     * @param \Magento\Store\Model\System\Store                                      $systemStore        [description]
     * @param \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory       [description]
     * @param array                                                                  $data               [description]
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Pengo\Bannerslider\Helper\Data $bannersliderHelper,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory,
        array $data = []
    ) {
        $this->_bannersliderHelper = $bannersliderHelper;
        $this->_fieldFactory = $fieldFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $slider = $this->getSlider();
        $isElementDisabled = true;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        /*
         * declare dependence
         */
        // dependence block
        $dependenceBlock = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Form\Element\Dependence'
        );

        // dependence field map array
        $fieldMaps = [];

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Slider Information')]);

        if ($slider->getId()) {
            $fieldset->addField('slider_id', 'hidden', ['name' => 'slider_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'class' => 'required-entry',
            ]
        );

        $fieldMaps['show_title'] = $fieldset->addField(
            'show_title',
            'select',
            [
                'label' => __('Show Title'),
                'title' => __('Show Title'),
                'name' => 'show_title',
                'options' => Status::getAvailableStatuses(),
                'disabled' => false,
            ]
        );

        $fieldMaps['status'] = $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Slider Status'),
                'title' => __('Slider Status'),
                'name' => 'status',
                'options' => Status::getAvailableStatuses(),
                'disabled' => false,
            ]
        );

        $fieldMaps['slider_attachment_mode'] = $fieldset->addField(
            'slider_attachment_mode',
            'select',
            [
                'label' => __('Select Attachment Mode'),
                'name' => 'slider_attachment_mode',
                'values' => [
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_DEFAULT,
                        'label' => __('Default'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_CATEGORY,
                        'label' => __('Category'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_MOSTVIEWED,
                        'label' => __('Most Viewed'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_BESTSELLER,
                        'label' => __('Best Seller'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_RELATEDPRODUCTS,
                        'label' => __('Related Products'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_UPSELLPRODUCTS,
                        'label' => __('Up Sells Products'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ATTACHMENT_MODE_CROSSSELLPRODUCTS,
                        'label' => __('Cross Sells Products'),
                    ],
                ],
            ]
        );

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $categoryFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $categories = $categoryFactory->create()->addAttributeToSelect('*');
        $categoriesData[] = [ 'value'=>0, 'label'=>__('-- Select Category --') ];
        foreach ($categories as $category) {
            $categoriesData[] = [ 'value' => $category->getId(), 'label' => __($category->getName()) ];
        }
        $fieldMaps['slider_category'] = $fieldset->addField(
            'slider_category',
            'select',
            [
                'label' => __('Category'),
                'name' => 'slider_category',
                'note' => 'product category',
                'values' => $categoriesData
            ]
        );

        $fieldMaps['max_products'] = $fieldset->addField(
            'max_products',
            'text',
            [
                'label' => __('Maximum Products Allowed'),
                'name' => 'max_products',
                'note' => 'products to be displayed',
            ]
        );

        $fieldMaps['allow_sale'] = $fieldset->addField(
            'allow_sale',
            'select',
            [
                'label' => __('Allow Sale on Slider'),
                'name' => 'allow_sale',
                'values' => [
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ALLOW_SALE_YES,
                        'label' => __('Yes'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::ALLOW_SALE_NO,
                        'label' => __('No'),
                    ],
                ],
            ]
        );

        $fieldMaps['style_content'] = $fieldset->addField(
            'style_content',
            'select',
            [
                'label' => __('Select available Slider Styles'),
                'name' => 'style_content',
                'values' => [
                    [
                        'value' => Status::STATUS_ENABLED,
                        'label' => __('Yes'),
                    ],
                    [
                        'value' => Status::STATUS_DISABLED,
                        'label' => __('No'),
                    ],
                ],
            ]
        );

        $fieldMaps['custom_code'] = $fieldset->addField(
            'custom_code',
            'editor',
            [
                'name' => 'custom_code',
                'label' => __('Custom slider'),
                'title' => __('Custom slider'),
                'wysiwyg' => true,
                'required' => false,
            ]
        );

        $previewUrl = $this->_bannersliderHelper->getBackendUrl('*/*/preview', ['_current' => false]);
        $fieldMaps['style_slide'] = $fieldset->addField(
            'style_slide',
            'select',
            [
                'label' => __('Select Slider Mode'),
                'name' => 'style_slide',
                'values' => $this->_bannersliderHelper->getStyleSlider(),
            ]
        );

        $fieldMaps['sort_type'] = $fieldset->addField(
            'sort_type',
            'select',
            [
                'label' => __('Sort type'),
                'name' => 'sort_type',
                'values' => [
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::SORT_TYPE_RANDOM,
                        'label' => __('Random'),
                    ],
                    [
                        'value' => \Pengo\Bannerslider\Model\Slider::SORT_TYPE_ORDERLY,
                        'label' => __('Orderly'),
                    ],
                ],
            ]
        );

        $fieldMaps['width'] = $fieldset->addField(
            'width',
            'text',
            [
                'label' => __('Width'),
                'name' => 'width',
                'required' => true,
                'class' => 'required-entry validate-number validate-greater-than-zero',
            ]
        );

        $fieldMaps['height'] = $fieldset->addField(
            'height',
            'text',
            [
                'label' => __('Height'),
                'name' => 'height',
                'required' => true,
                'class' => 'required-entry validate-number validate-greater-than-zero',
            ]
        );

        $fieldMaps['animationB'] = $fieldset->addField(
            'animationB',
            'select',
            [
                'label' => __('Animation Effect'),
                'name' => 'animationB',
                'values' => $this->_bannersliderHelper->getAnimationB(),
            ]
        );

        $fieldMaps['animationA'] = $fieldset->addField(
            'animationA',
            'select',
            [
                'label' => __('Animation Effect'),
                'name' => 'animationA',
                'values' => $this->_bannersliderHelper->getAnimationA(),
            ]
        );

        $fieldMaps['note_color'] = $fieldset->addField(
            'note_color',
            'select',
            [
                'name' => 'note_color',
                'label' => __('Color'),
                'title' => __('Color'),
                'values' => $this->_bannersliderHelper->getOptionColor(),
            ]
        );

        $fieldMaps['slider_speed'] = $fieldset->addField(
            'slider_speed',
            'text',
            [
                'label' => __('Speed'),
                'name' => 'slider_speed',
                'note' => 'milliseconds . This is the display time of a banner',
            ]
        );

        $fieldMaps['position_note'] = $fieldset->addField(
            'position_note',
            'select',
            [
                'name' => 'position_note',
                'label' => __('Position'),
                'title' => __('Position'),
                'values' => $slider->getPositionNoteOptions(),
                'note' => 'is position will be shown on all pages',
            ]
        );

        $fieldMaps['description'] = $fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'label' => __('Note\'s content'),
                'title' => __('Note\'s content'),
                'wysiwyg' => true,
                'required' => false,
            ]
        );

        $positionImage = [];
        for ($i = 1; $i <= 5; ++$i) {
            $positionImage[] = $this->getViewFileUrl("Pengo_Bannerslider::images/position/bannerslider-ex{$i}.png");
        }
        $fieldMaps['position'] = $fieldset->addField(
            'position',
            'select',
            [
                'name' => 'position',
                'label' => __('Position'),
                'title' => __('Position'),
                'values' => $this->_bannersliderHelper->getBlockIdsToOptionsArray(),
            ]
        );

        $fieldMaps['position_custom'] = $fieldset->addField(
            'position_custom',
            'select',
            [
                'name' => 'position_custom',
                'label' => __('Position'),
                'title' => __('Position'),
                'values' => $this->_bannersliderHelper->getBlockIdsToOptionsArray(),
                'note' => '<a title="" data-position-image=\'' . json_encode($positionImage) . '\' data-tooltip-image="">Preview</a>',
            ]
        );

        $fieldMaps['category_ids'] = $fieldset->addField(
            'category_ids',
            'multiselect',
            [
                'label' => __('Categories'),
                'name' => 'category_ids',
                'values' => $this->_bannersliderHelper->getCategoriesArray(),
            ]
        );

        /*
         * Add field map
         */
        foreach ($fieldMaps as $fieldMap) {
            $dependenceBlock->addFieldMap($fieldMap->getHtmlId(), $fieldMap->getName());
        }

        $mappingFieldDependence = $this->getMappingFieldDependence();

        /*
         * Add field dependence
         */
        foreach ($mappingFieldDependence as $dependence) {
            $negative = isset($dependence['negative']) && $dependence['negative'];
            if (is_array($dependence['fieldName'])) {
                foreach ($dependence['fieldName'] as $fieldName) {
                    $dependenceBlock->addFieldDependence(
                        $fieldMaps[$fieldName]->getName(),
                        $fieldMaps[$dependence['fieldNameFrom']]->getName(),
                        $this->getDependencyField($dependence['refField'], $negative)
                    );
                }
            } else {
                $dependenceBlock->addFieldDependence(
                    $fieldMaps[$dependence['fieldName']]->getName(),
                    $fieldMaps[$dependence['fieldNameFrom']]->getName(),
                    $this->getDependencyField($dependence['refField'], $negative)
                );
            }
        }

        /*
         * add child block dependence
         */
        $this->setChild('form_after', $dependenceBlock);

        $defaultData = [
            'width' => 400,
            'height' => 200,
            'slider_speed' => 4500,
        ];

        if (!$slider->getId()) {
            $slider->setStatus($isElementDisabled ? Status::STATUS_ENABLED : Status::STATUS_DISABLED);
            $slider->addData($defaultData);
        }

        if ($slider->hasData('animationB')) {
            $slider->setData('animationA', $slider->getData('animationB'));
        }

        if ($slider->hasData('position')) {
            $slider->setPositionCustom($slider->getPosition());
        }

        $form->setValues($slider->getData());
        $form->addFieldNameSuffix(self::FIELD_NAME_SUFFIX);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    /**
     * get dependency field.
     *
     * @return Magento\Config\Model\Config\Structure\Element\Dependency\Field [description]
     */
    public function getDependencyField($refField, $negative = false, $separator = ',', $fieldPrefix = '')
    {
        return $this->_fieldFactory->create(
            ['fieldData' => ['value' => (string)$refField, 'negative' => $negative, 'separator' => $separator], 'fieldPrefix' => $fieldPrefix]
        );
    }

    public function getMappingFieldDependence()
    {
        return [
            [
                'fieldName' => 'slider_category',
                'fieldNameFrom' => 'slider_attachment_mode',
                'refField' => '1',
            ],
            [
                'fieldName' => ['max_products', 'allow_sale'],
                'fieldNameFrom' => 'slider_attachment_mode',
                'refField' => '1,2,3',
            ],
            [
                'fieldName' => ['width', 'height'],
                'fieldNameFrom' => 'style_slide',
                'refField' => '1,2,3,4,5',
            ],
            [
                'fieldName' => 'category_ids',
                'fieldNameFrom' => 'position',
                'refField' => implode(',', [
                    'category-sidebar-right-top',
                    'category-sidebar-right-bottom',
                    'category-sidebar-left-top',
                    'category-sidebar-left-bottom',
                    'category-content-top',
                    'category-menu-top',
                    'category-menu-bottom',
                    'category-page-bottom',
                ]),
            ],
            [
                'fieldName' => [
                    'width',
                    'height',
                    'animationA',
                    'animationB',
                    'position',
                    'style_slide',
                    'sort_type',
                    'note_color',
                    'slider_speed',
                    'position_note',
                ],
                'fieldNameFrom' => 'style_content',
                'refField' => '1',
            ],
            [
                'fieldName' => 'animationA',
                'fieldNameFrom' => 'style_slide',
                'refField' => '1,2,3,4',
            ],
            [
                'fieldName' => 'animationB',
                'fieldNameFrom' => 'style_slide',
                'refField' => '7,8,9',
            ],
            [
                'fieldName' => 'position',
                'fieldNameFrom' => 'style_slide',
                'refField' => '5,6,',
                'negative' => true,
            ],
            [
                'fieldName' => 'position_custom',
                'fieldNameFrom' => 'style_content',
                'refField' => '2',
            ],
            [
                'fieldName' => 'sort_type',
                'fieldNameFrom' => 'style_slide',
                'refField' => '5,',
                'negative' => true,
            ],
            [
                'fieldName' => ['note_color', 'position_note'],
                'fieldNameFrom' => 'style_slide',
                'refField' => '6',
            ],
            [
                'fieldName' => 'slider_speed',
                'fieldNameFrom' => 'style_slide',
                'refField' => '5,10,',
                'negative' => true,
            ],
        ];
    }

    public function getSlider()
    {
        return $this->_coreRegistry->registry('slider');
    }

    public function getPageTitle()
    {
        return $this->getSlider()->getId() ? __("Edit Slider '%1'", $this->escapeHtml($this->getSlider()->getTitle())) : __('New Slider');
    }

    /**
     * Prepare label for tab.
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Slider Information');
    }

    /**
     * Prepare title for tab.
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Slider Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
