<?php
namespace Distantia\CanadaPostWs\Type\Manifest;

use Distantia\CanadaPostWs\Type\Common\LinkType;

class ManifestType
{
    /**
     * @var string
     * name="po-number" type="PoNumberType"
     */
    protected $poNumber;

    /**
     * @var LinkType[]
     * ref="links"
     */
    protected $links = [];

    /**
     * @return LinkType[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param LinkType[] $links
     * @return ManifestsType
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @param LinkType $link
     * @return ManifestsType
     */
    public function addLink($link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getPoNumber()
    {
        return $this->poNumber;
    }

    /**
     * @param string $poNumber
     * @return ManifestType
     */
    public function setPoNumber($poNumber)
    {
        $this->poNumber = $poNumber;

        return $this;
    }

}