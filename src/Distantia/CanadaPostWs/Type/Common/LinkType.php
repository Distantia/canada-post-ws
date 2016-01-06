<?php
namespace Distantia\CanadaPostWs\Type\Common;

use Distantia\CanadaPostWs\RequestProcessor;
use Distantia\CanadaPostWs\Type\Manifest\ManifestType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\WebService;

class LinkType
{
    /**
     * @var string
     * name="href" type="xsd:anyURI" use="required"
     */
    protected $href;

    /**
     * @var string
     * name="rel" type="RelType" use="required"
     */
    protected $rel;

    /**
     * @var int
     * name="index" type="xsd:nonNegativeInteger" use="optional"
     */
    protected $index;

    /**
     * @var string
     * name="media-type" type="xsd:normalizedString" use="required"
     */
    protected $mediaType;

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return LinkType
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     * @return LinkType
     */
    public function setRel($rel)
    {
        $this->rel = $rel;

        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param int $index
     * @return LinkType
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     * @return LinkType
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @param $apiKey
     * @param $ssl
     * @return mixed
     */
    public function processLink($apiKey, $ssl = true)
    {
        $RequestProcessor = new RequestProcessor([
            'request_url' => $this->getHref(),
            'headers' => [
                'Accept: ' . $this->getMediaType(),
            ],
            'request' => null,
            'api_key' => $apiKey,
            'ssl' => $ssl,
        ]);

        $response = $RequestProcessor->process();

        switch ($this->getRel()) {
            case 'label':
                return self::processApplicationPdfResponse($response);
                break;
            case 'manifest':
                $responseXML = new \SimpleXMLElement($response);

                switch ($responseXML->getName()) {
                    case 'manifest':
                        $ManifestType = new ManifestType();

                        $ManifestType->setPoNumber((string)$responseXML->{'po-number'});

                        if ($responseXML->{'links'}->link) {
                            foreach ($responseXML->{'links'}->link as $link) {
                                $LinkType = new LinkType();

                                $LinkType->setHref((string)$link['href']);
                                $LinkType->setRel((string)$link['rel']);
                                $LinkType->setMediaType((string)$link['media-type']);

                                if (isset($link['index'])) {
                                    $LinkType->setIndex((string)$link['index']);
                                }

                                $ManifestType->addLink($LinkType);
                            }
                        }

                        return $ManifestType;
                        break;
                    case 'messages':
                        return WebService::getMessagesType($responseXML);
                        break;
                    default:
                        return false;
                        break;
                }
                break;
            case 'artifact':
                return self::processApplicationPdfResponse($response);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param $response
     * @return bool|ApplicationPdfType|MessagesType
     */
    protected static function processApplicationPdfResponse($response) {
        if ($response) {
            if (strpos($response, '<?xml') === 0) {
                $responseXML = new \SimpleXMLElement($response);

                if ($responseXML->getName()) {
                    return WebService::getMessagesType($responseXML);
                }
            } else {
                $ApplicationPdfType = new ApplicationPdfType();
                $ApplicationPdfType->setContent($response);

                return $ApplicationPdfType;
            }
        }

        return false;
    }

}