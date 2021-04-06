<?php


namespace Majordomo\Area\Block\Adminhtml\Area\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'on_click' => 'location.reload()',
            'class' => 'save primary',
            'sort_order' => 90,
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
        ];
    }

}
