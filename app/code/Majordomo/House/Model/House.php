<?php


namespace Majordomo\House\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class House extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'majordomo_house_house';

    protected $_cacheTag = 'majordomo_house_house';

    protected $_eventPrefix = 'majordomo_house_house';

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
        $this->_init('Majordomo\House\Model\ResourceModel\House');
    }

}
