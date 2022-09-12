<?php
/**
 * OrderItem
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Direct Fulfillment Orders
 *
 * The Selling Partner API for Direct Fulfillment Orders provides programmatic access to a direct fulfillment vendor's order data.
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

namespace SellingPartnerApi\Model\VendorDirectFulfillmentOrders;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * OrderItem Class Doc Comment
 *
 * @category Class
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class OrderItem implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'OrderItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'item_sequence_number' => 'string',
        'buyer_product_identifier' => 'string',
        'vendor_product_identifier' => 'string',
        'title' => 'string',
        'ordered_quantity' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ItemQuantity',
        'scheduled_delivery_shipment' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ScheduledDeliveryShipment',
        'gift_details' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\GiftDetails',
        'net_price' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money',
        'tax_details' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\OrderItemTaxDetails',
        'total_price' => '\SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'item_sequence_number' => null,
        'buyer_product_identifier' => null,
        'vendor_product_identifier' => null,
        'title' => null,
        'ordered_quantity' => null,
        'scheduled_delivery_shipment' => null,
        'gift_details' => null,
        'net_price' => null,
        'tax_details' => null,
        'total_price' => null
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
        'item_sequence_number' => 'itemSequenceNumber',
        'buyer_product_identifier' => 'buyerProductIdentifier',
        'vendor_product_identifier' => 'vendorProductIdentifier',
        'title' => 'title',
        'ordered_quantity' => 'orderedQuantity',
        'scheduled_delivery_shipment' => 'scheduledDeliveryShipment',
        'gift_details' => 'giftDetails',
        'net_price' => 'netPrice',
        'tax_details' => 'taxDetails',
        'total_price' => 'totalPrice'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'item_sequence_number' => 'setItemSequenceNumber',
        'buyer_product_identifier' => 'setBuyerProductIdentifier',
        'vendor_product_identifier' => 'setVendorProductIdentifier',
        'title' => 'setTitle',
        'ordered_quantity' => 'setOrderedQuantity',
        'scheduled_delivery_shipment' => 'setScheduledDeliveryShipment',
        'gift_details' => 'setGiftDetails',
        'net_price' => 'setNetPrice',
        'tax_details' => 'setTaxDetails',
        'total_price' => 'setTotalPrice'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'item_sequence_number' => 'getItemSequenceNumber',
        'buyer_product_identifier' => 'getBuyerProductIdentifier',
        'vendor_product_identifier' => 'getVendorProductIdentifier',
        'title' => 'getTitle',
        'ordered_quantity' => 'getOrderedQuantity',
        'scheduled_delivery_shipment' => 'getScheduledDeliveryShipment',
        'gift_details' => 'getGiftDetails',
        'net_price' => 'getNetPrice',
        'tax_details' => 'getTaxDetails',
        'total_price' => 'getTotalPrice'
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
        $this->container['item_sequence_number'] = $data['item_sequence_number'] ?? null;
        $this->container['buyer_product_identifier'] = $data['buyer_product_identifier'] ?? null;
        $this->container['vendor_product_identifier'] = $data['vendor_product_identifier'] ?? null;
        $this->container['title'] = $data['title'] ?? null;
        $this->container['ordered_quantity'] = $data['ordered_quantity'] ?? null;
        $this->container['scheduled_delivery_shipment'] = $data['scheduled_delivery_shipment'] ?? null;
        $this->container['gift_details'] = $data['gift_details'] ?? null;
        $this->container['net_price'] = $data['net_price'] ?? null;
        $this->container['tax_details'] = $data['tax_details'] ?? null;
        $this->container['total_price'] = $data['total_price'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['item_sequence_number'] === null) {
            $invalidProperties[] = "'item_sequence_number' can't be null";
        }
        if ($this->container['ordered_quantity'] === null) {
            $invalidProperties[] = "'ordered_quantity' can't be null";
        }
        if ($this->container['net_price'] === null) {
            $invalidProperties[] = "'net_price' can't be null";
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
     * Gets item_sequence_number
     *
     * @return string
     */
    public function getItemSequenceNumber()
    {
        return $this->container['item_sequence_number'];
    }

    /**
     * Sets item_sequence_number
     *
     * @param string $item_sequence_number Numbering of the item on the purchase order. The first item will be 1, the second 2, and so on.
     *
     * @return self
     */
    public function setItemSequenceNumber($item_sequence_number)
    {
        $this->container['item_sequence_number'] = $item_sequence_number;

        return $this;
    }
    /**
     * Gets buyer_product_identifier
     *
     * @return string|null
     */
    public function getBuyerProductIdentifier()
    {
        return $this->container['buyer_product_identifier'];
    }

    /**
     * Sets buyer_product_identifier
     *
     * @param string|null $buyer_product_identifier Buyer's standard identification number (ASIN) of an item.
     *
     * @return self
     */
    public function setBuyerProductIdentifier($buyer_product_identifier)
    {
        $this->container['buyer_product_identifier'] = $buyer_product_identifier;

        return $this;
    }
    /**
     * Gets vendor_product_identifier
     *
     * @return string|null
     */
    public function getVendorProductIdentifier()
    {
        return $this->container['vendor_product_identifier'];
    }

    /**
     * Sets vendor_product_identifier
     *
     * @param string|null $vendor_product_identifier The vendor selected product identification of the item.
     *
     * @return self
     */
    public function setVendorProductIdentifier($vendor_product_identifier)
    {
        $this->container['vendor_product_identifier'] = $vendor_product_identifier;

        return $this;
    }
    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title Title for the item.
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }
    /**
     * Gets ordered_quantity
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ItemQuantity
     */
    public function getOrderedQuantity()
    {
        return $this->container['ordered_quantity'];
    }

    /**
     * Sets ordered_quantity
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ItemQuantity $ordered_quantity ordered_quantity
     *
     * @return self
     */
    public function setOrderedQuantity($ordered_quantity)
    {
        $this->container['ordered_quantity'] = $ordered_quantity;

        return $this;
    }
    /**
     * Gets scheduled_delivery_shipment
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ScheduledDeliveryShipment|null
     */
    public function getScheduledDeliveryShipment()
    {
        return $this->container['scheduled_delivery_shipment'];
    }

    /**
     * Sets scheduled_delivery_shipment
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\ScheduledDeliveryShipment|null $scheduled_delivery_shipment scheduled_delivery_shipment
     *
     * @return self
     */
    public function setScheduledDeliveryShipment($scheduled_delivery_shipment)
    {
        $this->container['scheduled_delivery_shipment'] = $scheduled_delivery_shipment;

        return $this;
    }
    /**
     * Gets gift_details
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\GiftDetails|null
     */
    public function getGiftDetails()
    {
        return $this->container['gift_details'];
    }

    /**
     * Sets gift_details
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\GiftDetails|null $gift_details gift_details
     *
     * @return self
     */
    public function setGiftDetails($gift_details)
    {
        $this->container['gift_details'] = $gift_details;

        return $this;
    }
    /**
     * Gets net_price
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money
     */
    public function getNetPrice()
    {
        return $this->container['net_price'];
    }

    /**
     * Sets net_price
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money $net_price net_price
     *
     * @return self
     */
    public function setNetPrice($net_price)
    {
        $this->container['net_price'] = $net_price;

        return $this;
    }
    /**
     * Gets tax_details
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\OrderItemTaxDetails|null
     */
    public function getTaxDetails()
    {
        return $this->container['tax_details'];
    }

    /**
     * Sets tax_details
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\OrderItemTaxDetails|null $tax_details tax_details
     *
     * @return self
     */
    public function setTaxDetails($tax_details)
    {
        $this->container['tax_details'] = $tax_details;

        return $this;
    }
    /**
     * Gets total_price
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money|null
     */
    public function getTotalPrice()
    {
        return $this->container['total_price'];
    }

    /**
     * Sets total_price
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentOrders\Money|null $total_price total_price
     *
     * @return self
     */
    public function setTotalPrice($total_price)
    {
        $this->container['total_price'] = $total_price;

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


