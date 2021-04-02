<?php


namespace Majordomo\House\Model\ResourceModel\HouseCustomer;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = ['house_id', 'customer_id'];
    protected $_eventPrefix = 'majordomo_house_house_customer_collection';
    protected $_eventObject = 'house_customer_collection';

    protected function _construct()
    {
        $this->_init('Majordomo\House\Model\HouseCustomer', 'Majordomo\House\Model\ResourceModel\HouseCustomer');
    }

}
