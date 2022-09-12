<?php
/**
 * OptionalFulfillmentProgram
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Product Fees
 *
 * The Selling Partner API for Product Fees lets you programmatically retrieve estimated fees for a product. You can then account for those fees in your pricing.
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

namespace SellingPartnerApi\Model\Fees;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * OptionalFulfillmentProgram Class Doc Comment
 *
 * @category Class
 * @description An optional enrollment program to return the estimated fees when the offer is fulfilled by Amazon (IsAmazonFulfilled is set to true).
 * @package  SellingPartnerApi
 * @group 
 */
class OptionalFulfillmentProgram
{
    /**
     * Possible values of this enum
     */
    const CORE = 'FBA_CORE';
    const SNL = 'FBA_SNL';
    const EFN = 'FBA_EFN';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::CORE,
            self::SNL,
            self::EFN,
        ];
    }
}

