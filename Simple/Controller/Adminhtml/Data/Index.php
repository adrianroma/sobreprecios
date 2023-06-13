<?php

namespace SussexDev\Simple\Controller\Adminhtml\Data;

use SussexDev\Simple\Controller\Adminhtml\Data;

class Index extends Data
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
