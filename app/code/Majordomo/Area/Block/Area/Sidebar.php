<?php


namespace Majordomo\Area\Block\Area;


use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Html\Links;
use Magento\Framework\View\Element\Template\Context;
use Majordomo\Area\Model\AreaFactory;
use Majordomo\Area\Model\ResourceModel\Area\Collection;

class Sidebar extends Links
{

    protected AreaFactory $_areaFactory;
    protected Session $_customerSession;

    public function __construct(
        Context $context,
        AreaFactory $areaFactory,
        Session $session,
        array $data = []
    )
    {
        $this->_areaFactory = $areaFactory;
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

        $areas = $this->getAreasByCustomer();
        $sortOrder = 10;
        foreach ($areas as $area) {
            $sortLink = $this->getLayout()->createBlock('Magento\Customer\Block\Account\SortLink');
            $sortLink->setLabel($area->getName());
            $sortLink->setPath('area');
            $sortLink->setSortOrder($sortOrder++);
            $sortableLink[] = $sortLink;
        }

        usort($sortableLink, [$this, "compare"]);
        return array_merge($sortableLink, $links);
    }

    private function getAreasByCustomer(): Collection
    {
        $customer = $this->_customerSession->getCustomer();
        $areas = $this->_areaFactory->create()->getAreasByCustomer($customer);
        return $areas;
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
