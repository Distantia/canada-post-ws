<?php
namespace Distantia\CanadaPostWs\Type\Common;

class ApplicationPdfType
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return ApplicationPdfType
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }


}