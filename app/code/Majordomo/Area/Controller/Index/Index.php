<?php


namespace Majordomo\Area\Controller\Index;


use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index implements HttpGetActionInterface
{

    protected PageFactory $_pageFactory;
    protected RedirectFactory $_redirectFactory;
    protected Session $_session;

    public function __construct(
        PageFactory $pageFactory,
        RedirectFactory $redirectFactory,
        Session $session
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_redirectFactory = $redirectFactory;
        $this->_session = $session;
    }

    public function execute()
    {
        if ($this->_session->isLoggedIn()) {
            return $this->_pageFactory->create();
        }
        return $this->_redirectFactory->create()->setPath('/');
    }

}
