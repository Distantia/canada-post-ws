<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class CustomsType
{
    /**
     * @var string
     * name="currency"
     */
    protected $currency;

    /**
     * @var float
     * name="conversion-from-cad" minOccurs="0"
     */
    protected $conversionFromCad;

    /**
     * @var string
     * name="reason-for-export"
     */
    protected $reasonForExport;

    /**
     * @var string
     * name="other-reason" minOccurs="0"
     */
    protected $otherReason;

    /**
     * @var SkuListType
     * name="sku-list"
     */
    protected $skuList;

    /**
     * @var float
     * name="duties-and-taxes-prepaid" minOccurs="0"
     */
    protected $dutiesAndTaxesPrepaid;

    /**
     * @var string
     * name="certificate-number" minOccurs="0"
     */
    protected $certificateNumber;

    /**
     * @var string
     * name="licence-number" minOccurs="0"
     */
    protected $licenceNumber;

    /**
     * @var string
     * name="invoice-number" minOccurs="0"
     */
    protected $invoiceNumber;

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return CustomsType
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return float
     */
    public function getConversionFromCad()
    {
        return $this->conversionFromCad;
    }

    /**
     * @param float $conversionFromCad
     * @return CustomsType
     */
    public function setConversionFromCad($conversionFromCad)
    {
        $this->conversionFromCad = $conversionFromCad;

        return $this;
    }

    /**
     * @return string
     */
    public function getReasonForExport()
    {
        return $this->reasonForExport;
    }

    /**
     * @param string $reasonForExport
     * @return CustomsType
     */
    public function setReasonForExport($reasonForExport)
    {
        $this->reasonForExport = $reasonForExport;

        return $this;
    }

    /**
     * @return string
     */
    public function getOtherReason()
    {
        return $this->otherReason;
    }

    /**
     * @param string $otherReason
     * @return CustomsType
     */
    public function setOtherReason($otherReason)
    {
        $this->otherReason = $otherReason;

        return $this;
    }

    /**
     * @return SkuListType
     */
    public function getSkuList()
    {
        return $this->skuList;
    }

    /**
     * @param SkuListType $skuList
     * @return CustomsType
     */
    public function setSkuList($skuList)
    {
        $this->skuList = $skuList;

        return $this;
    }

    /**
     * @return float
     */
    public function getDutiesAndTaxesPrepaid()
    {
        return $this->dutiesAndTaxesPrepaid;
    }

    /**
     * @param float $dutiesAndTaxesPrepaid
     * @return CustomsType
     */
    public function setDutiesAndTaxesPrepaid($dutiesAndTaxesPrepaid)
    {
        $this->dutiesAndTaxesPrepaid = $dutiesAndTaxesPrepaid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCertificateNumber()
    {
        return $this->certificateNumber;
    }

    /**
     * @param string $certificateNumber
     * @return CustomsType
     */
    public function setCertificateNumber($certificateNumber)
    {
        $this->certificateNumber = $certificateNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getLicenceNumber()
    {
        return $this->licenceNumber;
    }

    /**
     * @param string $licenceNumber
     * @return CustomsType
     */
    public function setLicenceNumber($licenceNumber)
    {
        $this->licenceNumber = $licenceNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     * @return CustomsType
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }


}