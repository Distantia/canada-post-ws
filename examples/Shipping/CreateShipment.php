<?php
use Distantia\CanadaPostWs\Shipping;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\Shipment\AddressDetailsType;
use Distantia\CanadaPostWs\Type\Shipment\DeliverySpecType;
use Distantia\CanadaPostWs\Type\Shipment\DestinationAddressDetailsType;
use Distantia\CanadaPostWs\Type\Shipment\DestinationType;
use Distantia\CanadaPostWs\Type\Shipment\DimensionType;
use Distantia\CanadaPostWs\Type\Shipment\NotificationType;
use Distantia\CanadaPostWs\Type\Shipment\OptionsType;
use Distantia\CanadaPostWs\Type\Shipment\OptionType;
use Distantia\CanadaPostWs\Type\Shipment\ParcelCharacteristicsType;
use Distantia\CanadaPostWs\Type\Shipment\PreferencesType;
use Distantia\CanadaPostWs\Type\Shipment\PrintPreferencesType;
use Distantia\CanadaPostWs\Type\Shipment\ReferencesType;
use Distantia\CanadaPostWs\Type\Shipment\SenderType;
use Distantia\CanadaPostWs\Type\Shipment\SettlementInfoType;
use Distantia\CanadaPostWs\Type\Shipment\ShipmentInfoType;
use Distantia\CanadaPostWs\Type\Shipment\ShipmentType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config
define('CANADA_POST_API_CUSTOMER_NUMBER', '2004381');
define('CANADA_POST_API_CONTRACT_ID', '42708517');
define('CANADA_POST_API_KEY', '6e93d53968881714:0bfa9fcb9853d1f51ee57a');

// Shipment object to create
$Shipment = new ShipmentType();

$Shipment->setGroupId('4326432');
$Shipment->setRequestedShippingPoint('H2B1A0');
$Shipment->setCpcPickupIndicator(true);
$Shipment->setExpectedMailingDate(new \DateTime('2016-10-24'));

$DeliverySpec = new DeliverySpecType();
$DeliverySpec->setServiceCode(WebService::$serviceCodes[WebService::SHIPPING_CODE_DOMESTIC_EXPEDITED]);

$Sender = new SenderType();
$Sender->setName('Bulma');
$Sender->setCompany('Capsule Corp.');
$Sender->setContactPhone('1 (514) 820 5879');

$AddressDetails = new AddressDetailsType();
$AddressDetails->setAddressLine1('502 MAIN ST N');
$AddressDetails->setCity('Montréal');
$AddressDetails->setProvState('QC');
$AddressDetails->setCountryCode('CA');
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
$ParcelCharacteristics->setUnpackaged(false);
$ParcelCharacteristics->setMailingTube(false);

$DeliverySpec->setParcelCharacteristics($ParcelCharacteristics);

$Notification = new NotificationType();

$Notification->setEmail('ryuko.saito@kubere.com');
$Notification->setOnShipment(true);
$Notification->setOnException(false);
$Notification->setOnDelivery(true);

$DeliverySpec->setNotification($Notification);

$PrintPreferences = new PrintPreferencesType();
$PrintPreferences->setOutputFormat(PrintPreferencesType::OUTPUT_FORMAT_LETTER);

$DeliverySpec->setPrintPreferences($PrintPreferences);

$Preferences = new PreferencesType();
$Preferences->setShowPackingInstructions(true);
$Preferences->setShowPostageRate(false);
$Preferences->setShowInsuredValue(true);

$DeliverySpec->setPreferences($Preferences);

$References = new ReferencesType();

$References->setCostCentre('ccent');
$References->setCustomerRef1('ML5');
$References->setCustomerRef2('custref2');

$DeliverySpec->setReferences($References);

$SettlementInfo = new SettlementInfoType();
$SettlementInfo->setContractId(CANADA_POST_API_CONTRACT_ID);
$SettlementInfo->setIntendedMethodOfPayment('Account');

$DeliverySpec->setSettlementInfo($SettlementInfo);

$Shipment->setDeliverySpec($DeliverySpec);

// Initiate Canada Post's API
$Shipping = new Shipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to create shipment
$shipmentResponse = $Shipping->createShipment($Shipment);

// Output result for debug
if ($shipmentResponse instanceof ShipmentInfoType) {
    var_dump($shipmentResponse);
} elseif ($shipmentResponse instanceof MessagesType) {
    var_dump($shipmentResponse);
} else {
    throw new \Exception('Unexpected response.');
}
