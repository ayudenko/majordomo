<?php


namespace Majordomo\House\Block\Adminhtml\House\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'on_click' => 'location.reload()',
            'class' => 'reset',
            'sort_order' => 30
        ];
    }

}
