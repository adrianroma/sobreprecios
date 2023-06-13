<?php
/*
 * SussexDev_Simple

 * @category   SussexDev
 * @package    SussexDev_Simple
 * @copyright  Copyright (c) 2019 Scott Parsons
 * @license    https://github.com/ScottParsons/module-Simpleuicomponent/blob/master/LICENSE.md
 * @version    1.1.2
 */
namespace SussexDev\Simple\Controller\Adminhtml\Data;

use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Message\Manager;
use Magento\Framework\Api\DataObjectHelper;
use SussexDev\Simple\Api\DataRepositoryInterface;
use SussexDev\Simple\Api\Data\DataInterface;
use SussexDev\Simple\Api\Data\DataInterfaceFactory;
use SussexDev\Simple\Controller\Adminhtml\Data;

class Save extends Data
{
    /**
     * @var Manager
     */
    protected $messageManager;

    /**
     * @var DataRepositoryInterface
     */
    protected $dataRepository;

    /**
     * @var DataInterfaceFactory
     */
    protected $dataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        Registry $registry,
        DataRepositoryInterface $dataRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Manager $messageManager,
        DataInterfaceFactory $dataFactory,
        DataObjectHelper $dataObjectHelper,
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->messageManager   = $messageManager;
        $this->dataFactory      = $dataFactory;
        $this->dataRepository   = $dataRepository;
        $this->dataObjectHelper  = $dataObjectHelper;
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
        parent::__construct($registry, $dataRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();


        if($data['lockprice']==0){
        $data['price'] = $data['sobreprecio']+$data['price'];
        $data['lockprice']==1;
        }else{
        $data['price'] = $data['sobreprecio']+$data['originalprice']; 
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('data_id');
            if ($id) {
                $model = $this->dataRepository->getById($id);
            } else {
                unset($data['data_id']);
                $model = $this->dataFactory->create();
            }

            try{

           $sobreprecio = $data['sobreprecio'];   
           $costoenvio = $data['costoenvio'];
          


           $storeId = $this->storeManager->getStore()->getId(); 

           $product = $this->productRepository->getById($id);
           $price = $product->getPrice();

           $totalPrice = $sobreprecio + $price;
           $product->setSobrecosto($sobreprecio);
           $product->setCostoenvio($costoenvio);
           $product->setPrice($totalPrice);
           if($product->getData('lock_price')==0 || $product->getData('lock_price')==NULL){
            $product->setData('price_original',$price);
            $product->setData('lock_price',1);
           }

           $this->productRepository->save($product);

            }catch(\Exception $e){

            }


            try {
                $this->dataObjectHelper->populateWithArray($model, $data, DataInterface::class);
                $this->dataRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['data_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['data_id' => $this->getRequest()->getParam('data_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
