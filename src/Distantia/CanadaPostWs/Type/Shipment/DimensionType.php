<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class DimensionType
{
    /**
     * @var float
     * name="length" type="DimensionMeasurementType"
     */
    protected $length;

    /**
     * @var float
     * name="width" type="DimensionMeasurementType"
     */
    protected $width;

    /**
     * @var float
     * name="height" type="DimensionMeasurementType"
     */
    protected $height;

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     * @return DimensionType
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return DimensionType
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     * @return DimensionType
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }


}