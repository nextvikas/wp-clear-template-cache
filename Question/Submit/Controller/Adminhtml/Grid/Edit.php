<?php
 
namespace Question\Submit\Controller\Adminhtml\Grid;
 
use Magento\Backend\App\Action;
 
class Edit extends \Magento\Backend\App\Action
{
   
    protected $_coreRegistry = null;
 
    protected $resultPageFactory;
 
  
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
 
   
    protected function _isAllowed()
    {
        return true;
    }

    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Question_Submit::grid')
            ->addBreadcrumb(__('Question'), __('Question'))
            ->addBreadcrumb(__('Manage Question'), __('Manage Question'));
        return $resultPage;
    }
 
  
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Question\Submit\Model\Grid');
 
        if ($id) {

            $model->load($id);
            if (!$model->getId()) {
                 
                $this->messageManager->addError(__('This question record no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
 
                return $resultRedirect->setPath('*/*/');
            }
        }
 
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
   
        if (!empty($data)) {
            $model->setData($data);
        }
 
        $this->_coreRegistry->register('question_form_data', $model);
        

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Question') : __('New Question'),
            $id ? __('Edit Question') : __('New Question')
        );



        //$this->_addContent($this->getLayout()->createBlock('Question\Submit\Block\Adminhtml\Grid\Edit'))->_addLeft($this->getLayout()->createBlock('Question\Submit\Block\Adminhtml\Grid\Edit\Tabs'));


        $resultPage->getConfig()->getTitle()->prepend(__('Edit'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getQuestion() : __('New Question')); 
        return $resultPage;
    }
}