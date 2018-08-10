<?php
namespace Question\Submit\Block\Adminhtml\Grid;
 
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $moduleManager;
   
    protected $_gridFactory; 
   
    protected $_status;   
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Question\Submit\Model\GridFactory $gridFactory,
        \Question\Submit\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {

        $this->_gridFactory = $gridFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    } 
   
    protected function _construct()
    {
        parent::_construct();
        $this->setId('question_id');
        $this->setDefaultSort('question_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('question');

    } 
   
    protected function _prepareCollection()
    {

        $collection = $this->_gridFactory->create()->getCollection();
        $collection->getSelect()->join(
            array('ar' =>'customer_entity'),
            'ar.entity_id = main_table.user_id',
            array('firstname')
        );
        $this->setCollection($collection);
        parent::_prepareCollection();

        return $this;
    }
 
    protected function _prepareColumns()
    {

        $this->addColumn(
            'firstname',
            [
                'header' => __('User Name'),
                'index' => 'firstname',                
                'class' => 'xxx'
            ]

        );

        $this->addColumn(
            'question',
            [
                'header' => __('Question'),
                'index' => 'question',                
                'class' => 'xxx'
            ]

        );
 
        $this->addColumn(
            'answer',
            [
                'header' => __('Answer'),
                'index' => 'answer',                
                'class' => 'xxx'
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => $this->_status->getOptionArray(),
                'header_css_class' => 'col-status',
                'column_css_class' => 'col-status'
            ]
        );



        $this->addColumn(
            'addtime',
            [
                'header' => __('Created At'),
                'index' => 'addtime'
            ]
        );
 
 
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'question/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
 
        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'question/*/delete'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );




        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
 
        return parent::_prepareColumns();
    }
 
   
    // public function _prepareDataSource(array $dataSource)
    // {

    //     print_r($dataSource);
    //     die();
        
    //    if (isset($dataSource['data']['status'])) {
    //     print_r($dataSource);
    //     die();
    //     // foreach ($dataSource['data']['items'] as & $item) {
    //     //     try {
    //     //             if ($order = $this->_orderRepository->loadByIncrementId($item['order_id'])) {
    //     //                 $url = $this->_urlBuilder->getUrl($this->_editUrl,['order_id' => $order->getEntityId()]);      
    //     //                 $item[$this->getData('name')] = html_entity_decode("<a href=\"$url\" target=\"_blank\">" . $item['order_id'] . "</a>");
    //     //             }
    //     //         } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {

    //     //         }
    //     //     }
    //     }
    //     return $dataSource;
    // }



    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('question_id');
        $this->getMassactionBlock()->setFormFieldName('question_id');
 
        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('question/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );
 
        $statuses = $this->_status->toOptionArray();
 
        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('question/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );
 
 
        return $this;
    }
 
  
    public function getGridUrl()
    {
        return $this->getUrl('question/*/grid', ['_current' => true]);
    }
 
    
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'question/*/edit',
            ['id' => $row->getId()]
        );
    }
}