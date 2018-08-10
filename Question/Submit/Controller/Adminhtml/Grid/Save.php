<?php
namespace Question\Submit\Controller\Adminhtml\Grid;
use Magento\Backend\Model\Auth\Session;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{

    protected $_adminSession;
    
    public function __construct(Action\Context $context,\Magento\Backend\Model\Auth\Session $adminSession
        )
    {       
       parent::__construct($context);
       $this->_adminSession = $adminSession;      
    }

    public function execute()
    {
       
        $data = $this->getRequest()->getPostValue();
        //$nm=$data1["name"];
        //$date=date("Y-m-d");              

        // $useremail = $this->_adminSession->getUser()->getEmail();
        // $username = $this->_adminSession->getUser()->getFirstname();
        // if($username == $nm)  
        // {    $username = $this->_adminSession->getUser()->getFirstname(); }
        // else
        //  {   $username = $nm; }


      
        //$array2 = array("user" => $useremail, "name" => $username,"createat" => $date);
        //$data = array_merge($data1, $array2);
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Question\Submit\Model\Grid');

            $id = $this->getRequest()->getParam('question_id');
            if ($id) {
                $model->load($id);
            }

            $data['ans_time'] = date('Y-m-d H:i:s');
            $model->setData($data);      

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('question/*/edit',['question_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['question_id' => $this->getRequest()->getParam('question_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}