<?php

namespace SussexDev\Simple\Api\Data;

interface DataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const DATA_ID           = 'data_id';
    const SKU                = 'sku';
    const SOBREPRECIO       = 'sobreprecio';
    const COSTOENVIO         = 'costoenvio';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';
    const ORIGINALPRICE    = 'originalprice';
    const LOCKPRICE        = 'lockprice';
    const PRICE        = 'price';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param $id
     * @return DataInterface
     */
    public function setId($id);

    /**
     * Get Data Title
     *
     * @return string
     */
    public function getSku();

    /**
     * Set Data Title
     *
     * @param $title
     * @return mixed
     */
    public function setSku($sku);

    /**
     * Get Data Description
     *
     * @return mixed
     */
    public function getSobrePrecio();

    /**
     * Set Data Description
     *
     * @param $description
     * @return mixed
     */
    public function setSobreprecio($sobreprecio);

    /**
     * Get is active
     *
     * @return bool|int
     */
    public function getCostoenvio();

    /**
     * Set is active
     *
     * @param $isActive
     * @return DataInterface
     */
    public function setCostoenvio($costoenvio);

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * set created at
     *
     * @param $createdAt
     * @return DataInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * set updated at
     *
     * @param $updatedAt
     * @return DataInterface
     */
    public function setUpdatedAt($updatedAt);



    public function getOriginalprice();

  
    public function setOriginalprice($price);


    
    public function getLockprice();

  
    public function setLockprice($lock);


    public function getPrice();

  
    public function setPrice($price);
}
