<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class ReturnRecipientType
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
     * @return ReturnRecipientType
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
     * @return ReturnRecipientType
     */
    public function setCompany($company)
    {
        $this->company = $company;

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
     * @return ReturnRecipientType
     */
    public function setAddressDetails($addressDetails)
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }


}