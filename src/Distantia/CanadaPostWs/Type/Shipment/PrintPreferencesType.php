<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class PrintPreferencesType
{
    const OUTPUT_FORMAT_LETTER = '8.5x11';
    const OUTPUT_FORMAT_PHOTO = '4x6';

    const ENCODING_PDF = 'PDF';
    const ENCODING_ZPL = 'ZPL';

    /**
     * @var string
     * name="output-format" minOccurs="0"
     */
    protected $outputFormat;

    /**
     * @var string
     * name="encoding" minOccurs="0"
     */
    protected $encoding;

    /**
     * @return string
     */
    public function getOutputFormat()
    {
        return $this->outputFormat;
    }

    /**
     * @param string $outputFormat
     * @return PrintPreferencesType
     */
    public function setOutputFormat($outputFormat)
    {
        $this->outputFormat = $outputFormat;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     * @return PrintPreferencesType
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }


}