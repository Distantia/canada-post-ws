<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class ReferencesType
{
    /**
     * @var string
     * name="cost-centre" type="CostCentreIDType" minOccurs="0"
     */
    protected $costCentre;

    /**
     * @var string
     * name="customer-ref-1" minOccurs="0"
     */
    protected $customerRef1;

    /**
     * @var string
     * name="customer-ref-2" minOccurs="0"
     */
    protected $customerRef2;

    /**
     * @return string
     */
    public function getCostCentre()
    {
        return $this->costCentre;
    }

    /**
     * @param string $costCentre
     * @return ReferencesType
     */
    public function setCostCentre($costCentre)
    {
        $this->costCentre = $costCentre;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRef1()
    {
        return $this->customerRef1;
    }

    /**
     * @param string $customerRef1
     * @return ReferencesType
     */
    public function setCustomerRef1($customerRef1)
    {
        $this->customerRef1 = $customerRef1;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRef2()
    {
        return $this->customerRef2;
    }

    /**
     * @param string $customerRef2
     * @return ReferencesType
     */
    public function setCustomerRef2($customerRef2)
    {
        $this->customerRef2 = $customerRef2;

        return $this;
    }


}