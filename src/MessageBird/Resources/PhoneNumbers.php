<?php

namespace MessageBird\Resources;

use MessageBird\Objects;
use MessageBird\Common;

/**
 * Class PhoneNumbers
 *
 * @package MessageBird\Resources
 */
class PhoneNumbers extends Base
{

    /**
     * @var \MessageBird\Common\HttpClient
     */
    protected $HttpClient;

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->HttpClient = $HttpClient;
        $this->setResourceName('phone-numbers');
    }

    /**
     * @param $object
     * @param $id
     *
     * @return $this ->Object
     *
     * @internal param array $parameters
     */
    public function update($object, $id)
    {
        $objVars = get_object_vars($object);
        $body = array();
        foreach ($objVars as $key => $value) {
            if (null !== $value) {
                $body[$key] = $value;
            }
        }

        $ResourceName = $this->resourceName . ($id ? '/' . $id : null);
        $body = json_encode($body);

        // This override is only needed to use the PATCH http method
        list(, , $body) = $this->HttpClient->performHttpRequest(Common\HttpClient::REQUEST_PATCH, $ResourceName, false, $body);
        return $this->processRequest($body);
    }
}
?>
