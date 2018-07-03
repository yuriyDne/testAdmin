<?php

namespace Test\ContactRequest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ContactRequestModel
 */
class ContactRequestModel extends AbstractDb
{
    /**
     * Initialize resource.
     *
     * @return null
     */
    public function _construct()
    {
        $this->_init('contact_request', 'request_id');
    }
}
