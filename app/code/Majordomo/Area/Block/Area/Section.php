<?php


namespace Majordomo\Area\Block\Area;


use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Framework\View\Element\Template;

class Section extends Template implements SortLinkInterface
{

    protected $_template = "Majordomo_Area::area/section.phtml";

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

}
