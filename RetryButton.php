<?php

namespace Sigma\DuskWebApisLog\Block\Adminhtml\Edit\Form;

use \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use \Sigma\DuskWebApisLog\Model\DuskApiLogsFactory;
use \Magento\Framework\App\Action\Context;

class RetryButton
{
    private $_duskApiLogFactory;

    public function __construct(
        Context $context,
        DuskApiLogsFactory $duskApiLogFactory,
        array $data = array()
    ) {
        $this->_duskApiLogFactory = $duskApiLogFactory;
        parent::__construct($context, $data);
      }


    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return $this->_duskApiLogFactory->create()->getCollection();
    }       
}
