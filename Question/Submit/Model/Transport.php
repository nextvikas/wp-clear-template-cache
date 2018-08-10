<?php
/**
 * Mail Transport
 */
namespace Question\Submit\Model;
 
class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;
 
    /**
     * @param MessageInterface $message
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Question\Submit\Helper\Data $helperData
        )
    {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }
         $smtpHost= $helperData->getGeneralConfig('question_smtphost');//your smtp host  ';
         $smtpConf = [
            'auth' => 'login',//auth type
            'ssl' => 'ssl', 
            'port' => '465',
            'username' => $helperData->getGeneralConfig('question_smtpusername'),//smtm user name
            'password' => $helperData->getGeneralConfig('question_smtppassword')//smtppassword 
         ];
 
        parent::__construct($smtpHost, $smtpConf);
        $this->_message = $message;
    }
 
    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }
}