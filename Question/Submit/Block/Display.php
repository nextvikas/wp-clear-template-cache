<?php
namespace Question\Submit\Block;
class Display extends \Magento\Framework\View\Element\Template
{
	protected $_modelFactory;
	protected $_customerSession;
    protected $helperData;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Question\Submit\Model\CformFactory $modelFactory,
        \Question\Submit\Helper\Data $helperData,
		\Magento\Customer\Model\Session $customerSession
	)
	{
		$this->_modelFactory = $modelFactory;
        $this->helperData = $helperData;
		$this->_customerSession = $customerSession;
		parent::__construct($context);
	}



    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('My Question'));
        $perpage=($this->helperData->getGeneralConfig('question_page'))?$this->helperData->getGeneralConfig('question_page'):10;
        if ($this->getQuestionHistory()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'question.submit.display'
            )->setLimit($perpage)->setAvailableLimit(array(10=>10,15=>15,20=>20,25=>25,30=>30))
                ->setShowPerPage(true)->setCollection(
                $this->getQuestionHistory()
            );
            $this->setChild('pager', $pager);
            $this->getQuestionHistory()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    Public function getQuestionHistory()
    {
        $perpage=($this->helperData->getGeneralConfig('question_page'))?$this->helperData->getGeneralConfig('question_page'):10;

        //get values of current page
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest
        ()->getParam('limit') : $perpage;

        $collection = $this->_modelFactory->create()->getCollection()->addFieldToFilter('user_id',$this->_customerSession->getCustomer()->getId())->addFieldToFilter('status',1);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection;
    }
	public function getCustomerName(){
	    return $this->_customerSession->getCustomer()->getName();
	}
	public function sayHello()
	{
		return __('Hello World');
	}
    public function getCustomerCollection()
    {
        return $this->_modelFactory->create()->getCollection()->addFieldToFilter('user_id',$this->_customerSession->getCustomer()->getId())->addFieldToFilter('status',1)->getData();
    }
}
