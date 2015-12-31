<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

use Distantia\CanadaPostWs\Type\Common\LinkType;

class ShipmentInfoType
{
    /**
     * @var string
     * name="shipment-id" type="ShipmentIDType"
     */
    protected $shipmentId;

    /**
     * @var string
     * name="shipment-status" type="ShipmentStatusType"
     */
    protected $shipmentStatus;

    /**
     * @var string
     * name="tracking-pin" type="TrackingPINType" minOccurs="0"
     */
    protected $trackingPin;

    /**
     * @var string
     * name="return-tracking-pin" type="TrackingPINType" minOccurs="0"
     */
    protected $returnTrackingPin;

    /**
     * @var string
     * name="po-number" type="PoNumberType" minOccurs="0"
     */
    protected $poNumber;

    /**
     * @var LinkType[]
     * ref="links"
     */
    protected $links = [];

    /**
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param string $shipmentId
     * @return ShipmentInfoType
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentStatus()
    {
        return $this->shipmentStatus;
    }

    /**
     * @param string $shipmentStatus
     * @return ShipmentInfoType
     */
    public function setShipmentStatus($shipmentStatus)
    {
        $this->shipmentStatus = $shipmentStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingPin()
    {
        return $this->trackingPin;
    }

    /**
     * @param string $trackingPin
     * @return ShipmentInfoType
     */
    public function setTrackingPin($trackingPin)
    {
        $this->trackingPin = $trackingPin;

        return $this;
    }

    /**
     * @return string
     */
    public function getReturnTrackingPin()
    {
        return $this->returnTrackingPin;
    }

    /**
     * @param string $returnTrackingPin
     * @return ShipmentInfoType
     */
    public function setReturnTrackingPin($returnTrackingPin)
    {
        $this->returnTrackingPin = $returnTrackingPin;

        return $this;
    }

    /**
     * @return string
     */
    public function getPoNumber()
    {
        return $this->poNumber;
    }

    /**
     * @param string $poNumber
     * @return ShipmentInfoType
     */
    public function setPoNumber($poNumber)
    {
        $this->poNumber = $poNumber;

        return $this;
    }

    /**
     * @return LinkType[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param LinkType[] $links
     * @return ShipmentInfoType
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @param LinkType $link
     * @return ShipmentInfoType
     */
    public function addLink($link)
    {
        $this->links[] = $link;

        return $this;
    }


}