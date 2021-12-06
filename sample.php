<?php
/**
 * Amazon Product Advertising APIサンプル
 * 対象はAmazon.co.jpに限定
 *
 * Licensed under the Apache License, Version 2.0.
 * https://www.apache.org/licenses/LICENSE-2.0
 */

define('AMAZON_PA_API_ACCESS_KEY', '********');
define('AMAZON_PA_API_SECRET_KEY', "********");
define('AMAZON_PA_API_PARTNER_TAG', '********');
define('AMAZON_PA_API_REGION_NAME', 'us-west-2');
define('AMAZON_PA_API_PARTNER_TYPE', 'Associates');
define('AMAZON_PA_API_MARKET_PLACE', 'www.amazon.co.jp');

require_once './AwsV4.php';
require_once './MyAmazonPaApi.php';

$masterModes = [
    'GetBrowseNodes',
    'GetItems',
    'GetVariations',
    'SearchItems',
];

$resources = [
    'BrowseNodeInfo.BrowseNodes',
    'BrowseNodeInfo.BrowseNodes.Ancestor',
    'BrowseNodeInfo.BrowseNodes.SalesRank',
    'BrowseNodeInfo.WebsiteSalesRank',
    'CustomerReviews.Count',
    'CustomerReviews.StarRating',
    'Images.Primary.Small',
    'Images.Primary.Medium',
    'Images.Primary.Large',
    'Images.Variants.Small',
    'Images.Variants.Medium',
    'Images.Variants.Large',
    'ItemInfo.ByLineInfo',
    'ItemInfo.ContentInfo',
    'ItemInfo.ContentRating',
    'ItemInfo.Classifications',
    'ItemInfo.ExternalIds',
    'ItemInfo.Features',
    'ItemInfo.ManufactureInfo',
    'ItemInfo.ProductInfo',
    'ItemInfo.TechnicalInfo',
    'ItemInfo.Title',
    'ItemInfo.TradeInInfo',
    'Offers.Listings.Availability.MaxOrderQuantity',
    'Offers.Listings.Availability.Message',
    'Offers.Listings.Availability.MinOrderQuantity',
    'Offers.Listings.Availability.Type',
    'Offers.Listings.Condition',
    'Offers.Listings.Condition.ConditionNote',
    'Offers.Listings.Condition.SubCondition',
    'Offers.Listings.DeliveryInfo.IsAmazonFulfilled',
    'Offers.Listings.DeliveryInfo.IsFreeShippingEligible',
    'Offers.Listings.DeliveryInfo.IsPrimeEligible',
    'Offers.Listings.DeliveryInfo.ShippingCharges',
    'Offers.Listings.IsBuyBoxWinner',
    'Offers.Listings.LoyaltyPoints.Points',
    'Offers.Listings.MerchantInfo',
    'Offers.Listings.Price',
    'Offers.Listings.ProgramEligibility.IsPrimeExclusive',
    'Offers.Listings.ProgramEligibility.IsPrimePantry',
    'Offers.Listings.Promotions',
    'Offers.Listings.SavingBasis',
    'Offers.Summaries.HighestPrice',
    'Offers.Summaries.LowestPrice',
    'Offers.Summaries.OfferCount',
    'ParentASIN',
    'RentalOffers.Listings.Availability.MaxOrderQuantity',
    'RentalOffers.Listings.Availability.Message',
    'RentalOffers.Listings.Availability.MinOrderQuantity',
    'RentalOffers.Listings.Availability.Type',
    'RentalOffers.Listings.BasePrice',
    'RentalOffers.Listings.Condition',
    'RentalOffers.Listings.Condition.ConditionNote',
    'RentalOffers.Listings.Condition.SubCondition',
    'RentalOffers.Listings.DeliveryInfo.IsAmazonFulfilled',
    'RentalOffers.Listings.DeliveryInfo.IsFreeShippingEligible',
    'RentalOffers.Listings.DeliveryInfo.IsPrimeEligible',
    'RentalOffers.Listings.DeliveryInfo.ShippingCharges',
    'RentalOffers.Listings.MerchantInfo',
];

$newParams = [
    'access_key' => AMAZON_PA_API_ACCESS_KEY,
    'secret_key' => AMAZON_PA_API_SECRET_KEY,
    'region_name' => AMAZON_PA_API_REGION_NAME,
];
$myAmazonPaApi = new MyAmazonPaApi($newParams);
if (empty($argv[1])  || !in_array($argv[1], $masterModes)) {
    echo 'mode error' . PHP_EOL;
    exit;
}

$modeParams = [
    'region_name' => AMAZON_PA_API_REGION_NAME,
    'partner_tag' => AMAZON_PA_API_PARTNER_TAG,
    'partner_type' => AMAZON_PA_API_PARTNER_TYPE,
    'market_place' => AMAZON_PA_API_MARKET_PLACE,
];

$mode = $argv[1];
switch ($mode) {
    case 'GetBrowseNodes':
        if (empty($argv[2])) {
            echo 'GetBrowseNodes parameter error';
        }
        $modeParams['browse_node_ids'] = explode(',', $argv[2]);
        $myAmazonPaApi->getBrowseNode($modeParams);
        break;

    case 'GetItems':
        if (empty($argv[2])) {
            echo 'GetItems parameter error';
        }
        $modeParams['item_ids'] = explode(',', $argv[2]);
        $modeParams['resources'] = $resources;
        $myAmazonPaApi->getItems($modeParams);
        break;

    case 'GetVariations':
        if (empty($argv[2])) {
            echo 'GetItems parameter error';
        }
        $modeParams['asin'] = $argv[2];
        $myAmazonPaApi->getVariations($modeParams);
        break;

    case 'SearchItems':
        if (empty($argv[2]) || empty($argv[3])) {
            echo 'SearchItems parameter error';
        }
        $modeParams['keywords'] = $argv[2];
        $modeParams['search_index'] = $argv[3];

        $myAmazonPaApi->searchItems($modeParams);
        break;

    default:
        echo 'mode not found' . PHP_EOL;
        break;
}
