<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class NotificationType
{
    /**
     * @var string
     * name="email" type="EmailType"
     */
    protected $email;

    /**
     * @var bool
     * name="on-shipment" type="xsd:boolean"
     */
    protected $onShipment;

    /**
     * @var bool
     * name="on-exception" type="xsd:boolean"
     */
    protected $onException;

    /**
     * @var bool
     * name="on-delivery" type="xsd:boolean"
     */
    protected $onDelivery;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return NotificationType
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOnShipment()
    {
        return $this->onShipment;
    }

    /**
     * @param boolean $onShipment
     * @return NotificationType
     */
    public function setOnShipment($onShipment)
    {
        $this->onShipment = $onShipment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOnException()
    {
        return $this->onException;
    }

    /**
     * @param boolean $onException
     * @return NotificationType
     */
    public function setOnException($onException)
    {
        $this->onException = $onException;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOnDelivery()
    {
        return $this->onDelivery;
    }

    /**
     * @param boolean $onDelivery
     * @return NotificationType
     */
    public function setOnDelivery($onDelivery)
    {
        $this->onDelivery = $onDelivery;

        return $this;
    }



}