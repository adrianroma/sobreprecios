<?php

namespace SussexDev\Simple\Cron;

class Products
{

    public function __construct(    
        \SussexDev\Simple\Model\Storage\Dbstorage $storage,
        \SussexDev\Simple\Model\ResourceModel\Inventory $inventory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ){

        $this->storage = $storage;
        $this->date = $date;
        $this->inventory = $inventory;

    }

	public function execute()
	{

        /** CLEAR ORIGINAL TABLE */
        $this->inventory->truncateTable();


    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
    /** Apply filters here */
    $collection = $productCollection->addAttributeToSelect('*')->load();
 
        $bulkInsert = [];

        $date = $this->date->gmtDate();


        foreach($collection as $product){


          $sobrepecio = $product->getData('sobreprecio');
          if($sobrepecio==null){
            $sobrepecio = 0;
          }

          $costoenvio = $product->getData('costoenvio');
          if($costoenvio==null){
            $costoenvio = 0;
          }

          if($product->getData('lockprice')==1){
            $original_price =  $product->getData('price_original');
          }else{
            $original_price = $product->getData('price');
          }

            $bulkInsert[] = [
                'data_id' => $product->getData('id'),
                'sku' => $product->getData('sku'),
                'sobreprecio'=>$sobrepecio,
                'costoenvio'=>$costoenvio,
                'created_at'=>$date,
                'updated_at'=>$date,
                'originalprice'=>$original_price,
                'price'=>$product->getData('price'),
                'lockprice'=> $product->getData('lockprice')

            ];
        }

        // UPDATE TABLE 

        $this->storage->insertMultiple($bulkInsert, 'chupaprecios',);

		return $this;

	}
}

