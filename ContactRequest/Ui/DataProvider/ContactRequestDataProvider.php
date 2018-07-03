<?php
namespace Test\ContactRequest\Ui\DataProvider;

use Test\ContactRequest\Model\ResourceModel\ContactRequestCollectionFactory as CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class ContactRequestDataProvider
 */
class ContactRequestDataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactRequestCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactRequestCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactRequestCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $employee) {
            $this->_loadedData[$employee->getId()] = $employee->getData();
        }
        return $this->_loadedData;
    }
}