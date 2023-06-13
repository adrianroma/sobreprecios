<?php

namespace SussexDev\Sample\Controller\Adminhtml\Data;

use SussexDev\Sample\Controller\Adminhtml\Data;

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
