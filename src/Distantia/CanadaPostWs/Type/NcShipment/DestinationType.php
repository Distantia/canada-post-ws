<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class DestinationType
{
    /**
     * @var string
     * name="name" type="ContactNameType" minOccurs="0"
     */
    protected $name;

    /**
     * @var string
     * name="company" type="CompanyNameType" minOccurs="0"
     */
    protected $company;

    /**
     * @var string
     * name="company" type="CompanyNameType" minOccurs="0"
     */
    protected $additionalAddressInfo;

    /**
     * @var string
     * name="client-voice-number" type="PhoneNumberType" minOccurs="0"
     */
    protected $clientVoiceNumber;

    /**
     * @var DestinationAddressDetailsType
     * name="address-details" type="DestinationAddressDetailsType"
     */
    protected $addressDetails;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DestinationType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return DestinationType
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalAddressInfo()
    {
        return $this->additionalAddressInfo;
    }

    /**
     * @param string $additionalAddressInfo
     * @return DestinationType
     */
    public function setAdditionalAddressInfo($additionalAddressInfo)
    {
        $this->additionalAddressInfo = $additionalAddressInfo;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientVoiceNumber()
    {
        return $this->clientVoiceNumber;
    }

    /**
     * @param string $clientVoiceNumber
     * @return DestinationType
     */
    public function setClientVoiceNumber($clientVoiceNumber)
    {
        $this->clientVoiceNumber = $clientVoiceNumber;

        return $this;
    }

    /**
     * @return DestinationAddressDetailsType
     */
    public function getAddressDetails()
    {
        return $this->addressDetails;
    }

    /**
     * @param DestinationAddressDetailsType $addressDetails
     * @return DestinationType
     */
    public function setAddressDetails($addressDetails)
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }


}