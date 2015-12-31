<?php
namespace Distantia\CanadaPostWs\Type\Manifest;

use Distantia\CanadaPostWs\Type\Common\LinkType;

class ManifestsType
{
    /**
     * @var LinkType[]
     * ref="link" minOccurs="0" maxOccurs="unbounded"
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


}