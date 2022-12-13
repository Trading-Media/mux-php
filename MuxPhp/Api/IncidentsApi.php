<?php
/**
 * IncidentsApi
 * PHP version 7.2
 *
 * @category Class
 * @package  MuxPhp
 * @author   Mux API team
 * @link     https://docs.mux.com
 */

/**
 * Mux API
 *
 * Mux is how developers build online video. This API encompasses both Mux Video and Mux Data functionality to help you build your video-related projects better and faster than ever before.
 *
 * The version of the OpenAPI document: v1
 * Contact: devex@mux.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace MuxPhp\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use MuxPhp\ApiException;
use MuxPhp\Configuration;
use MuxPhp\HeaderSelector;
use MuxPhp\ObjectSerializer;

/**
 * IncidentsApi Class Doc Comment
 *
 * @category Class
 * @package  MuxPhp
 * @author   Mux API team
 * @link     https://docs.mux.com
 */
class IncidentsApi
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
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
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
     * Operation getIncident
     *
     * Get an Incident
     *
     * @param  string $incident_id ID of the Incident (required)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \MuxPhp\Models\IncidentResponse
     */
    public function getIncident($incident_id)
    {
        list($response) = $this->getIncidentWithHttpInfo($incident_id);
        return $response;
    }

    /**
     * Operation getIncidentWithHttpInfo
     *
     * Get an Incident
     *
     * @param  string $incident_id ID of the Incident (required)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \MuxPhp\Models\IncidentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getIncidentWithHttpInfo($incident_id)
    {
        $request = $this->getIncidentRequest($incident_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\MuxPhp\Models\IncidentResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\MuxPhp\Models\IncidentResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\MuxPhp\Models\IncidentResponse';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\MuxPhp\Models\IncidentResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getIncidentAsync
     *
     * Get an Incident
     *
     * @param  string $incident_id ID of the Incident (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIncidentAsync($incident_id)
    {
        return $this->getIncidentAsyncWithHttpInfo($incident_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getIncidentAsyncWithHttpInfo
     *
     * Get an Incident
     *
     * @param  string $incident_id ID of the Incident (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIncidentAsyncWithHttpInfo($incident_id)
    {
        $returnType = '\MuxPhp\Models\IncidentResponse';
        $request = $this->getIncidentRequest($incident_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getIncident'
     *
     * @param  string $incident_id ID of the Incident (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getIncidentRequest($incident_id)
    {
        // verify the required parameter 'incident_id' is set
        if ($incident_id === null || (is_array($incident_id) && count($incident_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $incident_id when calling getIncident'
            );
        }

        $resourcePath = '/data/v1/incidents/{INCIDENT_ID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($incident_id !== null) {
            $resourcePath = str_replace(
                '{' . 'INCIDENT_ID' . '}',
                ObjectSerializer::toPathValue($incident_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
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

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
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


        // MUX: adds support for array params.
        // TODO: future upstream?
        $query = ObjectSerializer::buildBetterQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listIncidents
     *
     * List Incidents
     *
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     * @param  string $status Status to filter incidents by (optional)
     * @param  string $severity Severity to filter incidents by (optional)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \MuxPhp\Models\ListIncidentsResponse
     */
    public function listIncidents($limit = 25, $page = 1, $order_by = null, $order_direction = null, $status = null, $severity = null)
    {
        list($response) = $this->listIncidentsWithHttpInfo($limit, $page, $order_by, $order_direction, $status, $severity);
        return $response;
    }

    /**
     * Operation listIncidentsWithHttpInfo
     *
     * List Incidents
     *
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     * @param  string $status Status to filter incidents by (optional)
     * @param  string $severity Severity to filter incidents by (optional)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \MuxPhp\Models\ListIncidentsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listIncidentsWithHttpInfo($limit = 25, $page = 1, $order_by = null, $order_direction = null, $status = null, $severity = null)
    {
        $request = $this->listIncidentsRequest($limit, $page, $order_by, $order_direction, $status, $severity);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\MuxPhp\Models\ListIncidentsResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\MuxPhp\Models\ListIncidentsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\MuxPhp\Models\ListIncidentsResponse';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\MuxPhp\Models\ListIncidentsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listIncidentsAsync
     *
     * List Incidents
     *
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     * @param  string $status Status to filter incidents by (optional)
     * @param  string $severity Severity to filter incidents by (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listIncidentsAsync($limit = 25, $page = 1, $order_by = null, $order_direction = null, $status = null, $severity = null)
    {
        return $this->listIncidentsAsyncWithHttpInfo($limit, $page, $order_by, $order_direction, $status, $severity)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listIncidentsAsyncWithHttpInfo
     *
     * List Incidents
     *
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     * @param  string $status Status to filter incidents by (optional)
     * @param  string $severity Severity to filter incidents by (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listIncidentsAsyncWithHttpInfo($limit = 25, $page = 1, $order_by = null, $order_direction = null, $status = null, $severity = null)
    {
        $returnType = '\MuxPhp\Models\ListIncidentsResponse';
        $request = $this->listIncidentsRequest($limit, $page, $order_by, $order_direction, $status, $severity);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listIncidents'
     *
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     * @param  string $status Status to filter incidents by (optional)
     * @param  string $severity Severity to filter incidents by (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listIncidentsRequest($limit = 25, $page = 1, $order_by = null, $order_direction = null, $status = null, $severity = null)
    {

        $resourcePath = '/data/v1/incidents';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            if('form' === 'form' && is_array($limit)) {
                foreach($limit as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['limit'] = $limit;
            }
        }
        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($order_by !== null) {
            if('form' === 'form' && is_array($order_by)) {
                foreach($order_by as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['order_by'] = $order_by;
            }
        }
        // query params
        if ($order_direction !== null) {
            if('form' === 'form' && is_array($order_direction)) {
                foreach($order_direction as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['order_direction'] = $order_direction;
            }
        }
        // query params
        if ($status !== null) {
            if('form' === 'form' && is_array($status)) {
                foreach($status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['status'] = $status;
            }
        }
        // query params
        if ($severity !== null) {
            if('form' === 'form' && is_array($severity)) {
                foreach($severity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['severity'] = $severity;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
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

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
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


        // MUX: adds support for array params.
        // TODO: future upstream?
        $query = ObjectSerializer::buildBetterQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listRelatedIncidents
     *
     * List Related Incidents
     *
     * @param  string $incident_id ID of the Incident (required)
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \MuxPhp\Models\ListRelatedIncidentsResponse
     */
    public function listRelatedIncidents($incident_id, $limit = 25, $page = 1, $order_by = null, $order_direction = null)
    {
        list($response) = $this->listRelatedIncidentsWithHttpInfo($incident_id, $limit, $page, $order_by, $order_direction);
        return $response;
    }

    /**
     * Operation listRelatedIncidentsWithHttpInfo
     *
     * List Related Incidents
     *
     * @param  string $incident_id ID of the Incident (required)
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     *
     * @throws \MuxPhp\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \MuxPhp\Models\ListRelatedIncidentsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listRelatedIncidentsWithHttpInfo($incident_id, $limit = 25, $page = 1, $order_by = null, $order_direction = null)
    {
        $request = $this->listRelatedIncidentsRequest($incident_id, $limit, $page, $order_by, $order_direction);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\MuxPhp\Models\ListRelatedIncidentsResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\MuxPhp\Models\ListRelatedIncidentsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\MuxPhp\Models\ListRelatedIncidentsResponse';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\MuxPhp\Models\ListRelatedIncidentsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listRelatedIncidentsAsync
     *
     * List Related Incidents
     *
     * @param  string $incident_id ID of the Incident (required)
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listRelatedIncidentsAsync($incident_id, $limit = 25, $page = 1, $order_by = null, $order_direction = null)
    {
        return $this->listRelatedIncidentsAsyncWithHttpInfo($incident_id, $limit, $page, $order_by, $order_direction)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listRelatedIncidentsAsyncWithHttpInfo
     *
     * List Related Incidents
     *
     * @param  string $incident_id ID of the Incident (required)
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listRelatedIncidentsAsyncWithHttpInfo($incident_id, $limit = 25, $page = 1, $order_by = null, $order_direction = null)
    {
        $returnType = '\MuxPhp\Models\ListRelatedIncidentsResponse';
        $request = $this->listRelatedIncidentsRequest($incident_id, $limit, $page, $order_by, $order_direction);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listRelatedIncidents'
     *
     * @param  string $incident_id ID of the Incident (required)
     * @param  int $limit Number of items to include in the response (optional, default to 25)
     * @param  int $page Offset by this many pages, of the size of &#x60;limit&#x60; (optional, default to 1)
     * @param  string $order_by Value to order the results by (optional)
     * @param  string $order_direction Sort order. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listRelatedIncidentsRequest($incident_id, $limit = 25, $page = 1, $order_by = null, $order_direction = null)
    {
        // verify the required parameter 'incident_id' is set
        if ($incident_id === null || (is_array($incident_id) && count($incident_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $incident_id when calling listRelatedIncidents'
            );
        }

        $resourcePath = '/data/v1/incidents/{INCIDENT_ID}/related';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($limit !== null) {
            if('form' === 'form' && is_array($limit)) {
                foreach($limit as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['limit'] = $limit;
            }
        }
        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($order_by !== null) {
            if('form' === 'form' && is_array($order_by)) {
                foreach($order_by as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['order_by'] = $order_by;
            }
        }
        // query params
        if ($order_direction !== null) {
            if('form' === 'form' && is_array($order_direction)) {
                foreach($order_direction as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['order_direction'] = $order_direction;
            }
        }


        // path params
        if ($incident_id !== null) {
            $resourcePath = str_replace(
                '{' . 'INCIDENT_ID' . '}',
                ObjectSerializer::toPathValue($incident_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
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

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
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


        // MUX: adds support for array params.
        // TODO: future upstream?
        $query = ObjectSerializer::buildBetterQuery($queryParams);
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
}
