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

    public function getHousesByCustomerId(int $customerId): self
    {
        $this->getSelect()
            ->join(
                ['house_customer' => $this->getTable('majordomo_house_customer')],
                'main_table.house_id=house_customer.house_id',
                ['house_customer.*'],
            )->join(
                ['customer' => $this->getTable('customer_entity')],
                'house_customer.customer_id=customer.entity_id',
                ['customer.*']
            )
            ->where('customer.entity_id', $customerId);
            return $this;
    }

    public function getHousesByHouseId(int $houseId): self
    {
        $this->getSelect()
            ->join(
                ['house_customer' => $this->getTable('majordomo_house_customer')],
                'main_table.house_id=house_customer.house_id',
                ['house_customer.*'],
            )->join(
                ['customer' => $this->getTable('customer_entity')],
                'house_customer.customer_id=customer.entity_id',
                ['customer.*']
            )
            ->where('main_table.house_id', $houseId);
        return $this;
    }

}
