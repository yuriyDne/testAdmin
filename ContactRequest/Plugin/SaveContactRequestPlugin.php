<?php

namespace Test\ContactRequest\Plugin;

use Magento\Contact\Model\MailInterface;
use Magento\Framework\DataObject;
use Test\ContactRequest\Api\ContactRequestRepositoryInterface;
use Test\ContactRequest\Model\ContactRequest;
use Test\ContactRequest\Model\ContactRequestFactory;

/**
 * Class SaveContactRequestPlugin
 */
class SaveContactRequestPlugin
{
    /**
     * @var ContactRequestRepositoryInterface
     */
    protected $contactRequestRepository;

    /**
     * @var ContactRequestFactory
     */
    protected $contactRequestFactory;

    /**
     * SaveContactRequestPlugin constructor.
     *
     * @param ContactRequestRepositoryInterface $contactRequestRepository
     * @param ContactRequestFactory $contactRequestFactory
     */
    public function __construct(
        ContactRequestRepositoryInterface $contactRequestRepository,
        ContactRequestFactory $contactRequestFactory
    ) {

        $this->contactRequestRepository = $contactRequestRepository;
        $this->contactRequestFactory = $contactRequestFactory;
    }

    /**
     * @param MailInterface $subject
     * @param string $replyTo
     * @param array $variables
     */
    public function beforeSend(MailInterface $subject, $replyTo, array $variables)
    {
        /** @var DataObject $dataObject */
        $dataObject = $variables['data'];
        /** @var ContactRequest $contactRequest */
        $contactRequest = $this->contactRequestFactory->create();
        $contactRequest->setName($dataObject->getData('name'));
        $contactRequest->setEmail($dataObject->getData('email'));
        $contactRequest->setPhone($dataObject->getData('telephone'));
        $contactRequest->setRequest($dataObject->getData('comment'));

        $this->contactRequestRepository->save($contactRequest);
    }
}