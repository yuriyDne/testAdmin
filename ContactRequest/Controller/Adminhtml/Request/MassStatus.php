<?php

namespace Test\ContactRequest\Controller\Adminhtml\Request;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class MassStatus
 */
class MassStatus extends MassAction
{
    /**
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        $status = (int) $this->getRequest()->getParam('status');

        foreach ($this->getRequestIds() as $requestId) {
            $model = $this->contactRequestRepository->getById($requestId);
            $model->setStatus($status);
            $this->contactRequestRepository->save($model);
        }

        return $this->redirectReferrer();
    }
}
