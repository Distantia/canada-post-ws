<?php
namespace Distantia\CanadaPostWs;

use Distantia\CanadaPostWs\Type\Common\LinkType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\NcShipment\NonContractShipmentInfoType;
use Distantia\CanadaPostWs\Type\NcShipment\NonContractShipmentType;
use SimpleXMLElement;

class NcShipping extends WebService
{
    const API_VERSION = '4';

    /**
     * WebService constructor.
     * @param array $options
     * @throws \Exception
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $mailedBy = $this->options['api_customer_number'];

        $this->requestUrl .= '/'.$mailedBy;
    }

    /**
     * @param NonContractShipmentType $NcShipment
     * @return bool|MessagesType|NonContractShipmentInfoType
     */
    public function createNcShipment(NonContractShipmentType $NcShipment)
    {
        $XmlNonContractShipment = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><non-contract-shipment xmlns="http://www.canadapost.ca/ws/ncshipment-v'.self::API_VERSION.'"/>');
        $XmlNonContractShipment->addChild('requested-shipping-point', $NcShipment->getRequestedShippingPoint());

        $XmlNonContractShipmentDeliverySpec = $XmlNonContractShipment->addChild('delivery-spec');
        $XmlNonContractShipmentDeliverySpec->addChild('service-code', $NcShipment->getDeliverySpec()->getServiceCode());

        $XmlNonContractShipmentDeliverySpecSender = $XmlNonContractShipmentDeliverySpec->addchild('sender');
        $XmlNonContractShipmentDeliverySpecSender->addChild('name', $NcShipment->getDeliverySpec()->getSender()->getName());
        $XmlNonContractShipmentDeliverySpecSender->addChild('company', $NcShipment->getDeliverySpec()->getSender()->getCompany());
        $XmlNonContractShipmentDeliverySpecSender->addChild('contact-phone', $NcShipment->getDeliverySpec()->getSender()->getContactPhone());

        $XmlNonContractShipmentDeliverySpecSenderAddressDetails = $XmlNonContractShipmentDeliverySpecSender->addChild('address-details');
        $XmlNonContractShipmentDeliverySpecSenderAddressDetails->addChild('address-line-1', $NcShipment->getDeliverySpec()->getSender()->getAddressDetails()->getAddressLine1());
        $XmlNonContractShipmentDeliverySpecSenderAddressDetails->addChild('city', $NcShipment->getDeliverySpec()->getSender()->getAddressDetails()->getCity());
        $XmlNonContractShipmentDeliverySpecSenderAddressDetails->addChild('prov-state', $NcShipment->getDeliverySpec()->getSender()->getAddressDetails()->getProvState());
        $XmlNonContractShipmentDeliverySpecSenderAddressDetails->addChild('postal-zip-code', $NcShipment->getDeliverySpec()->getSender()->getAddressDetails()->getPostalZipCode());

        $XmlNonContractShipmentDeliverySpecDestination = $XmlNonContractShipmentDeliverySpec->addChild('destination');
        $XmlNonContractShipmentDeliverySpecDestination->addChild('name', $NcShipment->getDeliverySpec()->getDestination()->getName());
        $XmlNonContractShipmentDeliverySpecDestination->addChild('company', $NcShipment->getDeliverySpec()->getDestination()->getCompany());

        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails = $XmlNonContractShipmentDeliverySpecDestination->addChild('address-details');
        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails->addChild('address-line-1', $NcShipment->getDeliverySpec()->getDestination()->getAddressDetails()->getAddressLine1());
        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails->addChild('city', $NcShipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCity());
        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails->addChild('prov-state', $NcShipment->getDeliverySpec()->getDestination()->getAddressDetails()->getProvState());
        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails->addChild('country-code', $NcShipment->getDeliverySpec()->getDestination()->getAddressDetails()->getCountryCode());
        $XmlNonContractShipmentDeliverySpecDestinationAddressDetails->addChild('postal-zip-code', $NcShipment->getDeliverySpec()->getDestination()->getAddressDetails()->getPostalZipCode());

        $OptionsList = $NcShipment->getDeliverySpec()->getOptions();

        if ($OptionsList) {
            $Options = $OptionsList->getOptions();

            if ($Options) {
                $XmlNonContractShipmentDeliverySpecOptions = $XmlNonContractShipmentDeliverySpec->addChild('options');

                foreach ($Options as $Option) {
                    $XmlNonContractShipmentDeliverySpecOptionsOption = $XmlNonContractShipmentDeliverySpecOptions->addChild('option');
                    $XmlNonContractShipmentDeliverySpecOptionsOption->addChild('option-code', $Option->getOptionCode());

                    if (null !== $Option->getOptionAmount()) {
                        $XmlNonContractShipmentDeliverySpecOptionsOption->addChild('option-amount', number_format($Option->getOptionAmount(), 2, '.', ''));
                    }

                    if (null !== $Option->isOptionQualifier1()) {
                        $XmlNonContractShipmentDeliverySpecOptionsOption->addChild('option-qualifier-1', ['false', 'true'][(int)$Option->isOptionQualifier1()]);
                    }

                    if (null !== $Option->getOptionQualifier2()) {
                        $XmlNonContractShipmentDeliverySpecOptionsOption->addChild('option-amount', $Option->getOptionQualifier2());
                    }
                }
            }
        }

        $XmlNonContractShipmentDeliverySpecParcelCharacteristics = $XmlNonContractShipmentDeliverySpec->addChild('parcel-characteristics');
        $XmlNonContractShipmentDeliverySpecParcelCharacteristics->addChild('weight', $NcShipment->getDeliverySpec()->getParcelCharacteristics()->getWeight());

        $XmlNonContractShipmentDeliverySpecParcelCharacteristicsDimensions = $XmlNonContractShipmentDeliverySpecParcelCharacteristics->addChild('dimensions');
        $XmlNonContractShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('length', $NcShipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getLength());
        $XmlNonContractShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('width', $NcShipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getWidth());
        $XmlNonContractShipmentDeliverySpecParcelCharacteristicsDimensions->addChild('height', $NcShipment->getDeliverySpec()->getParcelCharacteristics()->getDimensions()->getHeight());

        $XmlNonContractShipmentDeliverySpecPreferences = $XmlNonContractShipmentDeliverySpec->addChild('preferences');
        $XmlNonContractShipmentDeliverySpecPreferences->addChild('show-packing-instructions', ['false', 'true'][(int)$NcShipment->getDeliverySpec()->getPreferences()->isShowPackingInstructions()]);
        $XmlNonContractShipmentDeliverySpecPreferences->addChild('show-postage-rate', ['false', 'true'][(int)$NcShipment->getDeliverySpec()->getPreferences()->isShowPostageRate()]);
        $XmlNonContractShipmentDeliverySpecPreferences->addChild('show-insured-value', ['false', 'true'][(int)$NcShipment->getDeliverySpec()->getPreferences()->isShowInsuredValue()]);

        $XmlNonContractShipmentDeliverySpecReferences = $XmlNonContractShipmentDeliverySpec->addChild('references');
        $XmlNonContractShipmentDeliverySpecReferences->addChild('cost-centre', $NcShipment->getDeliverySpec()->getReferences()->getCostCentre());
        $XmlNonContractShipmentDeliverySpecReferences->addChild('customer-ref-1', $NcShipment->getDeliverySpec()->getReferences()->getCustomerRef1());
        $XmlNonContractShipmentDeliverySpecReferences->addChild('customer-ref-2', $NcShipment->getDeliverySpec()->getReferences()->getCustomerRef2());

        $request = $XmlNonContractShipment->asXML();

        $response = $this->processRequest([
            'request_url' => '/ncshipment',
            'headers' => [
                'Content-Type: application/vnd.cpc.ncshipment-v'.self::API_VERSION.'+xml',
                'Accept: application/vnd.cpc.ncshipment-v'.self::API_VERSION.'+xml',
            ],
            'request' => $request,
        ]);

        $responseXML = new SimpleXMLElement($response);

        switch ($responseXML->getName()) {
            case 'non-contract-shipment-info':
                $NonContractShipmentInfoType = new NonContractShipmentInfoType();

                $NonContractShipmentInfoType->setShipmentId((string)$responseXML->{'shipment-id'});
                $NonContractShipmentInfoType->setTrackingPin((string)$responseXML->{'tracking-pin'});

                if ($responseXML->{'links'}->link) {
                    foreach ($responseXML->{'links'}->link as $link) {
                        $LinkType = new LinkType();

                        $LinkType->setHref((string)$link['href']);
                        $LinkType->setRel((string)$link['rel']);
                        $LinkType->setMediaType((string)$link['media-type']);

                        if (isset($link['index'])) {
                            $LinkType->setIndex((string)$link['index']);
                        }

                        $NonContractShipmentInfoType->addLink($LinkType);
                    }
                }

                return $NonContractShipmentInfoType;
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