<?php

namespace SussexDev\Simple\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DataSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \SussexDev\Simple\Api\Data\DataInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param \SussexDev\Simple\Api\Data\DataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
