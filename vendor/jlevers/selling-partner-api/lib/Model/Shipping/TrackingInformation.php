<?php
/**
 * TrackingInformation
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
 * TrackingInformation Class Doc Comment
 *
 * @category Class
 * @description The payload schema for the getTrackingInformation operation.
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class TrackingInformation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TrackingInformation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tracking_id' => 'string',
        'summary' => '\SellingPartnerApi\Model\Shipping\TrackingSummary',
        'promised_delivery_date' => 'string',
        'event_history' => '\SellingPartnerApi\Model\Shipping\Event[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'tracking_id' => null,
        'summary' => null,
        'promised_delivery_date' => null,
        'event_history' => null
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
        'tracking_id' => 'trackingId',
        'summary' => 'summary',
        'promised_delivery_date' => 'promisedDeliveryDate',
        'event_history' => 'eventHistory'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'tracking_id' => 'setTrackingId',
        'summary' => 'setSummary',
        'promised_delivery_date' => 'setPromisedDeliveryDate',
        'event_history' => 'setEventHistory'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tracking_id' => 'getTrackingId',
        'summary' => 'getSummary',
        'promised_delivery_date' => 'getPromisedDeliveryDate',
        'event_history' => 'getEventHistory'
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
        $this->container['tracking_id'] = $data['tracking_id'] ?? null;
        $this->container['summary'] = $data['summary'] ?? null;
        $this->container['promised_delivery_date'] = $data['promised_delivery_date'] ?? null;
        $this->container['event_history'] = $data['event_history'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['tracking_id'] === null) {
            $invalidProperties[] = "'tracking_id' can't be null";
        }
        if ((mb_strlen($this->container['tracking_id']) > 60)) {
            $invalidProperties[] = "invalid value for 'tracking_id', the character length must be smaller than or equal to 60.";
        }

        if ((mb_strlen($this->container['tracking_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'tracking_id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['summary'] === null) {
            $invalidProperties[] = "'summary' can't be null";
        }
        if ($this->container['promised_delivery_date'] === null) {
            $invalidProperties[] = "'promised_delivery_date' can't be null";
        }
        if ($this->container['event_history'] === null) {
            $invalidProperties[] = "'event_history' can't be null";
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
     * Gets tracking_id
     *
     * @return string
     */
    public function getTrackingId()
    {
        return $this->container['tracking_id'];
    }

    /**
     * Sets tracking_id
     *
     * @param string $tracking_id The tracking id generated to each shipment. It contains a series of letters or digits or both.
     *
     * @return self
     */
    public function setTrackingId($tracking_id)
    {
        if ((mb_strlen($tracking_id) > 60)) {
            throw new \InvalidArgumentException('invalid length for $tracking_id when calling TrackingInformation., must be smaller than or equal to 60.');
        }
        if ((mb_strlen($tracking_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $tracking_id when calling TrackingInformation., must be bigger than or equal to 1.');
        }

        $this->container['tracking_id'] = $tracking_id;

        return $this;
    }
    /**
     * Gets summary
     *
     * @return \SellingPartnerApi\Model\Shipping\TrackingSummary
     */
    public function getSummary()
    {
        return $this->container['summary'];
    }

    /**
     * Sets summary
     *
     * @param \SellingPartnerApi\Model\Shipping\TrackingSummary $summary summary
     *
     * @return self
     */
    public function setSummary($summary)
    {
        $this->container['summary'] = $summary;

        return $this;
    }
    /**
     * Gets promised_delivery_date
     *
     * @return string
     */
    public function getPromisedDeliveryDate()
    {
        return $this->container['promised_delivery_date'];
    }

    /**
     * Sets promised_delivery_date
     *
     * @param string $promised_delivery_date The promised delivery date and time of a shipment in ISO 8601 format.
     *
     * @return self
     */
    public function setPromisedDeliveryDate($promised_delivery_date)
    {
        $this->container['promised_delivery_date'] = $promised_delivery_date;

        return $this;
    }
    /**
     * Gets event_history
     *
     * @return \SellingPartnerApi\Model\Shipping\Event[]
     */
    public function getEventHistory()
    {
        return $this->container['event_history'];
    }

    /**
     * Sets event_history
     *
     * @param \SellingPartnerApi\Model\Shipping\Event[] $event_history A list of events of a shipment.
     *
     * @return self
     */
    public function setEventHistory($event_history)
    {
        $this->container['event_history'] = $event_history;

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


