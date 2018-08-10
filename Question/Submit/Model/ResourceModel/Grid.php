<?php
namespace Question\Submit\Model\ResourceModel;
 
class Grid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    protected function _construct()
    {
        $this->_init('new_questions', 'question_id');
    }
}
