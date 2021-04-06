<?php


namespace Majordomo\Area\Model\ResourceModel\AreaCustomer;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = ['area_id', 'customer_id'];
    protected $_eventPrefix = 'majordomo_area_area_customer_collection';
    protected $_eventObject = 'area_customer_collection';

    protected function _construct()
    {
        $this->_init('Majordomo\Area\Model\AreaCustomer', 'Majordomo\Area\Model\ResourceModel\AreaCustomer');
    }

}
