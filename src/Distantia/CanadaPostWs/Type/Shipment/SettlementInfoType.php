<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class SettlementInfoType
{
    /**
     * @var string
     * name="paid-by-customer" type="CustomerIDType" minOccurs="0"
     */
    protected $paidByCustomer;

    /**
     * @var string
     * name="contract-id" type="ContractIDType" minOccurs="0"
     */
    protected $contractId;

    /**
     * @var bool
     * name="cif-shipment" type="xsd:boolean" fixed="true" minOccurs="0"
     */
    protected $cifShipment;

    /**
     * @var string
     * name="intended-method-of-payment" type="MethodOfPaymentType"
     */
    protected $intendedMethodOfPayment;

    /**
     * @return string
     */
    public function getPaidByCustomer()
    {
        return $this->paidByCustomer;
    }

    /**
     * @param string $paidByCustomer
     * @return SettlementInfoType
     */
    public function setPaidByCustomer($paidByCustomer)
    {
        $this->paidByCustomer = $paidByCustomer;

        return $this;
    }

    /**
     * @return string
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * @param string $contractId
     * @return SettlementInfoType
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isCifShipment()
    {
        return $this->cifShipment;
    }

    /**
     * @param boolean $cifShipment
     * @return SettlementInfoType
     */
    public function setCifShipment($cifShipment)
    {
        $this->cifShipment = $cifShipment;

        return $this;
    }

    /**
     * @return string
     */
    public function getIntendedMethodOfPayment()
    {
        return $this->intendedMethodOfPayment;
    }

    /**
     * @param string $intendedMethodOfPayment
     * @return SettlementInfoType
     */
    public function setIntendedMethodOfPayment($intendedMethodOfPayment)
    {
        $this->intendedMethodOfPayment = $intendedMethodOfPayment;

        return $this;
    }


}