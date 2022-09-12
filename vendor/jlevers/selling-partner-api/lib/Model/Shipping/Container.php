<?php
/**
 * Container
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Shipping
 *
 * Provides programmatic access to Amazon Shipping APIs.
 *
 * The version of the OpenAPI document: v1
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace SellingPartnerApi\Model\Shipping;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * Container Class Doc Comment
 *
 * @category Class
 * @description Container in the shipment.
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class Container implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Container';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'container_type' => 'string',
        'container_reference_id' => 'string',
        'value' => '\SellingPartnerApi\Model\Shipping\Currency',
        'dimensions' => '\SellingPartnerApi\Model\Shipping\Dimensions',
        'items' => '\SellingPartnerApi\Model\Shipping\ContainerItem[]',
        'weight' => '\SellingPartnerApi\Model\Shipping\Weight'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'container_type' => null,
        'container_reference_id' => null,
        'value' => null,
        'dimensions' => null,
        'items' => null,
        'weight' => null
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
        'container_type' => 'containerType',
        'container_reference_id' => 'containerReferenceId',
        'value' => 'value',
        'dimensions' => 'dimensions',
        'items' => 'items',
        'weight' => 'weight'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'container_type' => 'setContainerType',
        'container_reference_id' => 'setContainerReferenceId',
        'value' => 'setValue',
        'dimensions' => 'setDimensions',
        'items' => 'setItems',
        'weight' => 'setWeight'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'container_type' => 'getContainerType',
        'container_reference_id' => 'getContainerReferenceId',
        'value' => 'getValue',
        'dimensions' => 'getDimensions',
        'items' => 'getItems',
        'weight' => 'getWeight'
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
    }const CONTAINER_TYPE_PACKAGE = 'PACKAGE';
    
    

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getContainerTypeAllowableValues()
    {
        return [
            self::CONTAINER_TYPE_PACKAGE,
        ];
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
        $this->container['container_type'] = $data['container_type'] ?? null;
        $this->container['container_reference_id'] = $data['container_reference_id'] ?? null;
        $this->container['value'] = $data['value'] ?? null;
        $this->container['dimensions'] = $data['dimensions'] ?? null;
        $this->container['items'] = $data['items'] ?? null;
        $this->container['weight'] = $data['weight'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getContainerTypeAllowableValues();
        if (!is_null($this->container['container_type']) && !in_array($this->container['container_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'container_type', must be one of '%s'",
                $this->container['container_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['container_reference_id'] === null) {
            $invalidProperties[] = "'container_reference_id' can't be null";
        }
        if ((mb_strlen($this->container['container_reference_id']) > 40)) {
            $invalidProperties[] = "invalid value for 'container_reference_id', the character length must be smaller than or equal to 40.";
        }

        if ($this->container['value'] === null) {
            $invalidProperties[] = "'value' can't be null";
        }
        if ($this->container['dimensions'] === null) {
            $invalidProperties[] = "'dimensions' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
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
     * Gets container_type
     *
     * @return string|null
     */
    public function getContainerType()
    {
        return $this->container['container_type'];
    }

    /**
     * Sets container_type
     *
     * @param string|null $container_type The type of physical container being used. (always 'PACKAGE')
     *
     * @return self
     */
    public function setContainerType($container_type)
    {
        $allowedValues = $this->getContainerTypeAllowableValues();
        if (!is_null($container_type) && !in_array($container_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'container_type', must be one of '%s'",
                    $container_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['container_type'] = $container_type;

        return $this;
    }
    /**
     * Gets container_reference_id
     *
     * @return string
     */
    public function getContainerReferenceId()
    {
        return $this->container['container_reference_id'];
    }

    /**
     * Sets container_reference_id
     *
     * @param string $container_reference_id An identifier for the container. This must be unique within all the containers in the same shipment.
     *
     * @return self
     */
    public function setContainerReferenceId($container_reference_id)
    {
        if ((mb_strlen($container_reference_id) > 40)) {
            throw new \InvalidArgumentException('invalid length for $container_reference_id when calling Container., must be smaller than or equal to 40.');
        }

        $this->container['container_reference_id'] = $container_reference_id;

        return $this;
    }
    /**
     * Gets value
     *
     * @return \SellingPartnerApi\Model\Shipping\Currency
     */
    public function getValue()
    {
        return $this->container['value'];
    }

    /**
     * Sets value
     *
     * @param \SellingPartnerApi\Model\Shipping\Currency $value value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->container['value'] = $value;

        return $this;
    }
    /**
     * Gets dimensions
     *
     * @return \SellingPartnerApi\Model\Shipping\Dimensions
     */
    public function getDimensions()
    {
        return $this->container['dimensions'];
    }

    /**
     * Sets dimensions
     *
     * @param \SellingPartnerApi\Model\Shipping\Dimensions $dimensions dimensions
     *
     * @return self
     */
    public function setDimensions($dimensions)
    {
        $this->container['dimensions'] = $dimensions;

        return $this;
    }
    /**
     * Gets items
     *
     * @return \SellingPartnerApi\Model\Shipping\ContainerItem[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \SellingPartnerApi\Model\Shipping\ContainerItem[] $items A list of the items in the container.
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }
    /**
     * Gets weight
     *
     * @return \SellingPartnerApi\Model\Shipping\Weight
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param \SellingPartnerApi\Model\Shipping\Weight $weight weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        $this->container['weight'] = $weight;

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


