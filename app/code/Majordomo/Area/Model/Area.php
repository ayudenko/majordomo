<?php


namespace Majordomo\Area\Model;


use Magento\Customer\Model\Customer;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Majordomo\Area\Model\ResourceModel\Area\CollectionFactory;
use Majordomo\Area\Model\ResourceModel\Area\Collection;

class Area extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'majordomo_area_area';

    protected $_cacheTag = 'majordomo_area_area';

    protected $_eventPrefix = 'majordomo_area_area';

    protected $_collectionFactory;

    public function __construct(
        Context $context,
        Registry $registry, // TODO: refactor deprecated
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        CollectionFactory $collectionFactory,
        array $data = []
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

    public function getAreasByCustomer(Customer $customer): Collection
    {
        return $this->_collectionFactory->create()->getAreasByCustomerId($customer->getId())->addFieldToSelect(['name']);
    }

    protected function _construct()
    {
        $this->_init('Majordomo\Area\Model\ResourceModel\Area');
    }

}
