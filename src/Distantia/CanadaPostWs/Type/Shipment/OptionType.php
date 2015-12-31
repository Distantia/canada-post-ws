<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class OptionType
{
    /**
     * @var string
     * name="option-code"
     */
    protected $optionCode;

    /**
     * @var float
     * name="option-amount" type="CostTypeNonZero" minOccurs="0"
     */
    protected $optionAmount;

    /**
     * @var bool
     * name="option-qualifier-1" type="xsd:boolean" minOccurs="0"
     */
    protected $optionQualifier1;

    /**
     * @var string
     * name="option-qualifier-2" minOccurs="0"
     */
    protected $optionQualifier2;

    /**
     * @return string
     */
    public function getOptionCode()
    {
        return $this->optionCode;
    }

    /**
     * @param string $optionCode
     * @return OptionType
     */
    public function setOptionCode($optionCode)
    {
        $this->optionCode = $optionCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getOptionAmount()
    {
        return $this->optionAmount;
    }

    /**
     * @param float $optionAmount
     * @return OptionType
     */
    public function setOptionAmount($optionAmount)
    {
        $this->optionAmount = $optionAmount;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOptionQualifier1()
    {
        return $this->optionQualifier1;
    }

    /**
     * @param boolean $optionQualifier1
     * @return OptionType
     */
    public function setOptionQualifier1($optionQualifier1)
    {
        $this->optionQualifier1 = $optionQualifier1;

        return $this;
    }

    /**
     * @return string
     */
    public function getOptionQualifier2()
    {
        return $this->optionQualifier2;
    }

    /**
     * @param string $optionQualifier2
     * @return OptionType
     */
    public function setOptionQualifier2($optionQualifier2)
    {
        $this->optionQualifier2 = $optionQualifier2;

        return $this;
    }


}