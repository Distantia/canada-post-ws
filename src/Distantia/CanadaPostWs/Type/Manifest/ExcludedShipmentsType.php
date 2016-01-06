<?php
namespace Distantia\CanadaPostWs\Type\Manifest;

class ExcludedShipmentsType
{
    /**
     * @var string
     * name="shipment-id" type="ShipmentIDType" maxOccurs="unbounded"
     */
    protected $shipmentId;

    /**
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param string $shipmentId
     * @return ExcludedShipmentsType
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;

        return $this;
    }


}