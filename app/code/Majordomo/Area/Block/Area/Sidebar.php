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
    )
    {
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
        foreach ($areasByAddresses as $areas) {
            foreach ($areas as $area) {
                $url = $this->getUrl('area', ['area_id' => $area->getId()]);
                $sortableLink[] = $this->createLinkBlock($area->getName(), $url, $sortOrder);
            }
        }
        usort($sortableLink, [$this, "compare"]);
        return array_merge($sortableLink, $links);
    }

    private function createLinkBlock(string $label, string $path, int $sortOrder)
    {
        $sortLink = $this->getLayout()
            ->createBlock('Majordomo\Area\Block\Area\SortLink')
            ->setLabel($label)
            ->setPath($path)
            ->setSortOrder($sortOrder);
        return $sortLink;
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
