<?php

namespace Test\ContactRequest\Api;

use Test\ContactRequest\Api\Data\ContactRequestInterface;

/**
 * ContactRequestRepositoryInterface
 */
interface ContactRequestRepositoryInterface
{
    /**
     * @param ContactRequestInterface $contactRequest
     */
    public function save(ContactRequestInterface $contactRequest);

    /**
     * @param int $contactRequestId
     *
     * @return ContactRequestInterface
     */
    public function getById($contactRequestId);

    /**
     * @param int $contactRequestId
     */
    public function deleteById($contactRequestId);
}
