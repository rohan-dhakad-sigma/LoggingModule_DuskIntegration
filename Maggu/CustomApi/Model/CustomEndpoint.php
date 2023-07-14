<?php

namespace Maggu\CustomApi\Model;

use Maggu\CustomApi\Api\CustomEndpointInterface;
use Magento\Framework\Webapi\Rest\Request as RestRequest;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;

class CustomEndpoint implements CustomEndpointInterface
{
    /**
     * @var RestRequest
     */
    private $restRequest;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var EventManager
     */
    private $_eventManager;

    
    public function __construct(
        RestRequest $restRequest,
        JsonFactory $jsonFactory,
        EventManager $eventManager
    ) {
        $this->restRequest = $restRequest;
        $this->jsonFactory = $jsonFactory;
        $this->_eventManager = $eventManager;
    }

    /**
     * @inheritDoc
     */
    public function execute($payload)
    {
        // Retrieve the payload data using getBodyParams() method
        $payloadData = $this->restRequest->getBodyParams();
        $emptyArray = []; 

        // Process the payload data and retrieve values into variables
        $emptyArray['event_name'] = $payloadData['payload']['event_name'];
        $emptyArray['request_url'] = $payloadData['payload']['request_url'];
        $emptyArray['request_body'] = $payloadData['payload']['request_body'];
        $emptyArray['response_body'] = $payloadData['payload']['response_body'];
        $emptyArray['status_code'] = $payloadData['payload']['status_code'];

        // Perform necessary actions using the retrieved variables

        // Prepare the JSON response
        $response = $this->jsonFactory->create();
        $response->setData($emptyArray);

        return $emptyArray;
    }
}
