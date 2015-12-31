<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class ParcelCharacteristicsType
{
    /**
     * @var float
     * name="weight"
     */
    protected $weight;

    /**
     * @var DimensionType
     * name="dimensions" minOccurs="0"
     */
    protected $dimensions;

    /**
     * @var bool
     * name="unpackaged"
     */
    protected $unpackaged;

    /**
     * @var bool
     * name="mailing-tube" type="xsd:boolean" minOccurs="0"
     */
    protected $mailingTube;

    /**
     * @var bool
     * name="oversized" type="xsd:boolean" minOccurs="0"
     */
    protected $oversized;

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return ParcelCharacteristicsType
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return DimensionType
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param DimensionType $dimensions
     * @return ParcelCharacteristicsType
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isUnpackaged()
    {
        return $this->unpackaged;
    }

    /**
     * @param boolean $unpackaged
     * @return ParcelCharacteristicsType
     */
    public function setUnpackaged($unpackaged)
    {
        $this->unpackaged = $unpackaged;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isMailingTube()
    {
        return $this->mailingTube;
    }

    /**
     * @param boolean $mailingTube
     * @return ParcelCharacteristicsType
     */
    public function setMailingTube($mailingTube)
    {
        $this->mailingTube = $mailingTube;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOversized()
    {
        return $this->oversized;
    }

    /**
     * @param boolean $oversized
     * @return ParcelCharacteristicsType
     */
    public function setOversized($oversized)
    {
        $this->oversized = $oversized;

        return $this;
    }


}