<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class NonContractShipmentType
{
    /**
     * @var string
     * name="requested-shipping-point" type="PostalCodeType" minOccurs="0"
     */
    protected $requestedShippingPoint;

    /**
     * @var DeliverySpecType
     * name="delivery-spec" type="DeliverySpecType"
     */
    protected $deliverySpec;

    /**
     * @return string
     */
    public function getRequestedShippingPoint()
    {
        return $this->requestedShippingPoint;
    }

    /**
     * @param string $requestedShippingPoint
     * @return NonContractShipmentType
     */
    public function setRequestedShippingPoint($requestedShippingPoint)
    {
        $this->requestedShippingPoint = $requestedShippingPoint;

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
     * @return NonContractShipmentType
     */
    public function setDeliverySpec($deliverySpec)
    {
        $this->deliverySpec = $deliverySpec;

        return $this;
    }


}