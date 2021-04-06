<?php


namespace Majordomo\Area\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class AreaCustomer extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'majordomo_area_area_customer';

    protected $_cacheTag = 'majordomo_area_area_customer';

    protected $_eventPrefix = 'majordomo_area_area_customer';

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    protected function _construct()
    {
        $this->_init('Majordomo\Area\Model\ResourceModel\AreaCustomer');
    }

}
