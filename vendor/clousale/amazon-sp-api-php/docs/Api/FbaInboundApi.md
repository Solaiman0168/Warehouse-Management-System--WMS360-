# Swagger\Client\FbaInboundApi

All URIs are relative to *https://sellingpartnerapi-na.amazon.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**confirmPreorder**](FbaInboundApi.md#confirmpreorder) | **PUT** /fba/inbound/v0/shipments/{shipmentId}/preorder/confirm | 
[**confirmTransport**](FbaInboundApi.md#confirmtransport) | **POST** /fba/inbound/v0/shipments/{shipmentId}/transport/confirm | 
[**createInboundShipment**](FbaInboundApi.md#createinboundshipment) | **POST** /fba/inbound/v0/shipments/{shipmentId} | 
[**createInboundShipmentPlan**](FbaInboundApi.md#createinboundshipmentplan) | **POST** /fba/inbound/v0/plans | 
[**estimateTransport**](FbaInboundApi.md#estimatetransport) | **POST** /fba/inbound/v0/shipments/{shipmentId}/transport/estimate | 
[**getBillOfLading**](FbaInboundApi.md#getbilloflading) | **GET** /fba/inbound/v0/shipments/{shipmentId}/billOfLading | 
[**getInboundGuidance**](FbaInboundApi.md#getinboundguidance) | **GET** /fba/inbound/v0/itemsGuidance | 
[**getLabels**](FbaInboundApi.md#getlabels) | **GET** /fba/inbound/v0/shipments/{shipmentId}/labels | 
[**getPreorderInfo**](FbaInboundApi.md#getpreorderinfo) | **GET** /fba/inbound/v0/shipments/{shipmentId}/preorder | 
[**getPrepInstructions**](FbaInboundApi.md#getprepinstructions) | **GET** /fba/inbound/v0/prepInstructions | 
[**getShipmentItems**](FbaInboundApi.md#getshipmentitems) | **GET** /fba/inbound/v0/shipmentItems | 
[**getShipmentItemsByShipmentId**](FbaInboundApi.md#getshipmentitemsbyshipmentid) | **GET** /fba/inbound/v0/shipments/{shipmentId}/items | 
[**getShipments**](FbaInboundApi.md#getshipments) | **GET** /fba/inbound/v0/shipments | 
[**getTransportDetails**](FbaInboundApi.md#gettransportdetails) | **GET** /fba/inbound/v0/shipments/{shipmentId}/transport | 
[**putTransportDetails**](FbaInboundApi.md#puttransportdetails) | **PUT** /fba/inbound/v0/shipments/{shipmentId}/transport | 
[**updateInboundShipment**](FbaInboundApi.md#updateinboundshipment) | **PUT** /fba/inbound/v0/shipments/{shipmentId} | 
[**voidTransport**](FbaInboundApi.md#voidtransport) | **POST** /fba/inbound/v0/shipments/{shipmentId}/transport/void | 

# **confirmPreorder**
> \Swagger\Client\Models\ConfirmPreorderResponse confirmPreorder($shipment_id, $need_by_date, $marketplace_id)



Returns information needed to confirm a shipment for pre-order. Call this operation after calling the getPreorderInfo operation to get the NeedByDate value and other pre-order information about the shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.
$need_by_date = new \DateTime("2013-10-20"); // \DateTime | Date that the shipment must arrive at the Amazon fulfillment center to avoid delivery promise breaks for pre-ordered items. Must be in YYYY-MM-DD format. The response to the getPreorderInfo operation returns this value.
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace the shipment is tied to.

try {
    $result = $apiInstance->confirmPreorder($shipment_id, $need_by_date, $marketplace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->confirmPreorder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |
 **need_by_date** | **\DateTime**| Date that the shipment must arrive at the Amazon fulfillment center to avoid delivery promise breaks for pre-ordered items. Must be in YYYY-MM-DD format. The response to the getPreorderInfo operation returns this value. |
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace the shipment is tied to. |

### Return type

[**\Swagger\Client\Models\ConfirmPreorderResponse**](../Model/ConfirmPreorderResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **confirmTransport**
> \Swagger\Client\Models\ConfirmTransportResponse confirmTransport($shipment_id)



Confirms that the seller accepts the Amazon-partnered shipping estimate, agrees to allow Amazon to charge their account for the shipping cost, and requests that the Amazon-partnered carrier ship the inbound shipment.  Prior to calling the confirmTransport operation, you should call the getTransportDetails operation to get the Amazon-partnered shipping estimate.  Important: After confirming the transportation request, if the seller decides that they do not want the Amazon-partnered carrier to ship the inbound shipment, you can call the voidTransport operation to cancel the transportation request. Note that for a Small Parcel shipment, the seller has 24 hours after confirming a transportation request to void the transportation request. For a Less Than Truckload/Full Truckload (LTL/FTL) shipment, the seller has one hour after confirming a transportation request to void it. After the grace period has expired the seller's account will be charged for the shipping cost.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->confirmTransport($shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->confirmTransport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\ConfirmTransportResponse**](../Model/ConfirmTransportResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createInboundShipment**
> \Swagger\Client\Models\InboundShipmentResponse createInboundShipment($body, $shipment_id)



Returns a new inbound shipment based on the specified shipmentId that was returned by the createInboundShipmentPlan operation.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Models\InboundShipmentRequest(); // \Swagger\Client\Models\InboundShipmentRequest | 
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->createInboundShipment($body, $shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->createInboundShipment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Models\InboundShipmentRequest**](../Model/InboundShipmentRequest.md)|  |
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\InboundShipmentResponse**](../Model/InboundShipmentResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createInboundShipmentPlan**
> \Swagger\Client\Models\CreateInboundShipmentPlanResponse createInboundShipmentPlan($body)



Returns one or more inbound shipment plans, which provide the information you need to create one or more inbound shipments for a set of items that you specify. Multiple inbound shipment plans might be required so that items can be optimally placed in Amazon's fulfillment network—for example, positioning inventory closer to the customer. Alternatively, two inbound shipment plans might be created with the same Amazon fulfillment center destination if the two shipment plans require different processing—for example, items that require labels must be shipped separately from stickerless, commingled inventory.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Models\CreateInboundShipmentPlanRequest(); // \Swagger\Client\Models\CreateInboundShipmentPlanRequest | 

try {
    $result = $apiInstance->createInboundShipmentPlan($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->createInboundShipmentPlan: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Models\CreateInboundShipmentPlanRequest**](../Model/CreateInboundShipmentPlanRequest.md)|  |

### Return type

[**\Swagger\Client\Models\CreateInboundShipmentPlanResponse**](../Model/CreateInboundShipmentPlanResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **estimateTransport**
> \Swagger\Client\Models\EstimateTransportResponse estimateTransport($shipment_id)



Initiates the process of estimating the shipping cost for an inbound shipment by an Amazon-partnered carrier.  Prior to calling the estimateTransport operation, you must call the putTransportDetails operation to provide Amazon with the transportation information for the inbound shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->estimateTransport($shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->estimateTransport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\EstimateTransportResponse**](../Model/EstimateTransportResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBillOfLading**
> \Swagger\Client\Models\GetBillOfLadingResponse getBillOfLading($shipment_id)



Returns a bill of lading for a Less Than Truckload/Full Truckload (LTL/FTL) shipment. The getBillOfLading operation returns PDF document data for printing a bill of lading for an Amazon-partnered Less Than Truckload/Full Truckload (LTL/FTL) inbound shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->getBillOfLading($shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getBillOfLading: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\GetBillOfLadingResponse**](../Model/GetBillOfLadingResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getInboundGuidance**
> \Swagger\Client\Models\GetInboundGuidanceResponse getInboundGuidance($marketplace_id, $seller_sku_list, $asin_list)



Returns information that lets a seller know if Amazon recommends sending an item to a given marketplace. In some cases, Amazon provides guidance for why a given SellerSKU or ASIN is not recommended for shipment to Amazon's fulfillment network. Sellers may still ship items that are not recommended, at their discretion.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace where the product would be stored.
$seller_sku_list = array("seller_sku_list_example"); // string[] | A list of SellerSKU values. Used to identify items for which you want inbound guidance for shipment to Amazon's fulfillment network. Note: SellerSKU is qualified by the SellerId, which is included with every Selling Partner API operation that you submit. If you specify a SellerSKU that identifies a variation parent ASIN, this operation returns an error. A variation parent ASIN represents a generic product that cannot be sold. Variation child ASINs represent products that have specific characteristics (such as size and color) and can be sold.
$asin_list = array("asin_list_example"); // string[] | A list of ASIN values. Used to identify items for which you want inbound guidance for shipment to Amazon's fulfillment network. Note: If you specify a ASIN that identifies a variation parent ASIN, this operation returns an error. A variation parent ASIN represents a generic product that cannot be sold. Variation child ASINs represent products that have specific characteristics (such as size and color) and can be sold.

try {
    $result = $apiInstance->getInboundGuidance($marketplace_id, $seller_sku_list, $asin_list);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getInboundGuidance: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace where the product would be stored. |
 **seller_sku_list** | [**string[]**](../Model/string.md)| A list of SellerSKU values. Used to identify items for which you want inbound guidance for shipment to Amazon&#x27;s fulfillment network. Note: SellerSKU is qualified by the SellerId, which is included with every Selling Partner API operation that you submit. If you specify a SellerSKU that identifies a variation parent ASIN, this operation returns an error. A variation parent ASIN represents a generic product that cannot be sold. Variation child ASINs represent products that have specific characteristics (such as size and color) and can be sold. | [optional]
 **asin_list** | [**string[]**](../Model/string.md)| A list of ASIN values. Used to identify items for which you want inbound guidance for shipment to Amazon&#x27;s fulfillment network. Note: If you specify a ASIN that identifies a variation parent ASIN, this operation returns an error. A variation parent ASIN represents a generic product that cannot be sold. Variation child ASINs represent products that have specific characteristics (such as size and color) and can be sold. | [optional]

### Return type

[**\Swagger\Client\Models\GetInboundGuidanceResponse**](../Model/GetInboundGuidanceResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLabels**
> \Swagger\Client\Models\GetLabelsResponse getLabels($shipment_id, $page_type, $label_type, $number_of_packages, $package_labels_to_print, $number_of_pallets)



Returns package/pallet labels for faster and more accurate shipment processing at the Amazon fulfillment center.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.
$page_type = "page_type_example"; // string | The page type to use to print the labels. Submitting a PageType value that is not supported in your marketplace returns an error.
$label_type = "label_type_example"; // string | The type of labels requested.
$number_of_packages = 56; // int | The number of packages in the shipment.
$package_labels_to_print = array("package_labels_to_print_example"); // string[] | A list of identifiers that specify packages for which you want package labels printed.  Must match CartonId values previously passed using the FBA Inbound Shipment Carton Information Feed. If not, the operation returns the IncorrectPackageIdentifier error code.
$number_of_pallets = 56; // int | The number of pallets in the shipment. This returns four identical labels for each pallet.

try {
    $result = $apiInstance->getLabels($shipment_id, $page_type, $label_type, $number_of_packages, $package_labels_to_print, $number_of_pallets);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getLabels: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |
 **page_type** | **string**| The page type to use to print the labels. Submitting a PageType value that is not supported in your marketplace returns an error. |
 **label_type** | **string**| The type of labels requested. |
 **number_of_packages** | **int**| The number of packages in the shipment. | [optional]
 **package_labels_to_print** | [**string[]**](../Model/string.md)| A list of identifiers that specify packages for which you want package labels printed.  Must match CartonId values previously passed using the FBA Inbound Shipment Carton Information Feed. If not, the operation returns the IncorrectPackageIdentifier error code. | [optional]
 **number_of_pallets** | **int**| The number of pallets in the shipment. This returns four identical labels for each pallet. | [optional]

### Return type

[**\Swagger\Client\Models\GetLabelsResponse**](../Model/GetLabelsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPreorderInfo**
> \Swagger\Client\Models\GetPreorderInfoResponse getPreorderInfo($shipment_id, $marketplace_id)



Returns pre-order information, including dates, that a seller needs before confirming a shipment for pre-order.   

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace the shipment is tied to.

try {
    $result = $apiInstance->getPreorderInfo($shipment_id, $marketplace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getPreorderInfo: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace the shipment is tied to. |

### Return type

[**\Swagger\Client\Models\GetPreorderInfoResponse**](../Model/GetPreorderInfoResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPrepInstructions**
> \Swagger\Client\Models\GetPrepInstructionsResponse getPrepInstructions($ship_to_country_code, $seller_sku_list, $asin_list)



Returns labeling requirements and item preparation instructions to help prepare items for shipment to Amazon's fulfillment network.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ship_to_country_code = "ship_to_country_code_example"; // string | The country code of the country to which the items will be shipped. Note that labeling requirements and item preparation instructions can vary by country.
$seller_sku_list = array("seller_sku_list_example"); // string[] | A list of SellerSKU values. Used to identify items for which you want labeling requirements and item preparation instructions for shipment to Amazon's fulfillment network. The SellerSKU is qualified by the Seller ID, which is included with every call to the Seller Partner API.  Note: Include seller SKUs that you have used to list items on Amazon's retail website. If you include a seller SKU that you have never used to list an item on Amazon's retail website, the seller SKU is returned in the InvalidSKUList property in the response.
$asin_list = array("asin_list_example"); // string[] | A list of ASIN values. Used to identify items for which you want item preparation instructions to help with item sourcing decisions.  Note: ASINs must be included in the product catalog for at least one of the marketplaces that the seller  participates in. Any ASIN that is not included in the product catalog for at least one of the marketplaces that the seller participates in is returned in the InvalidASINList property in the response. You can find out which marketplaces a seller participates in by calling the getMarketplaceParticipations operation in the Selling Partner API for Sellers.

try {
    $result = $apiInstance->getPrepInstructions($ship_to_country_code, $seller_sku_list, $asin_list);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getPrepInstructions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ship_to_country_code** | **string**| The country code of the country to which the items will be shipped. Note that labeling requirements and item preparation instructions can vary by country. |
 **seller_sku_list** | [**string[]**](../Model/string.md)| A list of SellerSKU values. Used to identify items for which you want labeling requirements and item preparation instructions for shipment to Amazon&#x27;s fulfillment network. The SellerSKU is qualified by the Seller ID, which is included with every call to the Seller Partner API.  Note: Include seller SKUs that you have used to list items on Amazon&#x27;s retail website. If you include a seller SKU that you have never used to list an item on Amazon&#x27;s retail website, the seller SKU is returned in the InvalidSKUList property in the response. | [optional]
 **asin_list** | [**string[]**](../Model/string.md)| A list of ASIN values. Used to identify items for which you want item preparation instructions to help with item sourcing decisions.  Note: ASINs must be included in the product catalog for at least one of the marketplaces that the seller  participates in. Any ASIN that is not included in the product catalog for at least one of the marketplaces that the seller participates in is returned in the InvalidASINList property in the response. You can find out which marketplaces a seller participates in by calling the getMarketplaceParticipations operation in the Selling Partner API for Sellers. | [optional]

### Return type

[**\Swagger\Client\Models\GetPrepInstructionsResponse**](../Model/GetPrepInstructionsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getShipmentItems**
> \Swagger\Client\Models\GetShipmentItemsResponse getShipmentItems($query_type, $marketplace_id, $last_updated_after, $last_updated_before, $next_token)



Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time frame.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$query_type = "query_type_example"; // string | Indicates whether items are returned using a date range (by providing the LastUpdatedAfter and LastUpdatedBefore parameters), or using NextToken, which continues returning items specified in a previous request.
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace where the product would be stored.
$last_updated_after = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | A date used for selecting inbound shipment items that were last updated after (or at) a specified time. The selection includes updates made by Amazon and by the seller.
$last_updated_before = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | A date used for selecting inbound shipment items that were last updated before (or at) a specified time. The selection includes updates made by Amazon and by the seller.
$next_token = "next_token_example"; // string | A string token returned in the response to your previous request.

try {
    $result = $apiInstance->getShipmentItems($query_type, $marketplace_id, $last_updated_after, $last_updated_before, $next_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getShipmentItems: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **query_type** | **string**| Indicates whether items are returned using a date range (by providing the LastUpdatedAfter and LastUpdatedBefore parameters), or using NextToken, which continues returning items specified in a previous request. |
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace where the product would be stored. |
 **last_updated_after** | **\DateTime**| A date used for selecting inbound shipment items that were last updated after (or at) a specified time. The selection includes updates made by Amazon and by the seller. | [optional]
 **last_updated_before** | **\DateTime**| A date used for selecting inbound shipment items that were last updated before (or at) a specified time. The selection includes updates made by Amazon and by the seller. | [optional]
 **next_token** | **string**| A string token returned in the response to your previous request. | [optional]

### Return type

[**\Swagger\Client\Models\GetShipmentItemsResponse**](../Model/GetShipmentItemsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getShipmentItemsByShipmentId**
> \Swagger\Client\Models\GetShipmentItemsResponse getShipmentItemsByShipmentId($shipment_id, $marketplace_id)



Returns a list of items in a specified inbound shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier used for selecting items in a specific inbound shipment.
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace where the product would be stored.

try {
    $result = $apiInstance->getShipmentItemsByShipmentId($shipment_id, $marketplace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getShipmentItemsByShipmentId: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier used for selecting items in a specific inbound shipment. |
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace where the product would be stored. |

### Return type

[**\Swagger\Client\Models\GetShipmentItemsResponse**](../Model/GetShipmentItemsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getShipments**
> \Swagger\Client\Models\GetShipmentsResponse getShipments($query_type, $marketplace_id, $shipment_status_list, $shipment_id_list, $last_updated_after, $last_updated_before, $next_token)



Returns a list of inbound shipments based on criteria that you specify.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$query_type = "query_type_example"; // string | Indicates whether shipments are returned using shipment information (by providing the ShipmentStatusList or ShipmentIdList parameters), using a date range (by providing the LastUpdatedAfter and LastUpdatedBefore parameters), or by using NextToken to continue returning items specified in a previous request.
$marketplace_id = "marketplace_id_example"; // string | A marketplace identifier. Specifies the marketplace where the product would be stored.
$shipment_status_list = array("shipment_status_list_example"); // string[] | A list of ShipmentStatus values. Used to select shipments with a current status that matches the status values that you specify.
$shipment_id_list = array("shipment_id_list_example"); // string[] | A list of shipment IDs used to select the shipments that you want. If both ShipmentStatusList and ShipmentIdList are specified, only shipments that match both parameters are returned.
$last_updated_after = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | A date used for selecting inbound shipments that were last updated after (or at) a specified time. The selection includes updates made by Amazon and by the seller.
$last_updated_before = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | A date used for selecting inbound shipments that were last updated before (or at) a specified time. The selection includes updates made by Amazon and by the seller.
$next_token = "next_token_example"; // string | A string token returned in the response to your previous request.

try {
    $result = $apiInstance->getShipments($query_type, $marketplace_id, $shipment_status_list, $shipment_id_list, $last_updated_after, $last_updated_before, $next_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getShipments: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **query_type** | **string**| Indicates whether shipments are returned using shipment information (by providing the ShipmentStatusList or ShipmentIdList parameters), using a date range (by providing the LastUpdatedAfter and LastUpdatedBefore parameters), or by using NextToken to continue returning items specified in a previous request. |
 **marketplace_id** | **string**| A marketplace identifier. Specifies the marketplace where the product would be stored. |
 **shipment_status_list** | [**string[]**](../Model/string.md)| A list of ShipmentStatus values. Used to select shipments with a current status that matches the status values that you specify. | [optional]
 **shipment_id_list** | [**string[]**](../Model/string.md)| A list of shipment IDs used to select the shipments that you want. If both ShipmentStatusList and ShipmentIdList are specified, only shipments that match both parameters are returned. | [optional]
 **last_updated_after** | **\DateTime**| A date used for selecting inbound shipments that were last updated after (or at) a specified time. The selection includes updates made by Amazon and by the seller. | [optional]
 **last_updated_before** | **\DateTime**| A date used for selecting inbound shipments that were last updated before (or at) a specified time. The selection includes updates made by Amazon and by the seller. | [optional]
 **next_token** | **string**| A string token returned in the response to your previous request. | [optional]

### Return type

[**\Swagger\Client\Models\GetShipmentsResponse**](../Model/GetShipmentsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTransportDetails**
> \Swagger\Client\Models\GetTransportDetailsResponse getTransportDetails($shipment_id)



Returns current transportation information about an inbound shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->getTransportDetails($shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->getTransportDetails: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\GetTransportDetailsResponse**](../Model/GetTransportDetailsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putTransportDetails**
> \Swagger\Client\Models\PutTransportDetailsResponse putTransportDetails($body, $shipment_id)



Sends transportation information to Amazon about an inbound shipment.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Models\PutTransportDetailsRequest(); // \Swagger\Client\Models\PutTransportDetailsRequest | 
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->putTransportDetails($body, $shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->putTransportDetails: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Models\PutTransportDetailsRequest**](../Model/PutTransportDetailsRequest.md)|  |
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\PutTransportDetailsResponse**](../Model/PutTransportDetailsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateInboundShipment**
> \Swagger\Client\Models\InboundShipmentResponse updateInboundShipment($body, $shipment_id)



Adds, updates, or removes items from the inbound shipment identified by the specified shipment identifier.   

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Models\InboundShipmentRequest(); // \Swagger\Client\Models\InboundShipmentRequest | 
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->updateInboundShipment($body, $shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->updateInboundShipment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Models\InboundShipmentRequest**](../Model/InboundShipmentRequest.md)|  |
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\InboundShipmentResponse**](../Model/InboundShipmentResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **voidTransport**
> \Swagger\Client\Models\VoidTransportResponse voidTransport($shipment_id)



Cancels a previously-confirmed request to ship an inbound shipment using an Amazon-partnered carrier.  To be successful, you must call this operation before the VoidDeadline date that is returned by the getTransportDetails operation.  Important: The VoidDeadline date is 24 hours after you confirm a Small Parcel shipment transportation request or one hour after you confirm a Less Than Truckload/Full Truckload (LTL/FTL) shipment transportation request. After the void deadline passes, your account will be charged for the shipping cost.  

**Usage Plan:**

| Rate (requests per second) | Burst |
| ---- | ---- |
| 2 | 30 |  For more information, see \"Usage Plans and Rate Limits\" in the Selling Partner API documentation.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
$config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
$config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
$config->setApiKey("region", 'us-east-1'); //region of MarketPlace country

$apiInstance = new Swagger\Client\Api\FbaInboundApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shipment_id = "shipment_id_example"; // string | A shipment identifier originally returned by the createInboundShipmentPlan operation.

try {
    $result = $apiInstance->voidTransport($shipment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FbaInboundApi->voidTransport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **shipment_id** | **string**| A shipment identifier originally returned by the createInboundShipmentPlan operation. |

### Return type

[**\Swagger\Client\Models\VoidTransportResponse**](../Model/VoidTransportResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)
