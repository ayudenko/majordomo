<?php


namespace Majordomo\Area\Block;


use Magento\Customer\Block\Account\SortLinkInterface;

class Link extends \Magento\Framework\View\Element\Html\Link implements SortLinkInterface
{

    /**
     * Template name
     *
     * @var string
     */
    protected $_template = 'Majordomo_Area::link.phtml';

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->getUrl('area');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('My Areas');
    }

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

}
