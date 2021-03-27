<?php


namespace Majordomo\House\Controller\Adminhtml\House;

use Magento\Backend\App\Action;
use Majordomo\House\Model\House;

class Add extends Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $houseData = $this->getRequest()->getParam('house');
        if (is_array($houseData)) {
            $house = $this->_objectManager->create(House::class);
            $house->setData($houseData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }

}
