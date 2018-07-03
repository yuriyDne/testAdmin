<?php

namespace Test\ContactRequest\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Mail\Template\SenderResolverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Api\StoreResolverInterface;

/**
 * Class SendEmailService
 */
class SendEmailService
{
    const SENDER_EMAIL_XPATH = 'test_contact_request/general/sender_identity';
    const TEMPLATE_ID_XPATH = 'test_contact_request/general/template';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var SenderResolverInterface
     */
    protected $senderResolver;

    /**
     * @var StoreResolverInterface
     */
    protected $storeResolver;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * SendEmailService constructor.
     *
     * @param ScopeConfigInterface    $scopeConfig
     * @param SenderResolverInterface $senderResolver
     * @param StoreResolverInterface  $storeResolver
     * @param TransportBuilder        $transportBuilder
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        SenderResolverInterface $senderResolver,
        StoreResolverInterface $storeResolver,
        TransportBuilder $transportBuilder
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->senderResolver = $senderResolver;
        $this->storeResolver = $storeResolver;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * @param DataObject $templateParams
     * @param string $to
     *
     * @throws \Magento\Framework\Exception\MailException
     */
    public function execute(DataObject $templateParams, $to)
    {
        $templateId = $this->scopeConfig->getValue(self::TEMPLATE_ID_XPATH);
        $from = $this->senderResolver->resolve(
            $this->scopeConfig->getValue(self::SENDER_EMAIL_XPATH)
        );

        $this->transportBuilder->setTemplateIdentifier($templateId);
        $this->transportBuilder->setTemplateOptions(['area' => 'adminhtml', 'store' => 0]);
        $this->transportBuilder->setTemplateVars($templateParams->getData());
        $this->transportBuilder->setFrom($from);
        $this->transportBuilder->addTo($to);
        $transport = $this->transportBuilder->getTransport();

        $transport->sendMessage();
    }
}