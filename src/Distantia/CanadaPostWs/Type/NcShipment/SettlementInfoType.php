<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class SettlementInfoType
{
    /**
     * @var string
     * name="promo-code" type="PromoCodeType" minOccurs="0"
     */
    protected $promoCode;

    /**
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * @param string $promoCode
     * @return SettlementInfoType
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }


}