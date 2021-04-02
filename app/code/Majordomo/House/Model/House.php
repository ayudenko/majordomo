<?php


namespace Majordomo\House\Model;


use Magento\Customer\Model\Customer;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Majordomo\House\Model\ResourceModel\House\CollectionFactory;
use Majordomo\House\Model\ResourceModel\House\Collection;

class House extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'majordomo_house_house';

    protected $_cacheTag = 'majordomo_house_house';

    protected $_eventPrefix = 'majordomo_house_house';

    protected $_collectionFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getHousesByCustomer(Customer $customer): Collection
    {
        return $this->_collectionFactory->create()->getHousesByCustomerId($customer->getId())->addFieldToSelect(['name']);
    }

    protected function _construct()
    {
        $this->_init('Majordomo\House\Model\ResourceModel\House');
    }

}
