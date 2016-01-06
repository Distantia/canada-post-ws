<?php
namespace Distantia\CanadaPostWs\Type\Manifest;

class ShipmentTransmitSetType
{
    /**
     * @var GroupIDListType[]
     * name="group-ids" type="GroupIDListType"
     */
    protected $groupIds = [];

    /**
     * @var bool
     * name="cpc-pickup-indicator" type="xsd:boolean" fixed="true" minOccurs="0"
     */
    protected $cpcPickupIndicator;

    /**
     * @var string
     * name="requested-shipping-point" type="PostalCodeType" minOccurs="0"
     */
    protected $requestedShippingPoint;

    /**
     * @var string
     * name="shipping-point-id" type="OutletIDType" minOccurs="0"
     */
    protected $shippingPointId;

    /**
     * @var bool
     * name="detailed-manifests" type="xsd:boolean"
     */
    protected $detailedManifests;

    /**
     * @var string
     * name="method-of-payment" type="MethodOfPaymentType"
     */
    protected $methodOfPayment;

    /**
     * @var ManifestAddressType
     * name="manifest-address" type="ManifestAddressType"
     */
    protected $manifestAddress;

    /**
     * @var string
     * name="customer-reference" type="CustomerReferenceType" minOccurs="0"
     */
    protected $customerReference;

    /**
     * @var ExcludedShipmentsType[]
     * name="excluded-shipments" type="ExcludedShipmentsType" minOccurs="0"
     */
    protected $excludedShipments;

    /**
     * @return GroupIDListType[]
     */
    public function getGroupIds()
    {
        return $this->groupIds;
    }

    /**
     * @param GroupIDListType[] $groupIds
     * @return ShipmentTransmitSetType
     */
    public function setGroupIds($groupIds)
    {
        $this->groupIds = $groupIds;

        return $this;
    }

    /**
     * @param GroupIDListType $groupId
     * @return ManifestsType
     */
    public function addGroupId($groupId)
    {
        $this->groupIds[] = $groupId;

        return $this;
    }

    /**
     * @return ExcludedShipmentsType[]
     */
    public function getExcludedShipments()
    {
        return $this->excludedShipments;
    }

    /**
     * @param ExcludedShipmentsType[] $excludedShipments
     * @return ShipmentTransmitSetType
     */
    public function setExcludedShipments($excludedShipments)
    {
        $this->excludedShipments = $excludedShipments;

        return $this;
    }

    /**
     * @param ExcludedShipmentsType $excludedShipment
     * @return ManifestsType
     */
    public function addExcludedShipment($excludedShipment)
    {
        $this->excludedShipments[] = $excludedShipment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isCpcPickupIndicator()
    {
        return $this->cpcPickupIndicator;
    }

    /**
     * @param boolean $cpcPickupIndicator
     * @return ShipmentTransmitSetType
     */
    public function setCpcPickupIndicator($cpcPickupIndicator)
    {
        $this->cpcPickupIndicator = $cpcPickupIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestedShippingPoint()
    {
        return $this->requestedShippingPoint;
    }

    /**
     * @param string $requestedShippingPoint
     * @return ShipmentTransmitSetType
     */
    public function setRequestedShippingPoint($requestedShippingPoint)
    {
        $this->requestedShippingPoint = $requestedShippingPoint;

        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPointId()
    {
        return $this->shippingPointId;
    }

    /**
     * @param string $shippingPointId
     * @return ShipmentTransmitSetType
     */
    public function setShippingPointId($shippingPointId)
    {
        $this->shippingPointId = $shippingPointId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDetailedManifests()
    {
        return $this->detailedManifests;
    }

    /**
     * @param boolean $detailedManifests
     * @return ShipmentTransmitSetType
     */
    public function setDetailedManifests($detailedManifests)
    {
        $this->detailedManifests = $detailedManifests;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethodOfPayment()
    {
        return $this->methodOfPayment;
    }

    /**
     * @param string $methodOfPayment
     * @return ShipmentTransmitSetType
     */
    public function setMethodOfPayment($methodOfPayment)
    {
        $this->methodOfPayment = $methodOfPayment;

        return $this;
    }

    /**
     * @return ManifestAddressType
     */
    public function getManifestAddress()
    {
        return $this->manifestAddress;
    }

    /**
     * @param ManifestAddressType $manifestAddress
     * @return ShipmentTransmitSetType
     */
    public function setManifestAddress($manifestAddress)
    {
        $this->manifestAddress = $manifestAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customerReference;
    }

    /**
     * @param string $customerReference
     * @return ShipmentTransmitSetType
     */
    public function setCustomerReference($customerReference)
    {
        $this->customerReference = $customerReference;

        return $this;
    }


}