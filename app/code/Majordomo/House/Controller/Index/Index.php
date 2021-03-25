<?php


namespace Majordomo\House\Controller\Index;


use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{

    protected $_pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        echo "Hellow, World!";
        exit;
    }

}