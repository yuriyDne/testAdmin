<?php

namespace Test\ContactRequest\Api\Data;

use Test\ContactRequest\Model\ContactRequest;

/**
 * Class ContactRequest
 */
interface ContactRequestInterface
{
    const REQUEST_ID = 'request_id';
    const STATUS = 'status';
    const NAME = 'name';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const REQUEST = 'request';
    const RESPONSE = 'response';

    /**
     * @return int
     */
    public function getRequestId();

    /**
     * @param int $requestId
     *
     * @return ContactRequest
     */
    public function setRequestId($requestId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return ContactRequest
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     *
     * @return ContactRequest
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     *
     * @return ContactRequest
     */
    public function setPhone($phone);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int $status
     *
     * @return ContactRequest
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @param string $request
     *
     * @return ContactRequest
     */
    public function setRequest($request);

    /**
     * @return string
     */
    public function getResponse();

    /**
     * @param string $response
     *
     * @return ContactRequest
     */
    public function setResponse($response);
}