<?php
declare(strict_types=1);

namespace Mode\Gqmode\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\Event\ManagerInterface as EventManager;


/**
 * Order sales field resolver, used for GraphQL request processing
 */
class AddLogsResolver implements ResolverInterface
{
    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * AddLogsResolver constructor.
     *
     * @param Filesystem $fileSystem
     * @param File $fileDriver
     * @param EventManager $eventManager
     */
    public function __construct(
        EventManager $eventManager
    ) {
        $this->_eventManager = $eventManager;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        $response = [
            'success' => true,
            'api_endpoint' => $args['api_endpoint'],
            'request_body' => $args['request_body'],
            'response_body'=> $args['response_body'],
            'status_code' =>  $args['status_code']
        ];
        $result = [];
        if($response) {
            $result['status_code'] = 200;
            $result['success_message'] = "Logs added successfully";
        }


        $this->_eventManager->dispatch('dusklog_event',
            [
                'record' => $response
            ]
        );
        return $result;
    }
}