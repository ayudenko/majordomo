<?php


namespace Majordomo\Area\Block;


use Magento\Framework\View\Element\Template;

class Area extends Template
{

    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
        $this->jsLayout['components']['area']['area_id'] = $this->getAreaIdFromUrl();
    }

    private function getAreaIdFromUrl(): string
    {
        return $this->getRequest()->getParam('area_id', '');
    }

    private function getDefaultAreaForCustomer(): string
    {

    }

}
