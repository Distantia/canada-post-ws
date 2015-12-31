<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

use Distantia\CanadaPostWs\Type\Common\LinkType;

class NonContractShipmentInfoType
{
    /**
     * @var string
     * name="shipment-id" type="ShipmentIDType"
     */
    protected $shipmentId;

    /**
     * @var string
     * name="tracking-pin" type="TrackingPINType" minOccurs="0"
     */
    protected $trackingPin;

    /**
     * @var LinkType[]
     * ref="link" minOccurs="0" maxOccurs="unbounded"
     */
    protected $links = [];

    /**
     * @return LinkType[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param LinkType[] $links
     * @return NonContractShipmentInfoType
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @param LinkType $link
     * @return NonContractShipmentInfoType
     */
    public function addLink($link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param string $shipmentId
     * @return NonContractShipmentInfoType
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;

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
     * @return NonContractShipmentInfoType
     */
    public function setTrackingPin($trackingPin)
    {
        $this->trackingPin = $trackingPin;

        return $this;
    }


}