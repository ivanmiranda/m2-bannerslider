<?php 

namespace Pengo\Bannerslider\Test\Unit\Block;

class SliderViewTest extends \PHPUnit_Framework_TestCase {

	/** @var \Pengo\Bannerslider\Block\Bannerslider */
	protected $slider;

	/** @var \Pengo\Bannerslider\Block\SliderItem */
	protected $items;

	public function setUp() {
		$objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
// I want to test the magento object w/all it's dependencies, so I use the object manager to get it
		$this->slider = $objectManager->getObject( 'Pengo\Bannerslider\Block\Bannerslider' );
		$this->items = $objectManager->getObject( 'Pengo\Bannerslider\Block\SliderItem' );
	}

	public function testExtendsOriginal() {
		$this->assertInstanceOf( '\Magento\Framework\View\Element\Template', $this->slider );
		$this->assertInstanceOf( '\Magento\Framework\View\Element\Template', $this->items );
	}

}