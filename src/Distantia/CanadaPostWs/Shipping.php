<?php
namespace Distantia\CanadaPostWs;

use Distantia\CanadaPostWs\Type\Common\LinkType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestsType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestType;
use Distantia\CanadaPostWs\Type\Manifest\ShipmentTransmitSetType;
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

        if (null !== $Shipment->getRequestedShippingPoint()) {
            $XmlShipment->addChild('requested-shipping-point', $Shipment->getRequestedShippingPoint());
        }

        if (null !== $Shipment->isCpcPickupIndicator()) {
            $XmlShipment->addChild('cpc-pickup-indicator', ['false', 'true'][(int)$Shipment->isCpcPickupIndicator()]);
        }

        if (null !== $Shipment->getExpectedMailingDate()) {
            $XmlShipment->addChild('expected-mailing-date', $Shipment->getExpectedMailingDate()->format('Y-m-d'));
        }

        $XmlShipmentDeliverySpec = $XmlShipment->addChild('delivery-spec');
        $XmlShipmentDeliverySpec->addChild('service-code', $Shipment->getDeliverySpec()->getServiceCode());

        $XmlShipmentDeliverySpecSender = $XmlShipmentDeliverySpec->addChild('sender');

        if (null !== $Shipment->getDeliverySpec()->getSender()->getName()) {
            $XmlShipmentDeliverySpecSender->addChild('name', $Shipment->getDeliverySpec()->getSender()->getName());
        }

        $XmlShipmentDeliverySpecSender->addChild('company', $Shipment->getDeliverySpec()->getSender()->getCompany());
        $XmlShipmentDeliverySpecSender->addChild('contact-phone', $Shipment->getDeliverySpec()->getSender()->getContactPhone());

        $XmlShipmentDeliverySpecSenderAddressDetails = $XmlShipmentDeliverySpecSender->addChild('address-details');
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('address-line-1', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getAddressLine1());

        if (null !== $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getAddressLine2()) {
            $XmlShipmentDeliverySpecSenderAddressDetails->addChild('address-line-2', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getAddressLine2());
        }

        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('city', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getCity());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('prov-state', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getProvState());
        $XmlShipmentDeliverySpecSenderAddressDetails->addChild('country-code', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getCountryCode());

        if (null !== $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getPostalZipCode()) {
            $XmlShipmentDeliverySpecSenderAddressDetails->addChild('postal-zip-code', $Shipment->getDeliverySpec()->getSender()->getAddressDetails()->getPostalZipCode());
        }

        $XmlShipmentDeliverySpecDestination = $XmlShipmentDeliverySpec->addChild('destination');

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getName()) {
            $XmlShipmentDeliverySpecDestination->addChild('name', $Shipment->getDeliverySpec()->getDestination()->getName());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getCompany()) {
            $XmlShipmentDeliverySpecDestination->addChild('company', $Shipment->getDeliverySpec()->getDestination()->getCompany());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAdditionalAddressInfo()) {
            $XmlShipmentDeliverySpecDestination->addChild('additional-address-info', $Shipment->getDeliverySpec()->getDestination()->getAdditionalAddressInfo());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getClientVoiceNumber()) {
            $XmlShipmentDeliverySpecDestination->addChild('client-voice-number', $Shipment->getDeliverySpec()->getDestination()->getClientVoiceNumber());
        }

        $XmlShipmentDeliverySpecDestinationAddressDetails = $XmlShipmentDeliverySpecDestination->addChild('address-details');

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine1()) {
            $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('address-line-1', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine1());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine2()) {
            $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('address-line-2', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine2());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCity()) {
            $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('city', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCity());
        }

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getProvState()) {
            $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('prov-state', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getProvState());
        }

        $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('country-code', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCountryCode());

        if (null !== $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getPostalZipCode()) {
            $XmlShipmentDeliverySpecDestinationAddressDetails->addChild('postal-zip-code', $Shipment->getDeliverySpec()->getDestination()->getAddressDetails()->getPostalZipCode());
        }

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

        if (null !== $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()) {
            $XmlShipmentDeliverySpecParcelCharacteristicsDimensions = $XmlShipmentDeliverySpecParcelCharacteristics->addChild('dimensions');
            $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('length', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getLength());
            $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('width', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getWidth());
            $XmlShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('height', $Shipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getHeight());
        }

        if (null !== $Shipment->getDeliverySpec()->getParcelCharacteristics()->isUnpackaged()) {
            $XmlShipmentDeliverySpecParcelCharacteristics->addChild('unpackaged', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isUnpackaged()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getParcelCharacteristics()->isMailingTube()) {
            $XmlShipmentDeliverySpecParcelCharacteristics->addChild('mailing-tube', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isMailingTube()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getParcelCharacteristics()->isOversized()) {
            $XmlShipmentDeliverySpecParcelCharacteristics->addChild('oversized', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getParcelCharacteristics()->isOversized()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getNotification()) {
            $XmlShipmentDeliverySpecNotification = $XmlShipmentDeliverySpec->addChild('notification');
            $XmlShipmentDeliverySpecNotification->addChild('email', $Shipment->getDeliverySpec()->getNotification()->getEmail());
            $XmlShipmentDeliverySpecNotification->addChild('on-shipment', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnShipment()]);
            $XmlShipmentDeliverySpecNotification->addChild('on-exception', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnException()]);
            $XmlShipmentDeliverySpecNotification->addChild('on-delivery', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getNotification()->isOnDelivery()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getPrintPreferences()) {
            $XmlShipmentDeliverySpecPrintPreferences = $XmlShipmentDeliverySpec->addChild('print-preferences');

            if (null !== $Shipment->getDeliverySpec()->getPrintPreferences()->getOutputFormat()) {
                $XmlShipmentDeliverySpecPrintPreferences->addChild('output-format', $Shipment->getDeliverySpec()->getPrintPreferences()->getOutputFormat());
            }

            if (null !== $Shipment->getDeliverySpec()->getPrintPreferences()->getEncoding()) {
                $XmlShipmentDeliverySpecPrintPreferences->addChild('encoding', $Shipment->getDeliverySpec()->getPrintPreferences()->getEncoding());
            }
        }

        $XmlShipmentDeliverySpecPreferences = $XmlShipmentDeliverySpec->addChild('preferences');
        $XmlShipmentDeliverySpecPreferences->addChild('show-packing-instructions', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowPackingInstructions()]);

        if (null !== $Shipment->getDeliverySpec()->getPreferences()->isShowPostageRate()) {
            $XmlShipmentDeliverySpecPreferences->addChild('show-postage-rate', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowPostageRate()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getPreferences()->isShowInsuredValue()) {
            $XmlShipmentDeliverySpecPreferences->addChild('show-insured-value', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getPreferences()->isShowInsuredValue()]);
        }

        if (null !== $Shipment->getDeliverySpec()->getReferences()) {
            $XmlShipmentDeliverySpecReferences = $XmlShipmentDeliverySpec->addChild('references');

            if (null !== $Shipment->getDeliverySpec()->getReferences()->getCostCentre()) {
                $XmlShipmentDeliverySpecReferences->addChild('cost-centre', $Shipment->getDeliverySpec()->getReferences()->getCostCentre());
            }

            if (null !== $Shipment->getDeliverySpec()->getReferences()->getCustomerRef1()) {
                $XmlShipmentDeliverySpecReferences->addChild('customer-ref-1', $Shipment->getDeliverySpec()->getReferences()->getCustomerRef1());
            }

            if (null !== $Shipment->getDeliverySpec()->getReferences()->getCustomerRef2()) {
                $XmlShipmentDeliverySpecReferences->addChild('customer-ref-2', $Shipment->getDeliverySpec()->getReferences()->getCustomerRef2());
            }
        }

        if (null !== $Shipment->getDeliverySpec()->getCustoms()) {
            $XmlShipmentDeliverySpecCustoms = $XmlShipmentDeliverySpec->addChild('customs');
            $XmlShipmentDeliverySpecCustoms->addChild('currency', $Shipment->getDeliverySpec()->getCustoms()->getCurrency());

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getConversionFromCad()) {
                $XmlShipmentDeliverySpecCustoms->addChild('conversion-from-cad', $Shipment->getDeliverySpec()->getCustoms()->getConversionFromCad());
            }

            $XmlShipmentDeliverySpecCustoms->addChild('reason-for-export', $Shipment->getDeliverySpec()->getCustoms()->getReasonForExport());

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getOtherReason()) {
                $XmlShipmentDeliverySpecCustoms->addChild('other-reason', $Shipment->getDeliverySpec()->getCustoms()->getOtherReason());
            }

            $SkuList = $Shipment->getDeliverySpec()->getCustoms()->getSkuList();

            if (null !== $SkuList) {
                $XmlShipmentDeliverySpecCustomsSkuList = $XmlShipmentDeliverySpecCustoms->addChild('sku-list');

                if ($SkuList->getItems()) {
                    foreach ($SkuList->getItems() as $Sku) {
                        $XmlShipmentDeliverySpecCustomsSkuListItem = $XmlShipmentDeliverySpecCustomsSkuList->addChild('item');
                        $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('customs-number-of-units', $Sku->getCustomsNumberOfUnits());
                        $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('customs-description', $Sku->getCustomsDescription());

                        if (null != $Sku->getSku()) {
                            $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('sku', $Sku->getSku());
                        }

                        if (null != $Sku->getHsTariffCode()) {
                            $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('hs-tariff-code', $Sku->getHsTariffCode());
                        }

                        $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('unit-weight', $Sku->getUnitWeight());
                        $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('customs-value-per-unit', $Sku->getCustomsValuePerUnit());

                        if (null != $Sku->getCustomsUnitOfMeasure()) {
                            $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('customs-unit-of-measure', $Sku->getCustomsUnitOfMeasure());
                        }

                        if (null != $Sku->getCountryOfOrigin()) {
                            $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('country-of-origin', $Sku->getCountryOfOrigin());
                        }

                        if (null != $Sku->getProvinceOfOrigin()) {
                            $XmlShipmentDeliverySpecCustomsSkuListItem->addChild('province-of-origin', $Sku->getProvinceOfOrigin());
                        }
                    }
                }
            }

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getDutiesAndTaxesPrepaid()) {
                $XmlShipmentDeliverySpecCustoms->addChild('duties-and-taxes-prepaid', $Shipment->getDeliverySpec()->getCustoms()->getDutiesAndTaxesPrepaid());
            }

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getCertificateNumber()) {
                $XmlShipmentDeliverySpecCustoms->addChild('certificate-number', $Shipment->getDeliverySpec()->getCustoms()->getCertificateNumber());
            }

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getLicenceNumber()) {
                $XmlShipmentDeliverySpecCustoms->addChild('licence-number', $Shipment->getDeliverySpec()->getCustoms()->getLicenceNumber());
            }

            if (null !== $Shipment->getDeliverySpec()->getCustoms()->getInvoiceNumber()) {
                $XmlShipmentDeliverySpecCustoms->addChild('invoice-number', $Shipment->getDeliverySpec()->getCustoms()->getInvoiceNumber());
            }

        }

        $XmlShipmentDeliverySpecSettlementInfo = $XmlShipmentDeliverySpec->addChild('settlement-info');

        if (null !== $Shipment->getDeliverySpec()->getSettlementInfo()->getPaidByCustomer()) {
            $XmlShipmentDeliverySpecSettlementInfo->addChild('paid-by-customer', $Shipment->getDeliverySpec()->getSettlementInfo()->getPaidByCustomer());
        }

        if (null !== $Shipment->getDeliverySpec()->getSettlementInfo()->getContractId()) {
            $XmlShipmentDeliverySpecSettlementInfo->addChild('contract-id', $Shipment->getDeliverySpec()->getSettlementInfo()->getContractId());
        }

        if (true === $Shipment->getDeliverySpec()->getSettlementInfo()->isCifShipment()) {
            $XmlShipmentDeliverySpecSettlementInfo->addChild('cif-shipment', ['false', 'true'][(int)$Shipment->getDeliverySpec()->getSettlementInfo()->isCifShipment()]);
        }

        $XmlShipmentDeliverySpecSettlementInfo->addChild('intended-method-of-payment', $Shipment->getDeliverySpec()->getSettlementInfo()->getIntendedMethodOfPayment());

        if (null !== $Shipment->getReturnSpec()) {
            $XmlShipmentReturnSpec = $XmlShipment->addChild('return-spec');
            $XmlShipmentReturnSpec->addChild('service-code', $Shipment->getReturnSpec()->getServiceCode());

            $XmlShipmentReturnSpecReturnRecipient = $XmlShipmentReturnSpec->addChild('return-recipient');

            if (null !== $Shipment->getReturnSpec()->getReturnRecipient()->getName()) {
                $XmlShipmentReturnSpecReturnRecipient->addChild('name', $Shipment->getReturnSpec()->getReturnRecipient()->getName());
            }

            if (null !== $Shipment->getReturnSpec()->getReturnRecipient()->getCompany()) {
                $XmlShipmentReturnSpecReturnRecipient->addChild('company', $Shipment->getReturnSpec()->getReturnRecipient()->getCompany());
            }

            $XmlShipmentReturnSpecReturnRecipientAddressDetails = $XmlShipmentReturnSpecReturnRecipient->addChild('address-details');
            $XmlShipmentReturnSpecReturnRecipientAddressDetails->addChild('address-line-1', $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getAddressLine1());

            if (null !== $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getAddressLine2()) {
                $XmlShipmentReturnSpecReturnRecipientAddressDetails->addChild('address-line-2', $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getAddressLine2());
            }

            $XmlShipmentReturnSpecReturnRecipientAddressDetails->addChild('city', $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getCity());
            $XmlShipmentReturnSpecReturnRecipientAddressDetails->addChild('prov-state', $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getProvState());
            $XmlShipmentReturnSpecReturnRecipientAddressDetails->addChild('postal-zip-code', $Shipment->getReturnSpec()->getReturnRecipient()->getAddressDetails()->getPostalZipCode());

            if (null !== $Shipment->getReturnSpec()->getReturnNotification()) {
                $XmlShipmentReturnSpec->addChild('return-notification', $Shipment->getReturnSpec()->getReturnNotification());
            }
        }

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

    /**
     * @param ShipmentTransmitSetType $ShipmentTransmitSet
     * @return ManifestsType
     */
    public function transmitShipments(ShipmentTransmitSetType $ShipmentTransmitSet)
    {
        $XmlTransmitSet = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transmit-set xmlns="http://www.canadapost.ca/ws/manifest-v'.self::API_VERSION.'"/>');

        $XmlTransmitSetGroupIds = $XmlTransmitSet->addChild('group-ids');
        if (null !== $ShipmentTransmitSet->getGroupIds()) {
            foreach ($ShipmentTransmitSet->getGroupIds() as $GroupId) {
                $XmlTransmitSetGroupIds->addChild('group-id', $GroupId->getGroupId());
            }
        }

        if (true === $ShipmentTransmitSet->isCpcPickupIndicator()) {
            $XmlTransmitSet->addChild('cpc-pickup-indicator', ['false', 'true'][(int)$ShipmentTransmitSet->isCpcPickupIndicator()]);
        }

        $XmlTransmitSet->addChild('requested-shipping-point', $ShipmentTransmitSet->getRequestedShippingPoint());

        if (null !== $ShipmentTransmitSet->getShippingPointId()) {
            $XmlTransmitSet->addChild('shipping-point-id', $ShipmentTransmitSet->getShippingPointId());
        }

        $XmlTransmitSet->addChild('detailed-manifests', ['false', 'true'][(int)$ShipmentTransmitSet->isDetailedManifests()]);
        $XmlTransmitSet->addChild('method-of-payment', $ShipmentTransmitSet->getMethodOfPayment());

        if (null !== $ShipmentTransmitSet->getManifestAddress()) {
            $XmlTransmitSetManifestAddress = $XmlTransmitSet->addChild('manifest-address');

            $XmlTransmitSetManifestAddress->addChild('manifest-company', $ShipmentTransmitSet->getManifestAddress()->getManifestCompany());

            if (null !== $ShipmentTransmitSet->getManifestAddress()->getManifestName()) {
                $XmlTransmitSetManifestAddress->addChild('manifest-name', $ShipmentTransmitSet->getManifestAddress()->getManifestName());
            }

            $XmlTransmitSetManifestAddress->addChild('phone-number', $ShipmentTransmitSet->getManifestAddress()->getPhoneNumber());

            if (null !== $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()) {
                $XmlTransmitSetManifestAddressAddressDetails = $XmlTransmitSetManifestAddress->addChild('address-details');
                $XmlTransmitSetManifestAddressAddressDetails->addChild('address-line-1', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getAddressLine1());

                if (null !== $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getAddressLine2()) {
                    $XmlTransmitSetManifestAddressAddressDetails->addChild('address-line-2', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getAddressLine2());
                }

                $XmlTransmitSetManifestAddressAddressDetails->addChild('city', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getCity());
                $XmlTransmitSetManifestAddressAddressDetails->addChild('prov-state', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getProvState());

                if (null !== $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getCountryCode()) {
                    $XmlTransmitSetManifestAddressAddressDetails->addChild('country-code', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getCountryCode());
                }

                $XmlTransmitSetManifestAddressAddressDetails->addChild('postal-zip-code', $ShipmentTransmitSet->getManifestAddress()->getAddressDetails()->getPostalZipCode());
            }
        }

        if (null !== $ShipmentTransmitSet->getCustomerReference()) {
            $XmlTransmitSet->addChild('customer-references', $ShipmentTransmitSet->getCustomerReference());
        }

        if (null !== $ShipmentTransmitSet->getExcludedShipments()) {
            $XmlTransmitSetExcludedShipments = $XmlTransmitSet->addChild('excluded-shipments');

            foreach ($ShipmentTransmitSet->getExcludedShipments() as $ExcludedShipment) {
                $XmlTransmitSetExcludedShipments->addChild('shipment-id', $ExcludedShipment->getShipmentId());
            }
        }

        $request = $XmlTransmitSet->asXML();

        $response = $this->processRequest([
            'request_url' => '/manifest',
            'headers' => [
                'Content-Type: application/vnd.cpc.manifest-v'.self::API_VERSION.'+xml',
                'Accept: application/vnd.cpc.manifest-v'.self::API_VERSION.'+xml',
            ],
            'request' => $request,
        ]);

        $responseXML = new SimpleXMLElement($response);

        echo '<p><strong>Dump--Start</strong></p>';
        var_dump($responseXML);
        echo '<p><strong>Dump--End</strong></p>';
        exit;

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
            case 'messages':
                return $this->getMessagesType($responseXML);
                break;
            default:
                return false;
                break;
        }
    }
}