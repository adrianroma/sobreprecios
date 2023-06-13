<?php
namespace SussexDev\Sample\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \SussexDev\Sample\Model\ResourceModel\Data\CollectionFactory $dataModelFactory, 
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
 
    ) {
        $this->dataModelFactory =  $dataModelFactory;
        $this->request = $request;
        $id = $this->request->getParam('id');
        if(!empty($id)){
           $id = 1 ; 
        }
        $this->page = $this->dataModelFactory->create()->addFieldToFilter('data_id', array('eq' => $id))->getFirstItem();
        parent::__construct($context, $data);
    }

    public function getTitle(){

        if(!empty($this->data)){
            return $this->data->getData('data_title');
        }else{
            return 'CHUPAPRECIOS ARTICLES';
        }

    }

    public function getContent(){

        if(!empty($this->data)){
            return $this->data->getData('data_description');
        }else{
            return '<span>CHUPAPRECIOS TEXTOS</span>';
        }

    }

}
