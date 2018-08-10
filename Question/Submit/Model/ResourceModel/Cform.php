<?php

namespace Question\Submit\Model\ResourceModel;

class Cform extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $storeManager;

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->storeManager = $storeManager;
    }

    protected function _construct()
    {
        $this->_init('new_questions', 'question_id');
    }
}