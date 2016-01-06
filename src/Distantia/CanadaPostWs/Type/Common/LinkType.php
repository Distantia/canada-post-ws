<?php
namespace Distantia\CanadaPostWs\Type\Common;

use Distantia\CanadaPostWs\RequestProcessor;

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
            case 'self':
                // todo
                break;
            case 'details':
                // todo
                break;
            case 'price':
                // todo
                break;
            case 'group':
                // todo
                break;
            case 'label':
                /**
                 * @todo: Handle xml messages from Canada Post
                 */
                if (strpos($response, '<?xml') === 0) {
                    $response = '';
                }

                return $response;
                break;
            case 'manifest':
                break;
            case 'artifact':
                /**
                 * @todo: Handle xml messages from Canada Post
                 */
                if (strpos($response, '<?xml') === 0) {
                    $response = '';
                }

                return $response;
                break;
            default:
                return false;
                break;
        }
    }


}