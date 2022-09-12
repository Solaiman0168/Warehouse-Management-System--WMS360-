<?php
/**
 * AsinBadge
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for A+ Content Management
 *
 * With the A+ Content API, you can build applications that help selling partners add rich marketing content to their Amazon product detail pages. A+ content helps selling partners share their brand and product story, which helps buyers make informed purchasing decisions. Selling partners assemble content by choosing from content modules and adding images and text.
 *
 * The version of the OpenAPI document: 2020-11-01
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace SellingPartnerApi\Model\AplusContent;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * AsinBadge Class Doc Comment
 *
 * @category Class
 * @description A flag that provides additional information about an ASIN. This is contextual and may change depending on the request that generated it.
 * @package  SellingPartnerApi
 * @group 
 */
class AsinBadge
{
    /**
     * Possible values of this enum
     */
    const BRAND_NOT_ELIGIBLE = 'BRAND_NOT_ELIGIBLE';
    const CATALOG_NOT_FOUND = 'CATALOG_NOT_FOUND';
    const CONTENT_NOT_PUBLISHED = 'CONTENT_NOT_PUBLISHED';
    const CONTENT_PUBLISHED = 'CONTENT_PUBLISHED';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::BRAND_NOT_ELIGIBLE,
            self::CATALOG_NOT_FOUND,
            self::CONTENT_NOT_PUBLISHED,
            self::CONTENT_PUBLISHED,
        ];
    }
}


