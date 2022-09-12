<?php
/**
 * QuantityDiscountPriceType
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Pricing
 *
 * The Selling Partner API for Pricing helps you programmatically retrieve product pricing and offer information for Amazon Marketplace products.
 *
 * The version of the OpenAPI document: v0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace SellingPartnerApi\Model\ProductPricing;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * QuantityDiscountPriceType Class Doc Comment
 *
 * @category Class
 * @description Contains pricing information that includes special pricing when buying in bulk.
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class QuantityDiscountPriceType implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'QuantityDiscountPriceType';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'quantity_tier' => 'int',
        'quantity_discount_type' => '\SellingPartnerApi\Model\ProductPricing\QuantityDiscountType',
        'listing_price' => '\SellingPartnerApi\Model\ProductPricing\MoneyType'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'quantity_tier' => 'int32',
        'quantity_discount_type' => null,
        'listing_price' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'quantity_tier' => 'quantityTier',
        'quantity_discount_type' => 'quantityDiscountType',
        'listing_price' => 'listingPrice'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'quantity_tier' => 'setQuantityTier',
        'quantity_discount_type' => 'setQuantityDiscountType',
        'listing_price' => 'setListingPrice'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'quantity_tier' => 'getQuantityTier',
        'quantity_discount_type' => 'getQuantityDiscountType',
        'listing_price' => 'getListingPrice'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }
    
    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['quantity_tier'] = $data['quantity_tier'] ?? null;
        $this->container['quantity_discount_type'] = $data['quantity_discount_type'] ?? null;
        $this->container['listing_price'] = $data['listing_price'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['quantity_tier'] === null) {
            $invalidProperties[] = "'quantity_tier' can't be null";
        }
        if ($this->container['quantity_discount_type'] === null) {
            $invalidProperties[] = "'quantity_discount_type' can't be null";
        }
        if ($this->container['listing_price'] === null) {
            $invalidProperties[] = "'listing_price' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets quantity_tier
     *
     * @return int
     */
    public function getQuantityTier()
    {
        return $this->container['quantity_tier'];
    }

    /**
     * Sets quantity_tier
     *
     * @param int $quantity_tier Indicates at what quantity this price becomes active.
     *
     * @return self
     */
    public function setQuantityTier($quantity_tier)
    {
        $this->container['quantity_tier'] = $quantity_tier;

        return $this;
    }
    /**
     * Gets quantity_discount_type
     *
     * @return \SellingPartnerApi\Model\ProductPricing\QuantityDiscountType
     */
    public function getQuantityDiscountType()
    {
        return $this->container['quantity_discount_type'];
    }

    /**
     * Sets quantity_discount_type
     *
     * @param \SellingPartnerApi\Model\ProductPricing\QuantityDiscountType $quantity_discount_type quantity_discount_type
     *
     * @return self
     */
    public function setQuantityDiscountType($quantity_discount_type)
    {
        $this->container['quantity_discount_type'] = $quantity_discount_type;

        return $this;
    }
    /**
     * Gets listing_price
     *
     * @return \SellingPartnerApi\Model\ProductPricing\MoneyType
     */
    public function getListingPrice()
    {
        return $this->container['listing_price'];
    }

    /**
     * Sets listing_price
     *
     * @param \SellingPartnerApi\Model\ProductPricing\MoneyType $listing_price listing_price
     *
     * @return self
     */
    public function setListingPrice($listing_price)
    {
        $this->container['listing_price'] = $listing_price;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


