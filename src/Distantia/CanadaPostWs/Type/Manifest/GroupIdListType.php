<?php
namespace Distantia\CanadaPostWs\Type\Manifest;

class GroupIdListType
{
    /**
     * @var string
     * name="group-id" type="GroupIDType" maxOccurs="unbounded"
     */
    protected $groupId;

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param string $groupId
     * @return ShipmentTransmitSetType
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }
}