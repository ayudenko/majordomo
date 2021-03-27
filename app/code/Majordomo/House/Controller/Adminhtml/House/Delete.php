<?php


namespace Majordomo\House\Controller\Adminhtml\House;


use Exception;
use Magento\Backend\App\Action;
use Majordomo\House\Model\House;

class Delete extends Action
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($house = $this->_objectManager->create(House::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.')); // TODO: replace deprecated method
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try {
            $house->delete();
            $this->messageManager->addSuccess(__('Your contact has been deleted!')); // TODO: replace deprecated method
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete contact: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

}
