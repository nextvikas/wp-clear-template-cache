<?php

namespace Question\Submit\Model;

class Cform extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */

    protected function _construct()
    {
        $this->_init('Question\Submit\Model\ResourceModel\Cform');
    }

}