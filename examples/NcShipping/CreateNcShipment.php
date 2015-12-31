<?php
use Distantia\CanadaPostWs\NcShipping;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\NcShipment\DeliverySpecType;
use Distantia\CanadaPostWs\Type\NcShipment\DestinationAddressDetailsType;
use Distantia\CanadaPostWs\Type\NcShipment\DestinationType;
use Distantia\CanadaPostWs\Type\NcShipment\DimensionType;
use Distantia\CanadaPostWs\Type\NcShipment\DomesticAddressDetailsType;
use Distantia\CanadaPostWs\Type\NcShipment\NonContractShipmentInfoType;
use Distantia\CanadaPostWs\Type\NcShipment\NonContractShipmentType;
use Distantia\CanadaPostWs\Type\NcShipment\OptionsType;
use Distantia\CanadaPostWs\Type\NcShipment\OptionType;
use Distantia\CanadaPostWs\Type\NcShipment\ParcelCharacteristicsType;
use Distantia\CanadaPostWs\Type\NcShipment\PreferencesType;
use Distantia\CanadaPostWs\Type\NcShipment\ReferencesType;
use Distantia\CanadaPostWs\Type\NcShipment\SenderType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config (Must use an account without contract)
define('CANADA_POST_API_CUSTOMER_NUMBER', '');
define('CANADA_POST_API_KEY', '');

// Shipment object to create
$NcShipment = new NonContractShipmentType();
$NcShipment->setRequestedShippingPoint('H2B1A0');

$DeliverySpec = new DeliverySpecType();
$DeliverySpec->setServiceCode(WebService::$serviceCodes[WebService::SHIPPING_CODE_DOMESTIC_EXPEDITED]);

$Sender = new SenderType();
$Sender->setName('Bulma');
$Sender->setCompany('Capsule Corp.');
$Sender->setContactPhone('1 (514) 820 5879');

$AddressDetails = new DomesticAddressDetailsType();
$AddressDetails->setAddressLine1('502 MAIN ST N');
$AddressDetails->setCity('Montréal');
$AddressDetails->setProvState('QC');
$AddressDetails->setPostalZipCode('H2B1A0');

$Sender->setAddressDetails($AddressDetails);

$DeliverySpec->setSender($Sender);

$Destination = new DestinationType();
$Destination->setName('John Doe');
$Destination->setCompany('ACME Corp');

$DestinationAddressDetails = new DestinationAddressDetailsType();
$DestinationAddressDetails->setAddressLine1('123 Postal Drive');
$DestinationAddressDetails->setCity('Ottawa');
$DestinationAddressDetails->setProvState('ON');
$DestinationAddressDetails->setCountryCode('CA');
$DestinationAddressDetails->setPostalZipCode('K1P5Z9');

$Destination->setAddressDetails($DestinationAddressDetails);

$DeliverySpec->setDestination($Destination);

$Options = new OptionsType();

$Option = new OptionType();
$Option->setOptionCode('DC');

$Options->addOption($Option);

$DeliverySpec->setOptions($Options);

$ParcelCharacteristics = new ParcelCharacteristicsType();

$ParcelCharacteristics->setWeight(15);

$Dimension = new DimensionType();
$Dimension->setLength(6);
$Dimension->setWidth(12);
$Dimension->setHeight(9);

$ParcelCharacteristics->setDimensions($Dimension);

$DeliverySpec->setParcelCharacteristics($ParcelCharacteristics);

$Preferences = new PreferencesType();
$Preferences->setShowPackingInstructions(true);

$DeliverySpec->setPreferences($Preferences);

$References = new ReferencesType();

$References->setCostCentre('ccent');
$References->setCustomerRef1('custref1');
$References->setCustomerRef2('custref2');

$DeliverySpec->setReferences($References);

$NcShipment->setDeliverySpec($DeliverySpec);

// Initiate Canada Post's API
$NcShipping = new NcShipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to create shipment
$shipmentResponse = $NcShipping->createNcShipment($NcShipment);

// Output result for debug
if ($shipmentResponse instanceof NonContractShipmentInfoType) {
    var_dump($shipmentResponse);
} elseif ($shipmentResponse instanceof MessagesType) {
    var_dump($shipmentResponse);
} else {
    throw new \Exception('Unexpected response.');
}
