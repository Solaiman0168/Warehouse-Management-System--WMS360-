<?php
/**
 * ServiceJob
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Services
 *
 * With the Services API, you can build applications that help service providers get and modify their service orders.
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

namespace SellingPartnerApi\Model\Service;

use \ArrayAccess;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * ServiceJob Class Doc Comment
 *
 * @category Class
 * @description The job details of a service.
 * @package  SellingPartnerApi
 * @group 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null  
 */
class ServiceJob implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ServiceJob';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'create_time' => 'string',
        'service_job_id' => 'string',
        'service_job_status' => 'string',
        'scope_of_work' => '\SellingPartnerApi\Model\Service\ScopeOfWork',
        'seller' => '\SellingPartnerApi\Model\Service\Seller',
        'service_job_provider' => '\SellingPartnerApi\Model\Service\ServiceJobProvider',
        'preferred_appointment_times' => '\SellingPartnerApi\Model\Service\AppointmentTime[]',
        'appointments' => '\SellingPartnerApi\Model\Service\Appointment[]',
        'service_order_id' => 'string',
        'marketplace_id' => 'string',
        'buyer' => '\SellingPartnerApi\Model\Service\Buyer',
        'associated_items' => '\SellingPartnerApi\Model\Service\AssociatedItem[]',
        'service_location' => '\SellingPartnerApi\Model\Service\ServiceLocation'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'create_time' => null,
        'service_job_id' => null,
        'service_job_status' => null,
        'scope_of_work' => null,
        'seller' => null,
        'service_job_provider' => null,
        'preferred_appointment_times' => null,
        'appointments' => null,
        'service_order_id' => null,
        'marketplace_id' => null,
        'buyer' => null,
        'associated_items' => null,
        'service_location' => null
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
        'create_time' => 'createTime',
        'service_job_id' => 'serviceJobId',
        'service_job_status' => 'serviceJobStatus',
        'scope_of_work' => 'scopeOfWork',
        'seller' => 'seller',
        'service_job_provider' => 'serviceJobProvider',
        'preferred_appointment_times' => 'preferredAppointmentTimes',
        'appointments' => 'appointments',
        'service_order_id' => 'serviceOrderId',
        'marketplace_id' => 'marketplaceId',
        'buyer' => 'buyer',
        'associated_items' => 'associatedItems',
        'service_location' => 'serviceLocation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
                'create_time' => 'setCreateTime',
        'service_job_id' => 'setServiceJobId',
        'service_job_status' => 'setServiceJobStatus',
        'scope_of_work' => 'setScopeOfWork',
        'seller' => 'setSeller',
        'service_job_provider' => 'setServiceJobProvider',
        'preferred_appointment_times' => 'setPreferredAppointmentTimes',
        'appointments' => 'setAppointments',
        'service_order_id' => 'setServiceOrderId',
        'marketplace_id' => 'setMarketplaceId',
        'buyer' => 'setBuyer',
        'associated_items' => 'setAssociatedItems',
        'service_location' => 'setServiceLocation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'create_time' => 'getCreateTime',
        'service_job_id' => 'getServiceJobId',
        'service_job_status' => 'getServiceJobStatus',
        'scope_of_work' => 'getScopeOfWork',
        'seller' => 'getSeller',
        'service_job_provider' => 'getServiceJobProvider',
        'preferred_appointment_times' => 'getPreferredAppointmentTimes',
        'appointments' => 'getAppointments',
        'service_order_id' => 'getServiceOrderId',
        'marketplace_id' => 'getMarketplaceId',
        'buyer' => 'getBuyer',
        'associated_items' => 'getAssociatedItems',
        'service_location' => 'getServiceLocation'
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
    }const SERVICE_JOB_STATUS_NOT_SERVICED = 'NOT_SERVICED';
    const SERVICE_JOB_STATUS_CANCELLED = 'CANCELLED';
    const SERVICE_JOB_STATUS_COMPLETED = 'COMPLETED';
    const SERVICE_JOB_STATUS_PENDING_SCHEDULE = 'PENDING_SCHEDULE';
    const SERVICE_JOB_STATUS_NOT_FULFILLABLE = 'NOT_FULFILLABLE';
    const SERVICE_JOB_STATUS_HOLD = 'HOLD';
    const SERVICE_JOB_STATUS_PAYMENT_DECLINED = 'PAYMENT_DECLINED';
    
    

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getServiceJobStatusAllowableValues()
    {
        return [
            self::SERVICE_JOB_STATUS_NOT_SERVICED,
            self::SERVICE_JOB_STATUS_CANCELLED,
            self::SERVICE_JOB_STATUS_COMPLETED,
            self::SERVICE_JOB_STATUS_PENDING_SCHEDULE,
            self::SERVICE_JOB_STATUS_NOT_FULFILLABLE,
            self::SERVICE_JOB_STATUS_HOLD,
            self::SERVICE_JOB_STATUS_PAYMENT_DECLINED,
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
        $this->container['create_time'] = $data['create_time'] ?? null;
        $this->container['service_job_id'] = $data['service_job_id'] ?? null;
        $this->container['service_job_status'] = $data['service_job_status'] ?? null;
        $this->container['scope_of_work'] = $data['scope_of_work'] ?? null;
        $this->container['seller'] = $data['seller'] ?? null;
        $this->container['service_job_provider'] = $data['service_job_provider'] ?? null;
        $this->container['preferred_appointment_times'] = $data['preferred_appointment_times'] ?? null;
        $this->container['appointments'] = $data['appointments'] ?? null;
        $this->container['service_order_id'] = $data['service_order_id'] ?? null;
        $this->container['marketplace_id'] = $data['marketplace_id'] ?? null;
        $this->container['buyer'] = $data['buyer'] ?? null;
        $this->container['associated_items'] = $data['associated_items'] ?? null;
        $this->container['service_location'] = $data['service_location'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['service_job_id']) && (mb_strlen($this->container['service_job_id']) > 100)) {
            $invalidProperties[] = "invalid value for 'service_job_id', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['service_job_id']) && (mb_strlen($this->container['service_job_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'service_job_id', the character length must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getServiceJobStatusAllowableValues();
        if (!is_null($this->container['service_job_status']) && !in_array($this->container['service_job_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'service_job_status', must be one of '%s'",
                $this->container['service_job_status'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['service_order_id']) && (mb_strlen($this->container['service_order_id']) > 20)) {
            $invalidProperties[] = "invalid value for 'service_order_id', the character length must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['service_order_id']) && (mb_strlen($this->container['service_order_id']) < 5)) {
            $invalidProperties[] = "invalid value for 'service_order_id', the character length must be bigger than or equal to 5.";
        }

        if (!is_null($this->container['marketplace_id']) && !preg_match("/^[A-Z0-9]*$/", $this->container['marketplace_id'])) {
            $invalidProperties[] = "invalid value for 'marketplace_id', must be conform to the pattern /^[A-Z0-9]*$/.";
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
     * Gets create_time
     *
     * @return string|null
     */
    public function getCreateTime()
    {
        return $this->container['create_time'];
    }

    /**
     * Sets create_time
     *
     * @param string|null $create_time The date and time of the creation of the job, in ISO 8601 format.
     *
     * @return self
     */
    public function setCreateTime($create_time)
    {
        $this->container['create_time'] = $create_time;

        return $this;
    }
    /**
     * Gets service_job_id
     *
     * @return string|null
     */
    public function getServiceJobId()
    {
        return $this->container['service_job_id'];
    }

    /**
     * Sets service_job_id
     *
     * @param string|null $service_job_id Amazon identifier for the service job.
     *
     * @return self
     */
    public function setServiceJobId($service_job_id)
    {
        if (!is_null($service_job_id) && (mb_strlen($service_job_id) > 100)) {
            throw new \InvalidArgumentException('invalid length for $service_job_id when calling ServiceJob., must be smaller than or equal to 100.');
        }
        if (!is_null($service_job_id) && (mb_strlen($service_job_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $service_job_id when calling ServiceJob., must be bigger than or equal to 1.');
        }

        $this->container['service_job_id'] = $service_job_id;

        return $this;
    }
    /**
     * Gets service_job_status
     *
     * @return string|null
     */
    public function getServiceJobStatus()
    {
        return $this->container['service_job_status'];
    }

    /**
     * Sets service_job_status
     *
     * @param string|null $service_job_status The status of the service job.
     *
     * @return self
     */
    public function setServiceJobStatus($service_job_status)
    {
        $allowedValues = $this->getServiceJobStatusAllowableValues();
        if (!is_null($service_job_status) && !in_array($service_job_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'service_job_status', must be one of '%s'",
                    $service_job_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['service_job_status'] = $service_job_status;

        return $this;
    }
    /**
     * Gets scope_of_work
     *
     * @return \SellingPartnerApi\Model\Service\ScopeOfWork|null
     */
    public function getScopeOfWork()
    {
        return $this->container['scope_of_work'];
    }

    /**
     * Sets scope_of_work
     *
     * @param \SellingPartnerApi\Model\Service\ScopeOfWork|null $scope_of_work scope_of_work
     *
     * @return self
     */
    public function setScopeOfWork($scope_of_work)
    {
        $this->container['scope_of_work'] = $scope_of_work;

        return $this;
    }
    /**
     * Gets seller
     *
     * @return \SellingPartnerApi\Model\Service\Seller|null
     */
    public function getSeller()
    {
        return $this->container['seller'];
    }

    /**
     * Sets seller
     *
     * @param \SellingPartnerApi\Model\Service\Seller|null $seller seller
     *
     * @return self
     */
    public function setSeller($seller)
    {
        $this->container['seller'] = $seller;

        return $this;
    }
    /**
     * Gets service_job_provider
     *
     * @return \SellingPartnerApi\Model\Service\ServiceJobProvider|null
     */
    public function getServiceJobProvider()
    {
        return $this->container['service_job_provider'];
    }

    /**
     * Sets service_job_provider
     *
     * @param \SellingPartnerApi\Model\Service\ServiceJobProvider|null $service_job_provider service_job_provider
     *
     * @return self
     */
    public function setServiceJobProvider($service_job_provider)
    {
        $this->container['service_job_provider'] = $service_job_provider;

        return $this;
    }
    /**
     * Gets preferred_appointment_times
     *
     * @return \SellingPartnerApi\Model\Service\AppointmentTime[]|null
     */
    public function getPreferredAppointmentTimes()
    {
        return $this->container['preferred_appointment_times'];
    }

    /**
     * Sets preferred_appointment_times
     *
     * @param \SellingPartnerApi\Model\Service\AppointmentTime[]|null $preferred_appointment_times A list of appointment windows preferred by the buyer. Included only if the buyer selected appointment windows when creating the order.
     *
     * @return self
     */
    public function setPreferredAppointmentTimes($preferred_appointment_times)
    {
        $this->container['preferred_appointment_times'] = $preferred_appointment_times;

        return $this;
    }
    /**
     * Gets appointments
     *
     * @return \SellingPartnerApi\Model\Service\Appointment[]|null
     */
    public function getAppointments()
    {
        return $this->container['appointments'];
    }

    /**
     * Sets appointments
     *
     * @param \SellingPartnerApi\Model\Service\Appointment[]|null $appointments A list of appointments.
     *
     * @return self
     */
    public function setAppointments($appointments)
    {
        $this->container['appointments'] = $appointments;

        return $this;
    }
    /**
     * Gets service_order_id
     *
     * @return string|null
     */
    public function getServiceOrderId()
    {
        return $this->container['service_order_id'];
    }

    /**
     * Sets service_order_id
     *
     * @param string|null $service_order_id The Amazon-defined identifier for an order placed by the buyer, in 3-7-7 format.
     *
     * @return self
     */
    public function setServiceOrderId($service_order_id)
    {
        if (!is_null($service_order_id) && (mb_strlen($service_order_id) > 20)) {
            throw new \InvalidArgumentException('invalid length for $service_order_id when calling ServiceJob., must be smaller than or equal to 20.');
        }
        if (!is_null($service_order_id) && (mb_strlen($service_order_id) < 5)) {
            throw new \InvalidArgumentException('invalid length for $service_order_id when calling ServiceJob., must be bigger than or equal to 5.');
        }

        $this->container['service_order_id'] = $service_order_id;

        return $this;
    }
    /**
     * Gets marketplace_id
     *
     * @return string|null
     */
    public function getMarketplaceId()
    {
        return $this->container['marketplace_id'];
    }

    /**
     * Sets marketplace_id
     *
     * @param string|null $marketplace_id The marketplace identifier.
     *
     * @return self
     */
    public function setMarketplaceId($marketplace_id)
    {

        if (!is_null($marketplace_id) && (!preg_match("/^[A-Z0-9]*$/", $marketplace_id))) {
            throw new \InvalidArgumentException("invalid value for $marketplace_id when calling ServiceJob., must conform to the pattern /^[A-Z0-9]*$/.");
        }

        $this->container['marketplace_id'] = $marketplace_id;

        return $this;
    }
    /**
     * Gets buyer
     *
     * @return \SellingPartnerApi\Model\Service\Buyer|null
     */
    public function getBuyer()
    {
        return $this->container['buyer'];
    }

    /**
     * Sets buyer
     *
     * @param \SellingPartnerApi\Model\Service\Buyer|null $buyer buyer
     *
     * @return self
     */
    public function setBuyer($buyer)
    {
        $this->container['buyer'] = $buyer;

        return $this;
    }
    /**
     * Gets associated_items
     *
     * @return \SellingPartnerApi\Model\Service\AssociatedItem[]|null
     */
    public function getAssociatedItems()
    {
        return $this->container['associated_items'];
    }

    /**
     * Sets associated_items
     *
     * @param \SellingPartnerApi\Model\Service\AssociatedItem[]|null $associated_items A list of items associated with the service job.
     *
     * @return self
     */
    public function setAssociatedItems($associated_items)
    {
        $this->container['associated_items'] = $associated_items;

        return $this;
    }
    /**
     * Gets service_location
     *
     * @return \SellingPartnerApi\Model\Service\ServiceLocation|null
     */
    public function getServiceLocation()
    {
        return $this->container['service_location'];
    }

    /**
     * Sets service_location
     *
     * @param \SellingPartnerApi\Model\Service\ServiceLocation|null $service_location service_location
     *
     * @return self
     */
    public function setServiceLocation($service_location)
    {
        $this->container['service_location'] = $service_location;

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


