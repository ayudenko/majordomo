<?php


namespace Majordomo\House\Block\Adminhtml\House\Edit;


use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class GenericButton
{

    protected $urlBuilder;

    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry // TODO: deprecated Registry class
    )
    {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getId()
    {
        $house = $this->registry->registry('house');
        return $house ? $house->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

}
