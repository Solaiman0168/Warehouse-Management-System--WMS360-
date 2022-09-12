<?php
/**
 * FbaInboundEligibilityApi
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for FBA Inbound Eligibilty
 *
 * With the FBA Inbound Eligibility API, you can build applications that let sellers get eligibility previews for items before shipping them to Amazon's fulfillment centers. With this API you can find out if an item is eligible for inbound shipment to Amazon's fulfillment centers in a specific marketplace. You can also find out if an item is eligible for using the manufacturer barcode for FBA inventory tracking. Sellers can use this information to inform their decisions about which items to ship Amazon's fulfillment centers.
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

namespace SellingPartnerApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use SellingPartnerApi\ApiException;
use SellingPartnerApi\Configuration;
use SellingPartnerApi\HeaderSelector;
use SellingPartnerApi\ObjectSerializer;

/**
 * FbaInboundEligibilityApi Class Doc Comment
 *
 * @category Class
 * @package  SellingPartnerApi
 */
class FbaInboundEligibilityApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param Configuration   $config
     * @param ClientInterface $client
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        Configuration $config,
        ClientInterface $client = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config;
        $this->headerSelector = $selector ?: new HeaderSelector($this->config);
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex)
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getItemEligibilityPreview
     *
     * @param  string $asin The ASIN of the item for which you want an eligibility preview. (required)
     * @param  string $program The program that you want to check eligibility against. (required)
     * @param  string[] $marketplace_ids The identifier for the marketplace in which you want to determine eligibility. Required only when program&#x3D;INBOUND. (optional)
     *
     * @throws \SellingPartnerApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse
     */
    public function getItemEligibilityPreview($asin, $program, $marketplace_ids = null)
    {
        $response = $this->getItemEligibilityPreviewWithHttpInfo($asin, $program, $marketplace_ids);
        return $response;
    }

    /**
     * Operation getItemEligibilityPreviewWithHttpInfo
     *
     * @param  string $asin The ASIN of the item for which you want an eligibility preview. (required)
     * @param  string $program The program that you want to check eligibility against. (required)
     * @param  string[] $marketplace_ids The identifier for the marketplace in which you want to determine eligibility. Required only when program&#x3D;INBOUND. (optional)
     *
     * @throws \SellingPartnerApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getItemEligibilityPreviewWithHttpInfo($asin, $program, $marketplace_ids = null)
    {
        $request = $this->getItemEligibilityPreviewRequest($asin, $program, $marketplace_ids);
        $signedRequest = $this->config->signRequest(
            $request
        );

        $this->writeDebug($signedRequest);
        $this->writeDebug((string) $signedRequest->getBody());

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($signedRequest, $options);
                $this->writeDebug($response);
                $this->writeDebug((string) $response->getBody());
            } catch (RequestException $e) {
                $body = (string) $e->getResponse()->getBody();
                $this->writeDebug($e->getResponse());
                $this->writeDebug($body);
                throw new ApiException(
                    "[{$e->getCode()}] {$body}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $body : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $signedRequest->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()->getContents()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 400:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 401:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 403:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 404:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 429:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 500:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
                case 503:
                    if ('\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse', $response->getHeaders());
            }

            $returnType = '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 503:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            $this->writeDebug($e);
            throw $e;
        }
    }

    /**
     * Operation getItemEligibilityPreviewAsync
     *
     * 
     *
     * @param  string $asin The ASIN of the item for which you want an eligibility preview. (required)
     * @param  string $program The program that you want to check eligibility against. (required)
     * @param  string[] $marketplace_ids The identifier for the marketplace in which you want to determine eligibility. Required only when program&#x3D;INBOUND. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemEligibilityPreviewAsync($asin, $program, $marketplace_ids = null)
    {
        return $this->getItemEligibilityPreviewAsyncWithHttpInfo($asin, $program, $marketplace_ids);;
    }

    /**
     * Operation getItemEligibilityPreviewAsyncWithHttpInfo
     *
     * 
     *
     * @param  string $asin The ASIN of the item for which you want an eligibility preview. (required)
     * @param  string $program The program that you want to check eligibility against. (required)
     * @param  string[] $marketplace_ids The identifier for the marketplace in which you want to determine eligibility. Required only when program&#x3D;INBOUND. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemEligibilityPreviewAsyncWithHttpInfo($asin, $program, $marketplace_ids = null)
    {
        $returnType = '\SellingPartnerApi\Model\FbaInboundEligibility\GetItemEligibilityPreviewResponse';
        $request = $this->getItemEligibilityPreviewRequest($asin, $program, $marketplace_ids);
        $signedRequest = $this->config->signRequest(
            $request
        );

        $this->writeDebug($signedRequest);
        $this->writeDebug((string) $signedRequest->getBody());

        return $this->client
            ->sendAsync($signedRequest, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $this->writeDebug($response);
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return ObjectSerializer::deserialize($content, $returnType, $response->getHeaders());
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $body = (string) $response->getBody();
                    $this->writeDebug($response);
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $body
                    );
                }
            );
    }

    /**
     * Create request for operation 'getItemEligibilityPreview'
     *
     * @param  string $asin The ASIN of the item for which you want an eligibility preview. (required)
     * @param  string $program The program that you want to check eligibility against. (required)
     * @param  string[] $marketplace_ids The identifier for the marketplace in which you want to determine eligibility. Required only when program&#x3D;INBOUND. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getItemEligibilityPreviewRequest($asin, $program, $marketplace_ids = null)
    {
        // verify the required parameter 'asin' is set
        if ($asin === null || (is_array($asin) && count($asin) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $asin when calling getItemEligibilityPreview'
            );
        }
        // verify the required parameter 'program' is set
        if ($program === null || (is_array($program) && count($program) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $program when calling getItemEligibilityPreview'
            );
        }
        if ($marketplace_ids !== null && count($marketplace_ids) > 1) {
            throw new \InvalidArgumentException('invalid value for "$marketplace_ids" when calling FbaInboundEligibilityApi.getItemEligibilityPreview, number of items must be less than or equal to 1.');
        }


        $resourcePath = '/fba/inbound/v1/eligibility/itemPreview';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($marketplace_ids)) {
            $marketplace_ids = ObjectSerializer::serializeCollection($marketplace_ids, 'form', true);
        }
        if ($marketplace_ids !== null) {
            $queryParams['marketplaceIds'] = $marketplace_ids;
        }

        // query params
        if (is_array($asin)) {
            $asin = ObjectSerializer::serializeCollection($asin, '', true);
        }
        if ($asin !== null) {
            $queryParams['asin'] = $asin;
        }

        // query params
        if (is_array($program)) {
            $program = ObjectSerializer::serializeCollection($program, '', true);
        }
        if ($program !== null) {
            $queryParams['program'] = $program;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'ItemEligibilityPreview']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'ItemEligibilityPreview'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    /**
     * Writes to the debug log file
     *
     * @param any $data
     * @return void
     */
    private function writeDebug($data)
    {
        if ($this->config->getDebug()) {
            file_put_contents($this->config->getDebugFile(), '[' . date('Y-m-d H:i:s') . ']: ' . print_r($data, true) . "\n", FILE_APPEND);
        }
    }
}
