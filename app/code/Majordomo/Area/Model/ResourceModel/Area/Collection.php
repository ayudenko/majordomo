<?php


namespace Majordomo\Area\Model\ResourceModel\Area;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'area_id';
    protected $_eventPrefix = 'majordomo_area_area_collection';
    protected $_eventObject = 'area_collection';

    protected function _construct()
    {
        $this->_init('Majordomo\Area\Model\Area', 'Majordomo\Area\Model\ResourceModel\Area');
    }

    public function getAreasByCustomerId(int $customerId): self
    {
        $this->getSelect()
            ->join(
                ['area_customer' => $this->getTable('majordomo_area_customer')],
                'main_table.area_id=area_customer.area_id',
                ['area_customer.*'],
            )->join(
                ['customer' => $this->getTable('customer_entity')],
                'area_customer.customer_id=customer.entity_id',
                ['customer.*']
            );
        $this->addFieldToFilter('customer.entity_id', $customerId);
        return $this;
    }

    public function getAreasByAreaId(int $areaId): self
    {
        $this->getSelect()
            ->join(
                ['area_customer' => $this->getTable('majordomo_area_customer')],
                'main_table.area_id=area_customer.area_id',
                ['area_customer.*'],
            )->join(
                ['customer' => $this->getTable('customer_entity')],
                'area_customer.customer_id=customer.entity_id',
                ['customer.*']
            )
            ->where('main_table.area_id', $areaId);
        return $this;
    }

}
