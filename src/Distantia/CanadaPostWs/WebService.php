<?php
namespace Distantia\CanadaPostWs;

use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\Messages\MessageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class WebService
{
    const ENV_DEV = 'env.dev';
    const ENV_PROD = 'env.prod';

    const SHIPPING_CODE_DOMESTIC_REGULAR = 1010;
    const SHIPPING_CODE_DOMESTIC_EXPEDITED = 1020;
    const SHIPPING_CODE_DOMESTIC_XPRESSPOST = 1030;
    const SHIPPING_CODE_DOMESTIC_PRIORITY = 1040;

    const SHIPPING_CODE_USA_TRACKED_PACKET = 2000;
    const SHIPPING_CODE_USA_SMALL_PACKETS_AIR = 2015;
    const SHIPPING_CODE_USA_EXPEDITED_BUSINESS_CONTRACT = 2020;
    const SHIPPING_CODE_USA_XPRESSPOST = 2030;
    const SHIPPING_CODE_USA_PRIORITY_WORLDWIDE = 2040;
    const SHIPPING_CODE_USA_PRIORITY_WORLDWIDE_PAK = 2050;

    const SHIPPING_CODE_INTERNATIONAL_TRACKED_PACKET = 3000;
    const SHIPPING_CODE_INTERNATIONAL_SMALL_PACKETS_SURFACE = 3005;
    const SHIPPING_CODE_INTERNATIONAL_SURFACE = 3010;
    const SHIPPING_CODE_INTERNATIONAL_SMALL_PACKETS_AIR = 3015;
    const SHIPPING_CODE_INTERNATIONAL_AIR = 3020;
    const SHIPPING_CODE_INTERNATIONAL_XPRESSPOST = 3025;
    const SHIPPING_CODE_INTERNATIONAL_PRIORITY_WORLDWIDE = 3040;
    const SHIPPING_CODE_INTERNATIONAL_PRIORITY_WORLDWIDE_PAK = 3050;

    private static $retriableErrorCodes = [
        CURLE_COULDNT_RESOLVE_HOST,
        CURLE_COULDNT_CONNECT,
        CURLE_HTTP_NOT_FOUND,
        CURLE_READ_ERROR,
        CURLE_OPERATION_TIMEOUTED,
        CURLE_HTTP_POST_ERROR,
        CURLE_SSL_CONNECT_ERROR,
    ];

    protected $contractId;
    protected $options;
    protected $requestOptions;

    protected $requestUrl;

    public static $serviceCodes = [
        self::SHIPPING_CODE_DOMESTIC_REGULAR => 'DOM.RP',
        self::SHIPPING_CODE_DOMESTIC_EXPEDITED => 'DOM.EP',
        self::SHIPPING_CODE_DOMESTIC_XPRESSPOST => 'DOM.XP',
        self::SHIPPING_CODE_DOMESTIC_PRIORITY => 'DOM.PC',
        self::SHIPPING_CODE_USA_TRACKED_PACKET => 'USA.TP',
        self::SHIPPING_CODE_USA_SMALL_PACKETS_AIR => 'USA.SP.AIR',
        self::SHIPPING_CODE_USA_EXPEDITED_BUSINESS_CONTRACT => 'USA.EP',
        self::SHIPPING_CODE_USA_XPRESSPOST => 'USA.XP',
        self::SHIPPING_CODE_USA_PRIORITY_WORLDWIDE => 'USA.PW.ENV',
        self::SHIPPING_CODE_USA_PRIORITY_WORLDWIDE_PAK => 'USA.PW.PAK',
        self::SHIPPING_CODE_INTERNATIONAL_TRACKED_PACKET => 'INT.TP',
        self::SHIPPING_CODE_INTERNATIONAL_SMALL_PACKETS_SURFACE => 'INT.SP.SURF',
        self::SHIPPING_CODE_INTERNATIONAL_SURFACE => 'INT.IP.SURF',
        self::SHIPPING_CODE_INTERNATIONAL_SMALL_PACKETS_AIR => 'INT.SP.AIR',
        self::SHIPPING_CODE_INTERNATIONAL_AIR => 'INT.IP.AIR',
        self::SHIPPING_CODE_INTERNATIONAL_XPRESSPOST => 'INT.XP',
        self::SHIPPING_CODE_INTERNATIONAL_PRIORITY_WORLDWIDE => 'INT.PW.PARCEL',
        self::SHIPPING_CODE_INTERNATIONAL_PRIORITY_WORLDWIDE_PAK => 'INT.PW.PAK',
    ];

    /**
     * WebService constructor.
     * @param array $options
     * @throws \Exception
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);

        switch ($this->options['env']) {
            case WebService::ENV_DEV:
                $this->requestUrl = 'https://ct.soa-gw.canadapost.ca/rs';
                break;
            case WebService::ENV_PROD:
                $this->requestUrl = 'https://soa-gw.canadapost.ca/rs';
                break;
        }
    }

    /**
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    protected function processRequest(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureRequestOptions($resolver);

        $this->requestOptions = $resolver->resolve($options);

        $requestUrl = $this->requestUrl.$this->requestOptions['request_url'];
        $headers = $this->requestOptions['headers'];

        // Connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 25);

        // SSL
        if ($this->options['ssl']) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        // Headers
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['PHP_SELF'].' VERSION:'.PHP_VERSION.' (PHP-'.phpversion().')');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Auth
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->options['api_key']);

        // Request
        if ($this->requestOptions['request']) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestOptions['request']);
        }

        // Response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = '';

        $retries = 5;
        while ($retries--) {
            $response = curl_exec($ch);

            if ($response === false) {
                if (false === in_array(curl_errno($ch), self::$retriableErrorCodes, true) || !$retries) {
                    curl_close($ch);

                    throw new \RuntimeException(sprintf('Curl error (code %s): %s', curl_errno($ch), curl_error($ch)));
                }

                continue;
            }

            break;
        }

        curl_close($ch);

        return $response;
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'env' => WebService::ENV_DEV,
            'ssl' => true,
        ]);

        $resolver->setRequired([
            'api_customer_number',
            'api_key',
            'env',
        ]);

        $resolver->setAllowedTypes('api_customer_number', 'string');
        $resolver->setAllowedTypes('api_key', 'string');
        $resolver->setAllowedTypes('ssl', 'bool');

        $resolver->setAllowedValues('env', [WebService::ENV_DEV, WebService::ENV_PROD]);
    }

    protected function configureRequestOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'request' => null,

        ]);

        $resolver->setRequired([
            'request_url',
            'headers',
        ]);

        $resolver->setAllowedTypes('request', ['string', 'null']);
        $resolver->setAllowedTypes('request_url', 'string');
        $resolver->setAllowedTypes('headers', 'array');
    }

    /**
     * @param \SimpleXMLElement $responseXML
     * @return MessagesType
     */
    protected function getMessagesType(\SimpleXMLElement $responseXML)
    {
        $MessagesType = new MessagesType();

        if ($responseXML->message) {
            foreach ($responseXML->message as $message) {
                $MessageType = new MessageType();

                $MessageType->setCode((string)$message->code);
                $MessageType->setDescription((string)$message->description);

                $MessagesType->addMessage($MessageType);
            }
        }

        return $MessagesType;
    }
}