<?php

namespace SussexDev\Sample\Controller\Adminhtml\Data;

use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Message\Manager;
use Magento\Framework\Api\DataObjectHelper;
use SussexDev\Sample\Api\DataRepositoryInterface;
use SussexDev\Sample\Api\Data\DataInterface;
use SussexDev\Sample\Api\Data\DataInterfaceFactory;
use SussexDev\Sample\Controller\Adminhtml\Data;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\UrlRewrite;



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
        UrlRewriteFactory $urlRewriteFactory,
        UrlRewrite $urlCollection

    ) {
        $this->messageManager   = $messageManager;
        $this->dataFactory      = $dataFactory;
        $this->dataRepository   = $dataRepository;
        $this->dataObjectHelper  = $dataObjectHelper;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->urlCollection = $urlCollection;

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


        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('data_id');
            if ($id) {
                $model = $this->dataRepository->getById($id);
            } else {
                unset($data['data_id']);
                $model = $this->dataFactory->create();
            }


            try {
                $this->dataObjectHelper->populateWithArray($model, $data, DataInterface::class);
                $this->dataRepository->save($model);
                $this->CreateURL($model->getId(),$model->getUrl());
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

    public function CreateURL($id,$uri){
        $target_path = "simplecontroller/index/index/id/".$id;

        $UrlRewriteCollection=$this->urlCollection->getCollection()->addFieldToFilter('target_path',$target_path);
         $deleteItem = $UrlRewriteCollection->getFirstItem(); 
         if ($UrlRewriteCollection->getFirstItem()->getId()) {
             // target path does exist
             $deleteItem->delete();
            
        }
 
         $urlRewriteModel = $this->urlRewriteFactory->create();
         $urlRewriteModel->setStoreId(1);
         $urlRewriteModel->setIsSystem(0);
         $urlRewriteModel->setIdPath(rand(1, 100000));
         $urlRewriteModel->setTargetPath("simplecontroler/index/index/id/".$id);
         $urlRewriteModel->setRequestPath($uri);
         $urlRewriteModel->save();


    }
}
