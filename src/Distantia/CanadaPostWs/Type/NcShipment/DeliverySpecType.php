<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class DeliverySpecType
{
    /**
     * @var string
     * name="service-code" type="ServiceCodeType"
     */
    protected $serviceCode;

    /**
     * @var SenderType
     * name="sender" type="SenderType"
     */
    protected $sender;

    /**
     * @var DestinationType
     * name="destination" type="DestinationType"
     */
    protected $destination;

    /**
     * @var OptionsType
     * name="options" minOccurs="0"
     */
    protected $options;

    /**
     * @var ParcelCharacteristicsType
     * name="parcel-characteristics" type="ParcelCharacteristicsType"
     */
    protected $parcelCharacteristics;

    /**
     * @var NotificationType
     * name="notification" type="NotificationType" minOccurs="0"
     */
    protected $notification;

    /**
     * @var PreferencesType
     * name="preferences" type="PreferencesType"
     */
    protected $preferences;

    /**
     * @var ReferencesType
     * name="references" type="ReferencesType" minOccurs="0"
     */
    protected $references;

    /**
     * @var CustomsType
     * name="customs" type="CustomsType" minOccurs="0"
     */
    protected $customs;

    /**
     * @var SettlementInfoType
     * name="settlement-info" type="SettlementInfoType" minOccurs="0"
     */
    protected $settlementInfo;

    /**
     * @return string
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * @param string $serviceCode
     * @return DeliverySpecType
     */
    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }

    /**
     * @return SenderType
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderType $sender
     * @return DeliverySpecType
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return DestinationType
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param DestinationType $destination
     * @return DeliverySpecType
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return OptionsType
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionsType $options
     * @return DeliverySpecType
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return ParcelCharacteristicsType
     */
    public function getParcelCharacteristics()
    {
        return $this->parcelCharacteristics;
    }

    /**
     * @param ParcelCharacteristicsType $parcelCharacteristics
     * @return DeliverySpecType
     */
    public function setParcelCharacteristics($parcelCharacteristics)
    {
        $this->parcelCharacteristics = $parcelCharacteristics;

        return $this;
    }

    /**
     * @return NotificationType
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param NotificationType $notification
     * @return DeliverySpecType
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @return PreferencesType
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param PreferencesType $preferences
     * @return DeliverySpecType
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;

        return $this;
    }

    /**
     * @return ReferencesType
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @param ReferencesType $references
     * @return DeliverySpecType
     */
    public function setReferences($references)
    {
        $this->references = $references;

        return $this;
    }

    /**
     * @return CustomsType
     */
    public function getCustoms()
    {
        return $this->customs;
    }

    /**
     * @param CustomsType $customs
     * @return DeliverySpecType
     */
    public function setCustoms($customs)
    {
        $this->customs = $customs;

        return $this;
    }

    /**
     * @return SettlementInfoType
     */
    public function getSettlementInfo()
    {
        return $this->settlementInfo;
    }

    /**
     * @param SettlementInfoType $settlementInfo
     * @return DeliverySpecType
     */
    public function setSettlementInfo($settlementInfo)
    {
        $this->settlementInfo = $settlementInfo;

        return $this;
    }


}