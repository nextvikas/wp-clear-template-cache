<?php

namespace Question\Submit\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Question_Submit::view');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');        
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('Question\Submit\Model\Grid');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The question has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['question_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a question to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}