<?php


namespace Majordomo\House\Controller\House;


use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use Majordomo\House\Model\HouseFactory;
use Majordomo\House\Model\ResourceModel\House;

class Ajax implements HttpGetActionInterface
{

    protected PageFactory $_pageFactory;
    protected RequestInterface $_request;
    protected HouseFactory $_houseFactory;
    protected House $_houseResourceModel;

    public function __construct(
        PageFactory $pageFactory,
        RequestInterface $request,
        HouseFactory $houseFactory,
        House $houseResourceModel
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_houseFactory = $houseFactory;
        $this->_houseResourceModel = $houseResourceModel;
    }

    public function execute()
    {
        $houseId = $this->_request->getParam('houseId', '');
        $houseData = [];
        if (!empty($houseId)) {
            $houseModel = $this->_houseFactory->create();
            $this->_houseResourceModel->load($houseModel, $houseId);
            $houseData = [
                'id' => $houseModel->getId(),
                'name' => $houseModel->getName(),
            ];
        }
        echo json_encode($houseData);
        exit;
    }


}
