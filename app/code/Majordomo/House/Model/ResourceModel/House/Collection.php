<?php


namespace Majordomo\House\Model\ResourceModel\House;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'house_id';
    protected $_eventPrefix = 'majordomo_house_house_collection';
    protected $_eventObject = 'house_collection';

    protected function _construct()
    {
        $this->_init('Majordomo\House\Model\House', 'Majordomo\House\Model\ResourceModel\House');
    }

}
