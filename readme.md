# Usage

    $Shipping = new Shipping([
        'api_username' => CANADA_POST_API_USERNAME,
        'api_password' => CANADA_POST_API_PASSWORD,
        'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
        'api_key' => CANADA_POST_API_KEY,
        'api_contract_id' => CANADA_POST_API_CONTRACT_ID,
        'env' => WebService::ENV_DEV,
    ]);

    $shipment = $Shipping->getShipment($shipmentId);
    echo '<pre>' . print_r($shipment, true) . '</pre>';
    
# TODO
- Find a way to follow links and output class of the right type