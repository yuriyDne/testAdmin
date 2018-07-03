<?php

namespace Test\ContactRequest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Test\ContactRequest\Model\ContactRequest;

/**
 * Class ContactRequestCollection
 */
class ContactRequestCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'request_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            ContactRequest::class,
            ContactRequestModel::class
        );
    }
}