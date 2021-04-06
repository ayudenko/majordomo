<?php


namespace Majordomo\Area\Controller\Adminhtml\Area;

use Magento\Backend\App\Action;
use Majordomo\Area\Model\Area;

class Add extends Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $areaData = $this->getRequest()->getParam('area');
        if (is_array($areaData)) {
            $area = $this->_objectManager->create(Area::class);
            $area->setData($areaData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }

}
