<?php


namespace Majordomo\Customer\Model;


use Magento\Customer\Model\Address;

class Customer extends \Magento\Customer\Model\Customer
{

    /**
     * Get customer default section address
     *
     * @return Address
     */
    public function getPrimarySectionAddress()
    {
        return $this->getPrimaryAddress('default_section');
    }

    /**
     * Get customer default section address
     *
     * @return Address
     */
    public function getDefaultSectionAddress()
    {
        return $this->getPrimarySectionAddress();
    }

}
