<?php
namespace Distantia\CanadaPostWs;

use Distantia\CanadaPostWs\Type\Common\LinkType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestsType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\Shipment\ShipmentInfoType;
use Distantia\CanadaPostWs\Type\Shipment\ShipmentType;
use SimpleXMLElement;

class Shipping extends WebService
{
    const API_VERSION = 7;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $mailedBy = $this->options['api_customer_number'];
        $mobo = $this->options['api_customer_number'];

        $this->requestUrl .= '/'.$mailedBy.'/'.$mobo;
    }

    /**
     * @param ShipmentType $Shipment
     * @return bool|MessagesType|ShipmentInfoType
     */
    public function createShipment(ShipmentType $Shipment)
    {
        $XmlShipment = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><shipment xmlns="http://www.canadapost.ca/ws/shipment-v'.self::API_VERSION.'"/>');

        if (null !== $Shipment->getGroupId()) {
            $XmlShipment->addChild('group-id', $Shipment->getGroupId());
        } else {
            $XmlShipment->addChild('transmit-shipment', ['false', 'true'][(int)$Shipment->isTransmitShipment()]);
        }

        if (null !== $Shipment->isQuickshipLabelRequested()) {
            $XmlShipment->addChild('quickship-label-requested', ['false', 'true'][(int)$Shipment->isQuickshipLabelRequested()]);
        }

        $XmlShipment->addChild('requested-shipping-point', $Shipment->getRequestedShippingPoint());
        $XmlShipment->addChild('cpc-pickup-indicator', ['false', 'true'][(int)$Shipment->isCpcPickupIndicator()]);
        $XmlShipment->addChild('expected-mailing-date', $Shipment->getExpectedMailingDate()->format('Y-m-d'));

        $XmlShipmentDeliverySpec = $XmlShipment->addChild('delivery-spec');
        $XmlShipmentDeliverySpec->addChild('service-code', $Shipment->getDeliverySpec()->getServiceCode());

        $XmlShipmentDeliverySpecSender = $XmlShipmentDeliverySpec->addChild('sender');
        $XmlShipmentDeliverySpecSender->addChild('name', $Shipment->getDeliverySpec()->getSender()->getName());
        $XmlShipmentDeliverySpecSender->addChild('company', $Shipment->getDeliverySpec()->getSender()->getCompany());
        $XmlShipmentDeliverySpecSender->addChild('contact-phone', $Shipment->getDeliverySpec()->getSender()->getContactPhone());

        $XmlShipmentDeliverySpecSenderAddressDetails = $XmlShipmentDeliverySpecSender->addChild('address-details');
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('address-line-1', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getAddressLine1());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('city', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getCity());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('prov-state', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getProvState());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('country-code', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getCountryCode());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('postal-zip-code', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getPostalZipCode());

        $XmlShipmentDeliverySpecDestination = $XmlShipmentDeliverySpec->addChild('destination');
        $XmlShipmentDeliverySpecDestination->addChild('name', $Shipment->getDeliverySpec()->getDestination()->getName());
        $XmlShipmentDeliverySpecDestination->addChild('company', $Shipment->getDeliverySpec()->getDestination()->getCompany());

        $XmlShipmentDeliverySpecDestinationAddressDetails = $XmlShipmentDeliverySpecDestination->addChild('address-details');
        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('address-line-1', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine1());
        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('city', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCity());
        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('prov-state', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getProvState());
        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('country-code', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCountryCode());
        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('postal-zip-code', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getPostalZipCode());

        $OptionsList = $Shipment->getDeliverySpec()->getOptions();

        if ($OptionsList) {
            $Options = $OptionsList->getOptions();

            if ($Options) {
                $XmlShipmentDeliverySpecOptions = $XmlShipmentDeliverySpec->addChild('options');

                foreach ($Options as $Option) {
                    $XmlShipmentDeliverySpecOptionsOption = $XmlShipmentDeliverySpecOptions->addChild('option');
                    $XmlShipmentDeliverySpecOptionsOption->addChild('option-code', $Option->getOptionCode());

                    if (null !== $Option->getOptionAmount()) {
                        $XmlShipmentDeliverySpecOptionsOption->addChild('option-amount', number_format($Option->getOptionAmount(), 2, '.', ''));
                    }

                    if (null !== $Option->isOptionQualifier1()) {
                        $XmlShipmentDeliverySpecOptionsOption->addChild('option-qualifier-1', ['false', 'true'][(int)$Option->isOptionQualifier1()]);
                    }

                    if (null !== $Option->getOptionQualifier2()) {
                        $XmlShipmentDeliverySpecOptionsOption->addChild('option-amount', $Option->getOptionQualifier2());
                    }
                }
            }
        }

        $XmlShipmentDeliverySpecParcelCharacteristics = $XmlShipmentDeliverySpec->addChild('parcel-characteristics');
        $XmlShipmentDeliverySpecParcelCharacteristics->addChild('weight', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getWeight());

        $XmlShipmentDeliverySpecParcelCharacteristicsDimensions = $XmlShipmentDeliverySpecParcelCharacteristics->addChild('dimensions');
        $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('length', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getLength());
        $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('width', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getWidth());
        $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('height', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getHeight());

        $XmlShipmentDeliverySpecParcelCharacteristics->addChild('unpackaged', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isUnpackaged()]);
        $XmlShipmentDeliverySpecParcelCharacteristics->addChild('mailing-tube', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isMailingTube()]);
        $XmlShipmentDeliverySpecParcelCharacteristics->addChild('oversized', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isOversized()]);

        $XmlShipmentDeliverySpecNotification = $XmlShipmentDeliverySpec->addChild('notification');
        $XmlShipmentDeliverySpecNotification->addChild('email', $Shipment->getDeliverySpec()->getNotification()->getEmail());
        $XmlShipmentDeliverySpecNotification->addChild('on-shipment', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnShipment()]);
        $XmlShipmentDeliverySpecNotification->addChild('on-exception', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnException()]);
        $XmlShipmentDeliverySpecNotification->addChild('on-delivery', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnDelivery()]);

        $XmlShipmentDeliverySpecPrintPreferences = $XmlShipmentDeliverySpec->addChild('print-preferences');

        if (null !== $Shipment->getDeliverySpec()->getPrintPreferences()->getOutputFormat()) {
            $XmlShipmentDeliverySpecPrintPreferences->addChild('output-format', $Shipment->getDeliverySpec()->getPrintPreferences()->getOutputFormat());
        }

        if (null !== $Shipment->getDeliverySpec()->getPrintPreferences()->getEncoding()) {
            $XmlShipmentDeliverySpecPrintPreferences->addChild('encoding', $Shipment->getDeliverySpec()->getPrintPreferences()->getEncoding());
        }

        $XmlShipmentDeliverySpecPreferences = $XmlShipmentDeliverySpec->addChild('preferences');
        $XmlShipmentDeliverySpecPreferences->addChild('show-packing-instructions', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowPackingInstructions()]);
        $XmlShipmentDeliverySpecPreferences->addChild('show-postage-rate', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowPostageRate()]);
        $XmlShipmentDeliverySpecPreferences->addChild('show-insured-value', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowInsuredValue()]);

        $XmlShipmentDeliverySpecReferences = $XmlShipmentDeliverySpec->addChild('references');
        $XmlShipmentDeliverySpecReferences->addChild('cost-centre', $Shipment->getDeliverySpec()->getReferences()->getCostCentre());
        $XmlShipmentDeliverySpecReferences->addChild('customer-ref-1', $Shipment->getDeliverySpec()->getReferences()->getCustomerRef1());
        $XmlShipmentDeliverySpecReferences->addChild('customer-ref-2', $Shipment->getDeliverySpec()->getReferences()->getCustomerRef2());

        $XmlShipmentDeliverySpecSettlementInfo = $XmlShipmentDeliverySpec->addChild('settlement-info');
        $XmlShipmentDeliverySpecSettlementInfo->addChild('contract-id', $Shipment->getDeliverySpec()->getSettlementInfo()->getContractId());
        $XmlShipmentDeliverySpecSettlementInfo->addChild('intended-method-of-payment', $Shipment->getDeliverySpec()->getSettlementInfo()->getIntendedMethodOfPayment());

        $request = $XmlShipment->asXML();

        $response = $this->processRequest([
            'request_url' => '/shipment',
            'headers' => [
                'Content-Type: application/vnd.cpc.shipment-v'.self::API_VERSION.'+xml',
                'Accept: application/vnd.cpc.shipment-v'.self::API_VERSION.'+xml',
            ],
            'request' => $request,
        ]);

        $responseXML = new SimpleXMLElement($response);

        switch ($responseXML->getName()) {
            case 'shipment-info':
                $ShipmentInfoType = new ShipmentInfoType();

                $ShipmentInfoType->setShipmentId((string)$responseXML->{'shipment-id'});
                $ShipmentInfoType->setShipmentStatus((string)$responseXML->{'shipment-status'});
                $ShipmentInfoType->setTrackingPin((string)$responseXML->{'tracking-pin'});

                if ($responseXML->{'links'}->link) {
                    foreach ($responseXML->{'links'}->link as $link) {
                        $LinkType = new LinkType();

                        $LinkType->setHref((string)$link['href']);
                        $LinkType->setRel((string)$link['rel']);
                        $LinkType->setMediaType((string)$link['media-type']);

                        if (isset($link['index'])) {
                            $LinkType->setIndex((string)$link['index']);
                        }

                        $ShipmentInfoType->addLink($LinkType);
                    }
                }

                return $ShipmentInfoType;
                break;
            case 'messages':
                return $this->getMessagesType($responseXML);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param int $id
     * @return bool|MessagesType|ShipmentInfoType
     */
    public function getShipment($id)
    {
        $response = $this->processRequest([
            'request_url' => '/shipment/'.$id,
            'headers' => [
                'Accept: application/vnd.cpc.shipment-v'.self::API_VERSION.'+xml',
            ],
        ]);

        $responseXML = new SimpleXMLElement($response);

        switch ($responseXML->getName()) {
            case 'shipment-info':
                $ShipmentInfoType = new ShipmentInfoType();

                $ShipmentInfoType->setShipmentId((string)$responseXML->{'shipment-id'});
                $ShipmentInfoType->setShipmentStatus((string)$responseXML->{'shipment-status'});
                $ShipmentInfoType->setTrackingPin((string)$responseXML->{'tracking-pin'});

                if ($responseXML->{'links'}->link) {
                    foreach ($responseXML->{'links'}->link as $link) {
                        $LinkType = new LinkType();

                        $LinkType->setHref((string)$link['href']);
                        $LinkType->setRel((string)$link['rel']);
                        $LinkType->setMediaType((string)$link['media-type']);

                        if (isset($link['index'])) {
                            $LinkType->setIndex((string)$link['index']);
                        }

                        $ShipmentInfoType->addLink($LinkType);
                    }
                }

                return $ShipmentInfoType;
                break;
            case 'messages':
                return $this->getMessagesType($responseXML);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param \DateTime|null $start
     * @param \DateTime|null $end
     * @return bool|ManifestsType|MessagesType
     */
    public function getManifests(\DateTime $start = null, \DateTime $end = null)
    {
        $queryStr = [];

        if ($start) {
            $queryStr['start'] = $start->format('Ymd');
        }

        if ($end) {
            $queryStr['end'] = $end->format('Ymd');
        }

        $requestQueryStr = http_build_query($queryStr);

        $response = $this->processRequest([
            'request_url' => '/manifest?'.$requestQueryStr,
            'headers' => [
                'Accept: application/vnd.cpc.manifest-v'.self::API_VERSION.'+xml',
            ],
        ]);

        $responseXML = new SimpleXMLElement($response);

        switch ($responseXML->getName()) {
            case 'manifests':
                $ManifestsType = new ManifestsType();

                if ($responseXML->link) {
                    foreach ($responseXML->link as $link) {
                        $LinkType = new LinkType();

                        $LinkType->setHref((string)$link['href']);
                        $LinkType->setRel((string)$link['rel']);
                        $LinkType->setMediaType((string)$link['media-type']);

                        if (isset($link['index'])) {
                            $LinkType->setIndex((string)$link['index']);
                        }

                        $ManifestsType->addLink($LinkType);
                    }
                }

                return $ManifestsType;
                break;
            case 'messages':
                return $this->getMessagesType($responseXML);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param int $id
     * @return ShipmentInfoType
     */
    public function getManifest($id)
    {
        $response = $this->processRequest([
            'request_url' => '/manifest/'.$id,
            'headers' => [
                'Accept: application/vnd.cpc.manifest-v'.self::API_VERSION.'+xml',
            ],
        ]);

        $responseXML = new SimpleXMLElement($response);

        switch ($responseXML->getName()) {
            case 'manifest':
                $ManifestType = new ManifestType();

                $ManifestType->setPoNumber((string)$responseXML->{'po-number'});

                if ($responseXML->{'links'}->link) {
                    foreach ($responseXML->{'links'}->link as $link) {
                        $LinkType = new LinkType();

                        $LinkType->setHref((string)$link['href']);
                        $LinkType->setRel((string)$link['rel']);
                        $LinkType->setMediaType((string)$link['media-type']);

                        if (isset($link['index'])) {
                            $LinkType->setIndex((string)$link['index']);
                        }

                        $ManifestType->addLink($LinkType);
                    }
                }

                return $ManifestType;
                break;
            case 'messages':
                return $this->getMessagesType($responseXML);
                break;
            default:
                return false;
                break;
        }
    }
}