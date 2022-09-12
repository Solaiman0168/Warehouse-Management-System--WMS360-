<?php
/**
 * InvoiceDetail
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Direct Fulfillment Payments
 *
 * The Selling Partner API for Direct Fulfillment Payments provides programmatic access to a direct fulfillment vendor's invoice data.
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

namespace SellingPartnerApi\Model\VendorDirectFulfillmentPayments;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * InvoiceDetail Class Doc Comment
 *
 * @category Class
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class InvoiceDetail implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceDetail';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'invoice_number' => 'string',
        'invoice_date' => 'string',
        'reference_number' => 'string',
        'remit_to_party' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification',
        'ship_from_party' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification',
        'bill_to_party' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification',
        'ship_to_country_code' => 'string',
        'payment_terms_code' => 'string',
        'invoice_total' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\Money',
        'tax_totals' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\TaxDetail[]',
        'additional_details' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\AdditionalDetails[]',
        'charge_details' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\ChargeDetails[]',
        'items' => '\SellingPartnerApi\Model\VendorDirectFulfillmentPayments\InvoiceItem[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'invoice_number' => null,
        'invoice_date' => null,
        'reference_number' => null,
        'remit_to_party' => null,
        'ship_from_party' => null,
        'bill_to_party' => null,
        'ship_to_country_code' => null,
        'payment_terms_code' => null,
        'invoice_total' => null,
        'tax_totals' => null,
        'additional_details' => null,
        'charge_details' => null,
        'items' => null
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
        'invoice_number' => 'invoiceNumber',
        'invoice_date' => 'invoiceDate',
        'reference_number' => 'referenceNumber',
        'remit_to_party' => 'remitToParty',
        'ship_from_party' => 'shipFromParty',
        'bill_to_party' => 'billToParty',
        'ship_to_country_code' => 'shipToCountryCode',
        'payment_terms_code' => 'paymentTermsCode',
        'invoice_total' => 'invoiceTotal',
        'tax_totals' => 'taxTotals',
        'additional_details' => 'additionalDetails',
        'charge_details' => 'chargeDetails',
        'items' => 'items'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'invoice_number' => 'setInvoiceNumber',
        'invoice_date' => 'setInvoiceDate',
        'reference_number' => 'setReferenceNumber',
        'remit_to_party' => 'setRemitToParty',
        'ship_from_party' => 'setShipFromParty',
        'bill_to_party' => 'setBillToParty',
        'ship_to_country_code' => 'setShipToCountryCode',
        'payment_terms_code' => 'setPaymentTermsCode',
        'invoice_total' => 'setInvoiceTotal',
        'tax_totals' => 'setTaxTotals',
        'additional_details' => 'setAdditionalDetails',
        'charge_details' => 'setChargeDetails',
        'items' => 'setItems'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'invoice_number' => 'getInvoiceNumber',
        'invoice_date' => 'getInvoiceDate',
        'reference_number' => 'getReferenceNumber',
        'remit_to_party' => 'getRemitToParty',
        'ship_from_party' => 'getShipFromParty',
        'bill_to_party' => 'getBillToParty',
        'ship_to_country_code' => 'getShipToCountryCode',
        'payment_terms_code' => 'getPaymentTermsCode',
        'invoice_total' => 'getInvoiceTotal',
        'tax_totals' => 'getTaxTotals',
        'additional_details' => 'getAdditionalDetails',
        'charge_details' => 'getChargeDetails',
        'items' => 'getItems'
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
        $this->container['invoice_number'] = $data['invoice_number'] ?? null;
        $this->container['invoice_date'] = $data['invoice_date'] ?? null;
        $this->container['reference_number'] = $data['reference_number'] ?? null;
        $this->container['remit_to_party'] = $data['remit_to_party'] ?? null;
        $this->container['ship_from_party'] = $data['ship_from_party'] ?? null;
        $this->container['bill_to_party'] = $data['bill_to_party'] ?? null;
        $this->container['ship_to_country_code'] = $data['ship_to_country_code'] ?? null;
        $this->container['payment_terms_code'] = $data['payment_terms_code'] ?? null;
        $this->container['invoice_total'] = $data['invoice_total'] ?? null;
        $this->container['tax_totals'] = $data['tax_totals'] ?? null;
        $this->container['additional_details'] = $data['additional_details'] ?? null;
        $this->container['charge_details'] = $data['charge_details'] ?? null;
        $this->container['items'] = $data['items'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['invoice_number'] === null) {
            $invalidProperties[] = "'invoice_number' can't be null";
        }
        if ($this->container['invoice_date'] === null) {
            $invalidProperties[] = "'invoice_date' can't be null";
        }
        if ($this->container['remit_to_party'] === null) {
            $invalidProperties[] = "'remit_to_party' can't be null";
        }
        if ($this->container['ship_from_party'] === null) {
            $invalidProperties[] = "'ship_from_party' can't be null";
        }
        if ($this->container['invoice_total'] === null) {
            $invalidProperties[] = "'invoice_total' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
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
     * Gets invoice_number
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string $invoice_number The unique invoice number.
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }
    /**
     * Gets invoice_date
     *
     * @return string
     */
    public function getInvoiceDate()
    {
        return $this->container['invoice_date'];
    }

    /**
     * Sets invoice_date
     *
     * @param string $invoice_date Invoice date. Must be in ISO 8601 format.
     *
     * @return self
     */
    public function setInvoiceDate($invoice_date)
    {
        $this->container['invoice_date'] = $invoice_date;

        return $this;
    }
    /**
     * Gets reference_number
     *
     * @return string|null
     */
    public function getReferenceNumber()
    {
        return $this->container['reference_number'];
    }

    /**
     * Sets reference_number
     *
     * @param string|null $reference_number An additional unique reference number used for regulatory or other purposes.
     *
     * @return self
     */
    public function setReferenceNumber($reference_number)
    {
        $this->container['reference_number'] = $reference_number;

        return $this;
    }
    /**
     * Gets remit_to_party
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification
     */
    public function getRemitToParty()
    {
        return $this->container['remit_to_party'];
    }

    /**
     * Sets remit_to_party
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification $remit_to_party remit_to_party
     *
     * @return self
     */
    public function setRemitToParty($remit_to_party)
    {
        $this->container['remit_to_party'] = $remit_to_party;

        return $this;
    }
    /**
     * Gets ship_from_party
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification
     */
    public function getShipFromParty()
    {
        return $this->container['ship_from_party'];
    }

    /**
     * Sets ship_from_party
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification $ship_from_party ship_from_party
     *
     * @return self
     */
    public function setShipFromParty($ship_from_party)
    {
        $this->container['ship_from_party'] = $ship_from_party;

        return $this;
    }
    /**
     * Gets bill_to_party
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification|null
     */
    public function getBillToParty()
    {
        return $this->container['bill_to_party'];
    }

    /**
     * Sets bill_to_party
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\PartyIdentification|null $bill_to_party bill_to_party
     *
     * @return self
     */
    public function setBillToParty($bill_to_party)
    {
        $this->container['bill_to_party'] = $bill_to_party;

        return $this;
    }
    /**
     * Gets ship_to_country_code
     *
     * @return string|null
     */
    public function getShipToCountryCode()
    {
        return $this->container['ship_to_country_code'];
    }

    /**
     * Sets ship_to_country_code
     *
     * @param string|null $ship_to_country_code Ship-to country code.
     *
     * @return self
     */
    public function setShipToCountryCode($ship_to_country_code)
    {
        $this->container['ship_to_country_code'] = $ship_to_country_code;

        return $this;
    }
    /**
     * Gets payment_terms_code
     *
     * @return string|null
     */
    public function getPaymentTermsCode()
    {
        return $this->container['payment_terms_code'];
    }

    /**
     * Sets payment_terms_code
     *
     * @param string|null $payment_terms_code The payment terms for the invoice.
     *
     * @return self
     */
    public function setPaymentTermsCode($payment_terms_code)
    {
        $this->container['payment_terms_code'] = $payment_terms_code;

        return $this;
    }
    /**
     * Gets invoice_total
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\Money
     */
    public function getInvoiceTotal()
    {
        return $this->container['invoice_total'];
    }

    /**
     * Sets invoice_total
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\Money $invoice_total invoice_total
     *
     * @return self
     */
    public function setInvoiceTotal($invoice_total)
    {
        $this->container['invoice_total'] = $invoice_total;

        return $this;
    }
    /**
     * Gets tax_totals
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\TaxDetail[]|null
     */
    public function getTaxTotals()
    {
        return $this->container['tax_totals'];
    }

    /**
     * Sets tax_totals
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\TaxDetail[]|null $tax_totals Individual tax details per line item.
     *
     * @return self
     */
    public function setTaxTotals($tax_totals)
    {
        $this->container['tax_totals'] = $tax_totals;

        return $this;
    }
    /**
     * Gets additional_details
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\AdditionalDetails[]|null
     */
    public function getAdditionalDetails()
    {
        return $this->container['additional_details'];
    }

    /**
     * Sets additional_details
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\AdditionalDetails[]|null $additional_details Additional details provided by the selling party, for tax related or other purposes.
     *
     * @return self
     */
    public function setAdditionalDetails($additional_details)
    {
        $this->container['additional_details'] = $additional_details;

        return $this;
    }
    /**
     * Gets charge_details
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\ChargeDetails[]|null
     */
    public function getChargeDetails()
    {
        return $this->container['charge_details'];
    }

    /**
     * Sets charge_details
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\ChargeDetails[]|null $charge_details Total charge amount details for all line items.
     *
     * @return self
     */
    public function setChargeDetails($charge_details)
    {
        $this->container['charge_details'] = $charge_details;

        return $this;
    }
    /**
     * Gets items
     *
     * @return \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\InvoiceItem[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \SellingPartnerApi\Model\VendorDirectFulfillmentPayments\InvoiceItem[] $items Provides the details of the items in this invoice.
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

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


