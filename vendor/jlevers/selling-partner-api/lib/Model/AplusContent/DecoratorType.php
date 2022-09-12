<?php
/**
 * DecoratorType
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
 * DecoratorType Class Doc Comment
 *
 * @category Class
 * @description The type of rich text decorator.
 * @package  SellingPartnerApi
 * @group 
 */
class DecoratorType
{
    /**
     * Possible values of this enum
     */
    const LIST_ITEM = 'LIST_ITEM';
    const LIST_ORDERED = 'LIST_ORDERED';
    const LIST_UNORDERED = 'LIST_UNORDERED';
    const STYLE_BOLD = 'STYLE_BOLD';
    const STYLE_ITALIC = 'STYLE_ITALIC';
    const STYLE_LINEBREAK = 'STYLE_LINEBREAK';
    const STYLE_PARAGRAPH = 'STYLE_PARAGRAPH';
    const STYLE_UNDERLINE = 'STYLE_UNDERLINE';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::LIST_ITEM,
            self::LIST_ORDERED,
            self::LIST_UNORDERED,
            self::STYLE_BOLD,
            self::STYLE_ITALIC,
            self::STYLE_LINEBREAK,
            self::STYLE_PARAGRAPH,
            self::STYLE_UNDERLINE,
        ];
    }
}


