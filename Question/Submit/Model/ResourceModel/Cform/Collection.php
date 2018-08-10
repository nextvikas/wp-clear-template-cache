<?php
namespace Question\Submit\Model\ResourceModel\Cform;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Question\Submit\Model\Cform', 'Question\Submit\Model\ResourceModel\Cform');
    }

}