<?php

namespace Test\ContactRequest\Model;

use Magento\Framework\Model\AbstractModel;
use Test\ContactRequest\Api\Data\ContactRequestInterface;
use Test\ContactRequest\Model\ResourceModel\ContactRequestModel;

/**
 * Class ContactRequest
 */
class ContactRequest extends AbstractModel implements ContactRequestInterface
{
    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ContactRequestModel::class);
    }

    /**
     * @return int
     */
    public function getRequestId()
    {
        return $this->getData(self::REQUEST_ID);
    }

    /**
     * @param int $requestId
     *
     * @return ContactRequest
     */
    public function setRequestId($requestId)
    {
        $this->setData(self::REQUEST_ID, $requestId);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     *
     * @return ContactRequest
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param string $email
     *
     * @return ContactRequest
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @param string $phone
     *
     * @return ContactRequest
     */
    public function setPhone($phone)
    {
        $this->setData(self::PHONE, $phone);
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param int $status
     *
     * @return ContactRequest
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->getData(self::REQUEST);
    }

    /**
     * @param string $request
     *
     * @return ContactRequest
     */
    public function setRequest($request)
    {
        $this->setData(self::REQUEST, $request);
        return $this;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->getData(self::RESPONSE);
    }

    /**
     * @param string $response
     *
     * @return ContactRequest
     */
    public function setResponse($response)
    {
        $this->setData(self::RESPONSE, $response);
        return $this;
    }


}