<?php
namespace Distantia\CanadaPostWs\Type\Messages;

class MessageType
{
    /**
     * @var string
     * name="code" type="xsd:normalizedString"
     */
    protected $code;

    /**
     * @var string
     * name="description" type="xsd:normalizedString"
     */
    protected $description;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return MessageType
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MessageType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


}