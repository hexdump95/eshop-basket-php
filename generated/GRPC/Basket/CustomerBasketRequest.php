<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/basket.proto

namespace GRPC\Basket;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>BasketApi.CustomerBasketRequest</code>
 */
class CustomerBasketRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string buyerid = 1;</code>
     */
    protected $buyerid = '';
    /**
     * Generated from protobuf field <code>repeated .BasketApi.BasketItemResponse items = 2;</code>
     */
    private $items;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $buyerid
     *     @type \GRPC\Basket\BasketItemResponse[]|\Google\Protobuf\Internal\RepeatedField $items
     * }
     */
    public function __construct($data = NULL) {
        \GRPC\GPBMetadata\Basket::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string buyerid = 1;</code>
     * @return string
     */
    public function getBuyerid()
    {
        return $this->buyerid;
    }

    /**
     * Generated from protobuf field <code>string buyerid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setBuyerid($var)
    {
        GPBUtil::checkString($var, True);
        $this->buyerid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .BasketApi.BasketItemResponse items = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Generated from protobuf field <code>repeated .BasketApi.BasketItemResponse items = 2;</code>
     * @param \GRPC\Basket\BasketItemResponse[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setItems($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \GRPC\Basket\BasketItemResponse::class);
        $this->items = $arr;

        return $this;
    }

}

