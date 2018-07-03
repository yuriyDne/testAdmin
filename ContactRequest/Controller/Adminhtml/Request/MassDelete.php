<?php
namespace Test\ContactRequest\Controller\Adminhtml\Request;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class MassDelete
  */
class MassDelete extends MassAction
{
    /**
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        foreach ($this->getRequestIds() as $requestId) {
            $this->contactRequestRepository->deleteById($requestId);
        }

        return $this->redirectReferrer();
    }
}
