<?php


namespace Majordomo\Area\Block\Adminhtml\Area\Edit;


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
        $area = $this->registry->registry('area'); // TODO: refactor deprecated
        return $area ? $area->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

}
