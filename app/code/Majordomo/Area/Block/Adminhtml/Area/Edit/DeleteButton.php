<?php


namespace Majordomo\Area\Block\Adminhtml\Area\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData() // TODO: remove this button
    {
        return [
            'label' => __('Delete'),
            'on_click' => 'deleteConfirm(\''
                . __('Are you sure you want to delete this area?')
                . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['area_id' => $this->getId()]);
    }

}
