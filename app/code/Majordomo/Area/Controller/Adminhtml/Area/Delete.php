<?php


namespace Majordomo\Area\Controller\Adminhtml\Area;


use Exception;
use Magento\Backend\App\Action;
use Majordomo\Area\Model\Area;

class Delete extends Action
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($area = $this->_objectManager->create(Area::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.')); // TODO: replace deprecated method
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try {
            $area->delete();
            $this->messageManager->addSuccess(__('Your area has been deleted!')); // TODO: replace deprecated method
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete area: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

}
