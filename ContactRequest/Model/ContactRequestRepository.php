<?php

namespace Test\ContactRequest\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Test\ContactRequest\Api\ContactRequestRepositoryInterface;
use Test\ContactRequest\Api\Data\ContactRequestInterface;
use Test\ContactRequest\Model\ResourceModel\ContactRequestModel;

/**
 * Class ContactRequestRepository
 * @package Test\ContactRequest\Model
 */
class ContactRequestRepository implements ContactRequestRepositoryInterface
{
    /**
     * @var ContactRequestModel
     */
    protected $resourceModel;

    /**
     * @var ContactRequestFactory
     */
    protected $contactRequestFactory;

    /**
     * ContactRequestRepository constructor.
     *
     * @param ContactRequestModel $resourceModel
     * @param ContactRequestFactory $contactRequestFactory
     */
    public function __construct(
        ContactRequestModel $resourceModel,
        ContactRequestFactory $contactRequestFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->contactRequestFactory = $contactRequestFactory;
    }

    /**
     * @param ContactRequestInterface $contactRequest
     *
     * @throws AlreadyExistsException
     */
    public function save(ContactRequestInterface $contactRequest)
    {
        $this->resourceModel->save($contactRequest);
    }

    /**
     * @param int $contactRequestId
     *
     * @return ContactRequestInterface
     */
    public function getById($contactRequestId)
    {
        /** @var ContactRequest $model */
        $model = $this->contactRequestFactory->create();
        $model->load($contactRequestId);

        return $model;
    }

    /**
     * @param int $contactRequestId
     *
     * @throws \Exception
     */
    public function deleteById($contactRequestId)
    {
        $model = $this->getById($contactRequestId);
        $this->resourceModel->delete($model);

    }
}