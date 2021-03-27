<?php


namespace Majordomo\House\Model\House;


use Majordomo\House\Model\ResourceModel\House\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $houseCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $houseCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $house) {
            $this->loadedData[$house->getId()]['house'] = $house->getData();
        }

        return $this->loadedData;
    }


}