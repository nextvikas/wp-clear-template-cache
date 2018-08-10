<?php 
  /**
   * Copyright © 2016 Magento. All rights reserved.
   * See COPYING.txt for license details.
   */
  namespace Question\Submit\Controller\Account;

  class Question extends \Magento\Framework\App\Action\Action
  {
    protected $_modelFactory;
    protected $_pageFactory;
    protected $_customerSession;
    protected $date;
    protected $_transportBuilder;
    protected $_storeManager;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Stdlib\DateTime\DateTime $date,
       \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
       \Question\Submit\Model\CformFactory $modelFactory,
       \Magento\Store\Model\StoreManagerInterface $storeManager,
       \Magento\Customer\Model\Session $customerSession)
    {
      $this->_modelFactory = $modelFactory;
      $this->_pageFactory = $pageFactory;
      $this->date = $date;
      $this->_storeManager = $storeManager;
      $this->_transportBuilder = $transportBuilder;
      $this->_customerSession = $customerSession;
      parent::__construct($context);
    }

    public function execute()
    {
      $post = (array) $this->getRequest()->getPostValue();
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      if (!empty($post) && $this->_customerSession->isLoggedIn()) {

        $requestData = array();
        $requestData['fname'] = $this->_customerSession->getCustomer()->getFirstname();
        //$requestData['address'] = 'address';
        //$requestData['city'] = 'chandigarh';
        //$requestData['state'] = 'chandigarh';
        $requestData['message'] = $post['question'];
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($requestData);

        $transport = $this->_transportBuilder->setTemplateIdentifier('send_email_email_template')
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
            ->setTemplateVars(
                [
                    'data' => $postObject,
                ]
            )
            ->setFrom('general')
            // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
            ->addTo($this->_customerSession->getCustomer()->getEmail(), $this->_customerSession->getCustomer()->getFirstname())
            ->getTransport();
        $transport->sendMessage();

        $this->messageManager->addSuccess(
        __('email send')
        );


        $post['addtime'] = time();
        $post['user_id'] = $this->_customerSession->getCustomer()->getId();
        $post['answer'] = "";
        $data = $objectManager->create('Question\Submit\Model\Cform');
        $data->setData($post)->save();
        $data->unsetData();
        $this->messageManager->addSuccess(__('Question successfully submitted'));
      }
      $this->_view->loadLayout();
      $this->_view->renderLayout();
    }
}