<?php

namespace Maggu\CustomApi\Api;

interface CustomEndpointInterface
{
    /**
     * Custom endpoint execution
     *
     * @param mixed $payload
     * @return array
     */
    public function execute($payload);
}
