<?php


namespace Majordomo\House\Block;


use Magento\Customer\Block\Account\SortLinkInterface;

class Link extends \Magento\Framework\View\Element\Html\Link implements SortLinkInterface
{

    /**
     * Template name
     *
     * @var string
     */
    protected $_template = 'Majordomo_House::link.phtml';

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->getUrl('house');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('My Houses');
    }

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

}
