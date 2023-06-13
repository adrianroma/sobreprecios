<?php

namespace SussexDev\Simple\Model;

use Magento\Framework\Model\AbstractModel;
use SussexDev\Simple\Api\Data\DataInterface;

class Data extends AbstractModel implements DataInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'chupaprecios';

    /**
     * Initialise resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init('SussexDev\Simple\Model\ResourceModel\Data');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getData(DataInterface::SKU);
    }

    /**
     * Set title
     *
     * @param $title
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(DataInterface::SKU, $sku);
    }

    /**
     * Get data description
     *
     * @return string
     */
    public function getSobreprecio()
    {
        return $this->getData(DataInterface::SOBREPRECIO);
    }

    /**
     * Set data description
     *
     * @param $description
     * @return $this
     */
    public function setSobreprecio($sobreprecio)
    {
        return $this->setData(DataInterface::SOBREPRECIO, $sobreprecio);
    }

    /**
     * Get is active
     *
     * @return bool|int
     */
    public function getCostoenvio()
    {
        return $this->getData(DataInterface::COSTOENVIO);
    }

    /**
     * Set is active
     *
     * @param $isActive
     * @return $this
     */
    public function setCostoEnvio($costoenvio)
    {
        return $this->setData(DataInterface::COSTOENVIO, $costoenvio);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(DataInterface::CREATED_AT);
    }

    /**
     * Set created at
     *
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(DataInterface::CREATED_AT, $createdAt);
    }

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(DataInterface::UPDATED_AT);
    }

    /**
     * Set updated at
     *
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(DataInterface::UPDATED_AT, $updatedAt);
    }

   

    public function getOriginalprice()
    {
        return $this->getData(DataInterface::ORIGINALPRICE);
    }

    /**
     * Set updated at
     *
     * @param $updatedAt
     * @return $this
     */
    public function setOriginalprice($price)
    {
        return $this->setData(DataInterface::ORIGINALPRICE, $price);
    }

    public function getLockprice()
    {
        return $this->getData(DataInterface::LOCKPRICE);
    }

    /**
     * Set updated at
     *
     * @param $updatedAt
     * @return $this
     */
    public function setLockprice($lock)
    {
        return $this->setData(DataInterface::LOCKPRICE, $lock);
    }

    public function getPrice()
    {
        return $this->getData(DataInterface::PRICE);
    }

    /**
     * Set updated at
     *
     * @param $updatedAt
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(DataInterface::PRICE, $price);
    }


}
