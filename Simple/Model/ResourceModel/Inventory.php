<?php

namespace SussexDev\Simple\Model\ResourceModel;

class Inventory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
     protected function _construct()
     {
          $this->_init('chupaprecios', 'data_id');
     }
    public function truncateTable()
        {
            if ($this->getConnection()->getTransactionLevel() > 0) {
                $this->getConnection()->delete($this->getMainTable());
            } else {
                $this->getConnection()->truncateTable($this->getMainTable());
            }
    
            return $this;
        }
}