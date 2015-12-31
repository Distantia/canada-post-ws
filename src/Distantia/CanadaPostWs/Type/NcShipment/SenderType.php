<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class SenderType
{
    /**
     * @var string
     * name="name" type="ContactNameType" minOccurs="0"
     */
    protected $name;

    /**
     * @var string
     * name="company" type="CompanyNameType"
     */
    protected $company;

    /**
     * @var string
     * name="contact-phone" type="PhoneNumberType" maxOccurs="1"
     */
    protected $contactPhone;

    /**
     * @var DomesticAddressDetailsType
     * name="address-details" type="DomesticAddressDetailsType"
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
     * @return SenderType
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
     * @return SenderType
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * @param string $contactPhone
     * @return SenderType
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @return DomesticAddressDetailsType
     */
    public function getAddressDetails()
    {
        return $this->addressDetails;
    }

    /**
     * @param DomesticAddressDetailsType $addressDetails
     * @return SenderType
     */
    public function setAddressDetails($addressDetails)
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }


}