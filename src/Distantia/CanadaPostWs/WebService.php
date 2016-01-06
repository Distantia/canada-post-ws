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

    protected $contractId;
    protected $options;

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
        if ($options['request_url']) {
            $options['request_url'] = $this->requestUrl.$options['request_url'];
        }

        $options = array_merge(
            $options,
            [
                'api_key' => $this->options['api_key'],
                'ssl' => $this->options['ssl'],
            ]
        );

        $RequestProcessor = new RequestProcessor($options);

        return $RequestProcessor->process();
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

    /**
     * @param \SimpleXMLElement $responseXML
     * @return MessagesType
     */
    public static function getMessagesType(\SimpleXMLElement $responseXML)
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