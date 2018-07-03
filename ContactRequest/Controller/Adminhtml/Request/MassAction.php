<?php

namespace Test\ContactRequest\Controller\Adminhtml\Request;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Test\ContactRequest\Api\ContactRequestRepositoryInterface;
use Test\ContactRequest\Model\ResourceModel\ContactRequestCollectionFactory as CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\Model\View\Result\Redirect;

/**
 * Class MassAction
 */
abstract class MassAction extends Action
{
    /**
     * MassActions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ContactRequestRepositoryInterface
     */
    protected $contactRequestRepository;

    /**
     * MassStatus constructor.
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param Filter $filter
     * @param ContactRequestRepositoryInterface $contactRequestRepository
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Filter $filter,
        ContactRequestRepositoryInterface $contactRequestRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->contactRequestRepository = $contactRequestRepository;
    }

    /**
     * @return int[]
     * @throws LocalizedException
     */
    protected function getRequestIds()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        return $collection->getAllIds();
    }

    /**
     * @return Redirect
     */
    protected function redirectReferrer()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('contactrequest/*/');
    }
}