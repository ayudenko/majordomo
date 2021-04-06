<?php


namespace Majordomo\Area\Model\Area;


use Majordomo\Area\Model\ResourceModel\Area\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $areaCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $areaCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $area) {
            $this->loadedData[$area->getId()]['area'] = $area->getData();
        }

        return $this->loadedData;
    }


}
