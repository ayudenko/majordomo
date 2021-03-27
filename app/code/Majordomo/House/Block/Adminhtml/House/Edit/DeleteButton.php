<?php


namespace Majordomo\House\Block\Adminhtml\House\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Delete'),
            'on_click' => 'deleteConfirm(\''
                . __('Are you sure you want to delete this house?')
                . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['house_id' => $this->getId()]);
    }

}
