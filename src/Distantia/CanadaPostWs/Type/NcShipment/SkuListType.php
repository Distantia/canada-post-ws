<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class SkuListType
{
    /**
     * @var SkuType[]
     * name="item" type="SkuType" maxOccurs="500"
     */
    protected $items;

    /**
     * @return SkuType[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param SkuType[] $items
     * @return SkuListType
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param SkuType $item
     * @return SkuListType
     */
    public function addItem($item)
    {
        $this->items[] = $item;

        return $this;
    }


}