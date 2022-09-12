<?php
/**
 * PrepGuidance
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Fulfillment Inbound
 *
 * The Selling Partner API for Fulfillment Inbound lets you create applications that create and update inbound shipments of inventory to Amazon's fulfillment network.
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

namespace SellingPartnerApi\Model\FbaInbound;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * PrepGuidance Class Doc Comment
 *
 * @category Class
 * @description Item preparation instructions.
 * @package  SellingPartnerApi
 * @group 
 */
class PrepGuidance
{
    /**
     * Possible values of this enum
     */
    const CONSULT_HELP_DOCUMENTS = 'ConsultHelpDocuments';
    const NO_ADDITIONAL_PREP_REQUIRED = 'NoAdditionalPrepRequired';
    const SEE_PREP_INSTRUCTIONS_LIST = 'SeePrepInstructionsList';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::CONSULT_HELP_DOCUMENTS,
            self::NO_ADDITIONAL_PREP_REQUIRED,
            self::SEE_PREP_INSTRUCTIONS_LIST,
        ];
    }
}

