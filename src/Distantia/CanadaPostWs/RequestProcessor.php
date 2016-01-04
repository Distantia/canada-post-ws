<?php
namespace Distantia\CanadaPostWs;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestProcessor
{
    private static $retriableErrorCodes = [
        CURLE_COULDNT_RESOLVE_HOST,
        CURLE_COULDNT_CONNECT,
        CURLE_HTTP_NOT_FOUND,
        CURLE_READ_ERROR,
        CURLE_OPERATION_TIMEOUTED,
        CURLE_HTTP_POST_ERROR,
        CURLE_SSL_CONNECT_ERROR,
    ];
    protected $options;

    /**
     * RequestProcessor constructor.
     * @param array $options
     * @throws \Exception
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'request' => null,
            'ssl' => true,

        ]);

        $resolver->setRequired([
            'api_key',
            'request_url',
            'headers',
        ]);

        $resolver->setAllowedTypes('request', ['string', 'null']);
        $resolver->setAllowedTypes('request_url', 'string');
        $resolver->setAllowedTypes('headers', 'array');
        $resolver->setAllowedTypes('api_key', 'string');
        $resolver->setAllowedTypes('ssl', 'bool');
    }

    /**
     * @return mixed
     */
    public function process()
    {
        // Connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->options['request_url']);
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->options['headers']);

        // Auth
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->options['api_key']);

        // Request
        if ($this->options['request']) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->options['request']);
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
}