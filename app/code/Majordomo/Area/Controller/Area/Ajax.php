<?php


namespace Majordomo\Area\Controller\Area;


use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use Majordomo\Area\Model\AreaFactory;
use Majordomo\Area\Model\ResourceModel\Area;

class Ajax implements HttpGetActionInterface
{

    protected PageFactory $_pageFactory;
    protected RequestInterface $_request;
    protected AreaFactory $_areaFactory;
    protected Area $_areaResourceModel;

    public function __construct(
        PageFactory $pageFactory,
        RequestInterface $request,
        AreaFactory $areaFactory,
        Area $areaResourceModel
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_areaFactory = $areaFactory;
        $this->_areaResourceModel = $areaResourceModel;
    }

    public function execute()
    {
        $areaId = $this->_request->getParam('areaId', '');
        $areaData = [];
        if (!empty($areaId)) {
            $areaModel = $this->_areaFactory->create();
            $this->_areaResourceModel->load($areaModel, $areaId);
            $areaData = [
                'id' => $areaModel->getId(),
                'name' => $areaModel->getName(),
            ];
        }
        echo json_encode($areaData);
        exit;
    }


}
