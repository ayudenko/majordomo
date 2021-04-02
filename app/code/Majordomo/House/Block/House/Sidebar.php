<?php


namespace Majordomo\House\Block\House;


use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Html\Links;
use Magento\Framework\View\Element\Template\Context;
use Majordomo\House\Model\HouseFactory;
use Majordomo\House\Model\ResourceModel\House\Collection;

class Sidebar extends Links
{

    protected HouseFactory $_houseFactory;
    protected Session $_customerSession;

    public function __construct(
        Context $context,
        HouseFactory $houseFactory,
        Session $session,
        array $data = []
    )
    {
        $this->_houseFactory = $houseFactory;
        $this->_customerSession = $session;
        parent::__construct($context, $data);
    }

    /**
     * @inheritdoc
     * @since 101.0.0
     */
    public function getLinks()
    {
        $links = $this->_layout->getChildBlocks($this->getNameInLayout());
        $sortableLink = [];
        foreach ($links as $key => $link) {
            if ($link instanceof SortLinkInterface) {
                $sortableLink[] = $link;
                unset($links[$key]);
            }
        }

        $houses = $this->getHousesByCustomer();
        $sortOrder = 10;
        foreach ($houses as $house) {
            $sortLink = $this->getLayout()->createBlock('Magento\Customer\Block\Account\SortLink');
            $sortLink->setLabel($house->getName());
            $sortLink->setPath('house');
            $sortLink->setSortOrder($sortOrder++);
            $sortableLink[] = $sortLink;
        }

        usort($sortableLink, [$this, "compare"]);
        return array_merge($sortableLink, $links);
    }

    private function getHousesByCustomer(): Collection
    {
        $customer = $this->_customerSession->getCustomer();
        $houses = $this->_houseFactory->create()->getHousesByCustomer($customer);
        return $houses;
    }

    /**
     * Compare sortOrder in links.
     *
     * @param SortLinkInterface $firstLink
     * @param SortLinkInterface $secondLink
     * @return int
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function compare(SortLinkInterface $firstLink, SortLinkInterface $secondLink): int
    {
        return $secondLink->getSortOrder() <=> $firstLink->getSortOrder();
    }

}
