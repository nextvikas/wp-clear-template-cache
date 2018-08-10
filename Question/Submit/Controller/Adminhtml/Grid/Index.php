<?php
namespace Question\Submit\Controller\Adminhtml\Grid;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
class Index extends Action
{
   
    protected $resultPageFactory;
 
   
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
       
    }
 
   
    public function execute()
    {
       
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Question_Submit::grid');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Question Submit View'), __('Question Submit View'));
        $resultPage->getConfig()->getTitle()->prepend(__('Question  Submit'));
 
        return $resultPage;
    }
}