<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class OptionsType
{
    /**
     * @var OptionType[]
     * name="option" type="OptionType" maxOccurs="20"
     */
    protected $options;

    /**
     * @return OptionType[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionType[] $options
     * @return OptionsType
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param OptionType $option
     * @return OptionsType
     */
    public function addOption($option)
    {
        $this->options[] = $option;

        return $this;
    }


}