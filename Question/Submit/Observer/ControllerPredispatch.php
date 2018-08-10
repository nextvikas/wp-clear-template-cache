<?php
namespace Question\Submit\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class ControllerPredispatch implements ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $http;

    /** @var \Magento\Customer\Model\Session */
    protected $customerSession;

    /**
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\App\Response\Http $http
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Response\Http $http,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->url = $url;
        $this->http = $http;
        $this->customerSession = $customerSession;
    }

    /**
     * Manages redirect
     */
    public function execute(Observer $observer)
    {
        /**
         * Check if user logged in
         */
        if ($this->customerSession->isLoggedIn()) {
            return;
        }
        if($observer->getRequest()->getFullActionName() == 'learning_account_question') {
            $this->http->setRedirect($this->url->getUrl('customer/account/login'), 301);
        }
    }
}