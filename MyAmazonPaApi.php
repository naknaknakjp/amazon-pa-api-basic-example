<?php
/**
 * Amazon Product Advertising API操作クラス
 *
 * Licensed under the Apache License, Version 2.0.
 * https://www.apache.org/licenses/LICENSE-2.0
 */

class MyAmazonPaApi extends AwsV4
{
    private $host = '';

    /**
     * コンストラクタ
     * MyAmazonPaApi constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $accessKey = $params['access_key'];
        $secretKey = $params['secret_key'];
        $serviceName = 'ProductAdvertisingAPI';
        $this->host = 'webservices.amazon.co.jp';

        parent::__construct($accessKey, $secretKey);
        $this->setServiceName($serviceName);
    }

    /**
     * @param $params
     * @throws Exception
     */
    public function getBrowseNode($params)
    {
        $partnerTag = $params['partner_tag'];
        $partnerType = $params['partner_type'];
        $marketPlace = $params['market_place'];
        $regionName = $params['region_name'];
        $browseNodeIds = $params['browse_node_ids'];

        $payload = "{"
            . "\"BrowseNodeIds\": ["
            . $this->convertArrayString($browseNodeIds)
            . "],"
            . "\"PartnerTag\": \"" . $partnerTag . "\","
            . "\"PartnerType\": \"" . $partnerType . "\","
            . "\"Marketplace\": \"" . $marketPlace . "\""
            . "}";
        $uriPath = "/paapi5/getbrowsenodes";
        $xAmzTarget = 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.GetBrowseNodes';

        $params = [
            'uri_path' => $uriPath,
            'payload' => $payload,
            'host' => $this->host,
            'x_amz_target' => $xAmzTarget,
            'region_name' => $regionName,
        ];
        $response = $this->execute($params);
        echo $response;
    }

    public function getItems($params)
    {
        $partnerTag = $params['partner_tag'];
        $partnerType = $params['partner_type'];
        $marketPlace = $params['market_place'];
        $regionName = $params['region_name'];
        $itemIds = $params['item_ids'];
        $resources = $params['resources'];

        $payload = "{"
            . " \"ItemIds\": ["
            . $this->convertArrayString($itemIds)
            . " ],"
            . " \"Resources\": ["
            . $this->convertArrayString($resources)
            . " ],"
            . " \"PartnerTag\": \"" . $partnerTag . "\","
            . " \"PartnerType\": \"" . $partnerType . "\","
            . " \"Marketplace\": \"" . $marketPlace . "\""
            . "}";
        $uriPath = "/paapi5/getitems";
        $xAmzTarget = 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.GetItems';

        $params = [
            'uri_path' => $uriPath,
            'payload' => $payload,
            'host' => $this->host,
            'x_amz_target' => $xAmzTarget,
            'region_name' => $regionName,
        ];
        $response = $this->execute($params);
        echo $response;


    }
    public function getVariations($params)
    {
        $partnerTag = $params['partner_tag'];
        $partnerType = $params['partner_type'];
        $marketPlace = $params['market_place'];
        $regionName = $params['region_name'];
        $asin = $params['asin'];

        $payload = "{"
            . " \"ASIN\": \"" . $asin . "\","
            . " \"PartnerTag\": \"" . $partnerTag . "\","
            . " \"PartnerType\": \"" . $partnerType . "\","
            . " \"Marketplace\": \"" . $marketPlace . "\""
            . "}";
        $uriPath = "/paapi5/getvariations";
        $xAmzTarget = 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.GetVariations';

        $params = [
            'uri_path' => $uriPath,
            'payload' => $payload,
            'host' => $this->host,
            'x_amz_target' => $xAmzTarget,
            'region_name' => $regionName,
        ];
        $response = $this->execute($params);
        echo $response;
    }

    /**
     * @throws Exception
     */
    public function searchItems($params)
    {
        $partnerTag = $params['partner_tag'];
        $partnerType = $params['partner_type'];
        $marketPlace = $params['market_place'];
        $regionName = $params['region_name'];
        $keywords = $params['keywords'];
        $searchIndex = $params['search_index'];
        $payload = "{"
            . " \"Keywords\": \"" . $keywords . "\","
            . " \"SearchIndex\": \"" . $searchIndex . "\","
            . " \"PartnerTag\": \"" . $partnerTag . "\","
            . " \"PartnerType\": \"" . $partnerType . "\","
            . " \"Marketplace\": \"" . $marketPlace . "\""
            . "}";
        $uriPath = "/paapi5/searchitems";
        $xAmzTarget = 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.SearchItems';

        $params = [
            'uri_path' => $uriPath,
            'payload' => $payload,
            'host' => $this->host,
            'x_amz_target' => $xAmzTarget,
            'region_name' => $regionName,
        ];
        $response = $this->execute($params);
        echo $response;
    }

    /**
     * API通信実行
     * @param $params
     * @return string
     * @throws Exception
     */
    private function execute($params)
    {
        $uriPath = $params['uri_path'];
        $payload = $params['payload'];
        $host = $params['host'];
        $xAmzTarget = $params['x_amz_target'];

        $this->setRegionName($params['region_name']);
        $this->setRegionName($params['region_name']);
        $this->setPath($uriPath);
        $this->setPayload($payload);
        $this->setRequestMethod('POST');
        $this->addHeader('content-encoding', 'amz-1.0');
        $this->addHeader('content-type', 'application/json; charset=utf-8');
        $this->addHeader('host', $host);
        $this->addHeader('x-amz-target', $xAmzTarget);
        $headers = $this->getHeaders();
        $headerString = "";
        foreach ($headers as $key => $value) {
            $headerString .= $key . ': ' . $value . "\r\n";
        }
        $params = array(
            'http' => array(
                'header' => $headerString,
                'method' => 'POST',
                'content' => $payload
            )
        );
        $stream = stream_context_create($params);

        $fp = fopen('https://' . $host . $uriPath, 'rb', false, $stream);

        if (!$fp) {
            throw new Exception ('Exception Occured');
        }
        $response = @stream_get_contents($fp);
        if ($response === false) {
            throw new Exception ('Exception Occured');
        }
        return $response;
    }

    /**
     * 配列をダブルクォーテーションでくくり、カンマ区切りにしたテキストに変換
     * @param $array
     * @return string
     */
    private function convertArrayString($array)
    {
        $text = '';
        $convert = [];
        foreach ($array as $value) {
            $convert[] = "\"" . $value . "\"";
        }
        return implode(',', $convert);
    }
}
