<?php


namespace Majordomo\Area\Block\Area;


use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Html\Links;
use Magento\Framework\View\Element\Template\Context;
use Majordomo\Area\Model\AreaFactory;

class Sidebar extends Links
{

    protected AreaFactory $_areaFactory;
    protected Session $_customerSession;
    protected UrlInterface $_urlInterface;

    public function __construct(
        Context $context,
        AreaFactory $areaFactory,
        Session $session,
        UrlInterface $urlInterface,
        array $data = []
    ) {
        $this->_areaFactory = $areaFactory;
        $this->_customerSession = $session;
        $this->_urlInterface = $urlInterface;
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

        $areasByAddresses = $this->getAreasByCustomer();
        $sortOrder = 10;
        foreach ($areasByAddresses as $address => $areas) {
            $sortableLink[] = $this->createSectionBlock($address, $sortOrder++);
            foreach ($areas as $area) {
                $url = $this->getUrl('area', ['area_id' => $area->getId()]);
                $sortableLink[] = $this->createSortableLinkBlock($area->getName(), $url, $sortOrder++);
            }
        }
        usort($sortableLink, [$this, "compare"]);
        return array_merge($sortableLink, $links);
    }

    private function getAreasByCustomer(): array
    {
        $customer = $this->_customerSession->getCustomer();
        $areas = $this->_areaFactory->create()->getAreasByCustomer($customer);
        $addresses = [];
        foreach ($areas as $area) {
            $addresses[$area['address']][] = $area;
        }
        return $addresses;
    }

    private function createSortableLinkBlock(string $label, string $path, int $sortOrder)
    {
        return $this->getLayout()
            ->createBlock('Majordomo\Area\Block\Area\SortLink')
            ->setLabel($label)
            ->setPath($path)
            ->setSortOrder($sortOrder);
    }

    private function createSectionBlock(string $label, int $sortOrder)
    {
        return $this->getLayout()
            ->createBlock('Majordomo\Area\Block\Area\Section')
            ->setLabel($label)
            ->setSortOrder($sortOrder);
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
