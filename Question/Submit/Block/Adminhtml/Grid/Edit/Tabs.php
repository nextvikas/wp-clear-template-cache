<?php
namespace Question\Submit\Block\Adminhtml\Grid\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
   
    protected function _construct()
    {
        parent::_construct();
        $this->setId('question_id');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Question Information'));
    }

    // protected function _beforeToHtml()
    // {
    //     $this->addTab(
    //         'grid_main',
    //         [
    //             'label' => __('General'),
    //             'title' => __('General'),
    //             'content' => $this->getLayout()->createBlock(
    //                 'Question\Submit\Block\Adminhtml\Grid\Edit\Tab\Main'
    //             )->toHtml(),
    //             'active' => true
    //         ]
    //     );

    //     return parent::_beforeToHtml();
    // }



}