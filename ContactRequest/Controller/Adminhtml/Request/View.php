<?php
namespace Test\ContactRequest\Controller\Adminhtml\Request;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Test\ContactRequest\Api\ContactRequestRepositoryInterface;
use Test\ContactRequest\Api\Data\ContactRequestInterface;
use Test\ContactRequest\Model\Source\Status;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\DataObjectFactory;
use Test\ContactRequest\Service\SendEmailService;

class View extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ContactRequestRepositoryInterface
     */
    protected $contactRequestRepository;

    /**
     * @var DataObjectFactory
     */
    protected $dataObjectFactory;

    /**
     * @var SendEmailService
     */
    protected $sendEmailService;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ContactRequestRepositoryInterface $contactRequestRepository
     * @param DataObjectFactory $dataObjectFactory
     * @param SendEmailService $sendEmailService
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ContactRequestRepositoryInterface $contactRequestRepository,
        DataObjectFactory $dataObjectFactory,
        SendEmailService $sendEmailService,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->contactRequestRepository = $contactRequestRepository;
        $this->dataObjectFactory = $dataObjectFactory;
        $this->sendEmailService = $sendEmailService;
        $this->logger = $logger;
    }

    /**
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        /** @var Http $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $requestId = $request->getPostValue(ContactRequestInterface::REQUEST_ID);
            $response = $request->getPostValue(ContactRequestInterface::RESPONSE);
            $contactRequest = $this->contactRequestRepository->getById($requestId);
            $contactRequest->setResponse($response);
            $contactRequest->setStatus(Status::STATUS_COMPLETED);
            $this->contactRequestRepository->save($contactRequest);

            $templateParams = [
                'request' => $contactRequest->getRequest(),
                'response' => $contactRequest->getResponse(),
            ];

            $dataObject = $this->dataObjectFactory->create(
                [
                    'data' => $templateParams,
                ]
            );

            try {
                $this->sendEmailService->execute(
                    $dataObject,
                    $contactRequest->getEmail()
                );
                $this->messageManager->addSuccessMessage(__('Contact response sent'));
            } catch (\Exception $e) {
                $this->logger->error('Send contact response error:' . $e->getMessage());
                $this->messageManager->addErrorMessage(__('Send contact response error'));
            }

            /** @var Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath('contactrequest/*/');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Contact Request')));

        return $resultPage;
    }
}