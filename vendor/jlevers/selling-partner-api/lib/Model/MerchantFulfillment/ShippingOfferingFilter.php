<?php
/**
 * ShippingOfferingFilter
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Merchant Fulfillment
 *
 * The Selling Partner API for Merchant Fulfillment helps you build applications that let sellers purchase shipping for non-Prime and Prime orders using Amazon's Buy Shipping Services.
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

namespace SellingPartnerApi\Model\MerchantFulfillment;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * ShippingOfferingFilter Class Doc Comment
 *
 * @category Class
 * @description Filter for use when requesting eligible shipping services.
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class ShippingOfferingFilter implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ShippingOfferingFilter';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'include_packing_slip_with_label' => 'bool',
        'include_complex_shipping_options' => 'bool',
        'carrier_will_pick_up' => '\SellingPartnerApi\Model\MerchantFulfillment\CarrierWillPickUpOption',
        'delivery_experience' => '\SellingPartnerApi\Model\MerchantFulfillment\DeliveryExperienceOption'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'include_packing_slip_with_label' => null,
        'include_complex_shipping_options' => null,
        'carrier_will_pick_up' => null,
        'delivery_experience' => null
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
        'include_packing_slip_with_label' => 'IncludePackingSlipWithLabel',
        'include_complex_shipping_options' => 'IncludeComplexShippingOptions',
        'carrier_will_pick_up' => 'CarrierWillPickUp',
        'delivery_experience' => 'DeliveryExperience'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'include_packing_slip_with_label' => 'setIncludePackingSlipWithLabel',
        'include_complex_shipping_options' => 'setIncludeComplexShippingOptions',
        'carrier_will_pick_up' => 'setCarrierWillPickUp',
        'delivery_experience' => 'setDeliveryExperience'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'include_packing_slip_with_label' => 'getIncludePackingSlipWithLabel',
        'include_complex_shipping_options' => 'getIncludeComplexShippingOptions',
        'carrier_will_pick_up' => 'getCarrierWillPickUp',
        'delivery_experience' => 'getDeliveryExperience'
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
        $this->container['include_packing_slip_with_label'] = $data['include_packing_slip_with_label'] ?? null;
        $this->container['include_complex_shipping_options'] = $data['include_complex_shipping_options'] ?? null;
        $this->container['carrier_will_pick_up'] = $data['carrier_will_pick_up'] ?? null;
        $this->container['delivery_experience'] = $data['delivery_experience'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets include_packing_slip_with_label
     *
     * @return bool|null
     */
    public function getIncludePackingSlipWithLabel()
    {
        return $this->container['include_packing_slip_with_label'];
    }

    /**
     * Sets include_packing_slip_with_label
     *
     * @param bool|null $include_packing_slip_with_label When true, include a packing slip with the label.
     *
     * @return self
     */
    public function setIncludePackingSlipWithLabel($include_packing_slip_with_label)
    {
        $this->container['include_packing_slip_with_label'] = $include_packing_slip_with_label;

        return $this;
    }
    /**
     * Gets include_complex_shipping_options
     *
     * @return bool|null
     */
    public function getIncludeComplexShippingOptions()
    {
        return $this->container['include_complex_shipping_options'];
    }

    /**
     * Sets include_complex_shipping_options
     *
     * @param bool|null $include_complex_shipping_options When true, include complex shipping options.
     *
     * @return self
     */
    public function setIncludeComplexShippingOptions($include_complex_shipping_options)
    {
        $this->container['include_complex_shipping_options'] = $include_complex_shipping_options;

        return $this;
    }
    /**
     * Gets carrier_will_pick_up
     *
     * @return \SellingPartnerApi\Model\MerchantFulfillment\CarrierWillPickUpOption|null
     */
    public function getCarrierWillPickUp()
    {
        return $this->container['carrier_will_pick_up'];
    }

    /**
     * Sets carrier_will_pick_up
     *
     * @param \SellingPartnerApi\Model\MerchantFulfillment\CarrierWillPickUpOption|null $carrier_will_pick_up carrier_will_pick_up
     *
     * @return self
     */
    public function setCarrierWillPickUp($carrier_will_pick_up)
    {
        $this->container['carrier_will_pick_up'] = $carrier_will_pick_up;

        return $this;
    }
    /**
     * Gets delivery_experience
     *
     * @return \SellingPartnerApi\Model\MerchantFulfillment\DeliveryExperienceOption|null
     */
    public function getDeliveryExperience()
    {
        return $this->container['delivery_experience'];
    }

    /**
     * Sets delivery_experience
     *
     * @param \SellingPartnerApi\Model\MerchantFulfillment\DeliveryExperienceOption|null $delivery_experience delivery_experience
     *
     * @return self
     */
    public function setDeliveryExperience($delivery_experience)
    {
        $this->container['delivery_experience'] = $delivery_experience;

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


