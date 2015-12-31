<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class ShipmentType
{
    /**
     * @var string
     * name="group-id" type="GroupIDType" substitutionGroup="groupIdOrTransmitShipment"
     */
    protected $groupId;

    /**
     * @var bool
     * name="transmit-shipment" type="xsd:boolean" fixed="true" substitutionGroup="groupIdOrTransmitShipment"
     */
    protected $transmitShipment;

    /**
     * @var bool
     * name="quickship-label-requested" type="xsd:boolean" minOccurs="0"
     */
    protected $quickshipLabelRequested;

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
     * @var \DateTime
     * name="expected-mailing-date" type="xsd:date" minOccurs="0"
     */
    protected $expectedMailingDate;

    /**
     * @var DeliverySpecType
     * name="delivery-spec" type="DeliverySpecType"
     */
    protected $deliverySpec;

    /**
     * @var ReturnSpecType
     * name="return-spec" type="ReturnSpecType" minOccurs="0"
     */
    protected $returnSpec;

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param string $groupId
     * @return ShipmentType
     * @throws \Exception
     */
    public function setGroupId($groupId)
    {
        if (null !== $this->transmitShipment) {
            throw new \Exception('Group id cannot be set when transmit shipment is set.');
        }

        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isTransmitShipment()
    {
        return $this->transmitShipment;
    }

    /**
     * @param boolean $transmitShipment
     * @return ShipmentType
     * @throws \Exception
     */
    public function setTransmitShipment($transmitShipment)
    {
        if (null !== $this->transmitShipment) {
            throw new \Exception('Transmit shipment cannot be set when group id is set.');
        }

        $this->transmitShipment = $transmitShipment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isQuickshipLabelRequested()
    {
        return $this->quickshipLabelRequested;
    }

    /**
     * @param boolean $quickshipLabelRequested
     * @return ShipmentType
     */
    public function setQuickshipLabelRequested($quickshipLabelRequested)
    {
        $this->quickshipLabelRequested = $quickshipLabelRequested;

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
     * @return ShipmentType
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
     * @return ShipmentType
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
     * @return ShipmentType
     */
    public function setShippingPointId($shippingPointId)
    {
        $this->shippingPointId = $shippingPointId;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpectedMailingDate()
    {
        return $this->expectedMailingDate;
    }

    /**
     * @param \DateTime $expectedMailingDate
     * @return ShipmentType
     */
    public function setExpectedMailingDate($expectedMailingDate)
    {
        $this->expectedMailingDate = $expectedMailingDate;

        return $this;
    }

    /**
     * @return DeliverySpecType
     */
    public function getDeliverySpec()
    {
        return $this->deliverySpec;
    }

    /**
     * @param DeliverySpecType $deliverySpec
     * @return ShipmentType
     */
    public function setDeliverySpec($deliverySpec)
    {
        $this->deliverySpec = $deliverySpec;

        return $this;
    }

    /**
     * @return ReturnSpecType
     */
    public function getReturnSpec()
    {
        return $this->returnSpec;
    }

    /**
     * @param ReturnSpecType $returnSpec
     * @return ShipmentType
     */
    public function setReturnSpec($returnSpec)
    {
        $this->returnSpec = $returnSpec;

        return $this;
    }




}