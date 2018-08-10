<?php
 
namespace Question\Submit\Block\Adminhtml\Grid\Edit;
 
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }
	protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('question_form_data');
 
        $isElementDisabled = false;
 
        $form = $this->_formFactory->create(
            ['data' => ['question_id' => 'edit_form', 'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))), 'method' => 'post', 'id'=>'edit_form']]
        );
 
        $form->setHtmlIdPrefix('page_');
 
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Question Information')]);
 
        if ($model->getId()) {
            $fieldset->addField('question_id', 'hidden', ['name' => 'question_id']);
        }
 


        // $fieldset->addField(
        //     'content',
        //     'editor',
        //     [
        //         'name' => 'content',
        //         'label' => __('Body'),
        //         'title' => __('Body'),
        //         'rows' => '5',
        //         'cols' => '30',
        //         'wysiwyg' => true,
        //         'config' => $this->_wysiwygConfig->getConfig(),
        //         'required' => true
        //     ]
        // );

        // $fieldset->addField(
        //     'answer',
        //     'editor',            
        //     [
        //         'name' => 'answer',
        //         'label' => __('Answer'),
        //         'title' => __('Answer'),
        //         'rows' => '5',
        //         'cols' => '30',
        //         'wysiwyg' => true,
        //         'config' => $this->_wysiwygConfig->getConfig(),
        //         'required' => false,
        //         'disabled' => $isElementDisabled
        //     ]
        // );


        $fieldset->addField(
            'answer',
            'textarea',            
            [
                'name' => 'answer',
                'label' => __('Answer'),
                'title' => __('Answer'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );

        //  $fieldset->addField(
        //     'name',
        //     'text',
        //     [
        //         'name' => 'name',
        //         'label' => __('Name'),
        //         'title' => __('Name'),
        //         'required' => true,
        //         'value' => $this->_adminSession->getUser()->getFirstname(),
        //         'disabled' => $isElementDisabled
        //     ]
        // );

        // $fieldset->addField(
        //     'title',
        //     'text',
        //     [
        //         'name' => 'title',
        //         'label' => __('Blog Title'),
        //         'title' => __('Blog Title'),
        //         'required' => true,
        //         'disabled' => $isElementDisabled
        //     ]
        // );
          

       
 

 
      
        // $dateFormat = $this->_localeDate->getDateFormat(
        //     \IntlDateFormatter::SHORT
        // );
 
      
 
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'values' => ['1' => __('Enable'), '0' => __('Disable')],
                'disabled' => $isElementDisabled
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '0' : '1');
        }
 
        
        //$this->setForm($form);
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
	
	
}