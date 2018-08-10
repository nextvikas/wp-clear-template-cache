<?php
namespace Question\Submit\Model;
 
class Grid extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Question\Submit\Model\ResourceModel\Grid');
    }
	public function toOptionArray()
	{
		return [
			['value' => '10', 'label' => __('10')],
			['value' => '15', 'label' => __('15')],
			['value' => '20', 'label' => __('20')],
			['value' => '25', 'label' => __('25')],
			['value' => '30', 'label' => __('30')]
		];
	}

}
 
?>