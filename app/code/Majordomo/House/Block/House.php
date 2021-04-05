<?php


namespace Majordomo\House\Block;


use Magento\Framework\View\Element\Template;

class House extends Template
{

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
    }

}
