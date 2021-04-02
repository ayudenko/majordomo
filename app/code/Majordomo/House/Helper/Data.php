<?php


namespace Majordomo\House\Helper;


use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Majordomo\House\Model\HouseFactory;

class Data extends AbstractHelper
{

    protected HouseFactory $_houseFactory;
    protected Session $_session;
    private array $_houses = [];

    public function __construct(
        Context $context,
        HouseFactory $houseFactory,
        Session $session
    )
    {
        $this->_houseFactory = $houseFactory;
        $this->_session = $session;
        parent::__construct($context);
    }

    public function getLinks():array
    {
        //$houses = $this->getHousesByCustomer();
        $houses = [
            [
                'label' => 'house1',
                'path' => 'house/1',
            ],
            [
                'label' => 'house2',
                'path' => 'house/2'
            ],
        ];
        $links = [];
        if (count($houses) > 0) {
            foreach ($houses as $house) {
                $links[] = $house;
            }
        }
        return $links;
    }

    private function getHousesByCustomer():array
    {
        if (count($this->_houses) === 0) {
            $customer = $this->_session->getCustomer();
            $this->_houses = $this->_houseFactory->create()->getHousesByCustomer($customer);
        }
        return $this->_houses;
    }

}
