<?php
$app->post('/api/EasyPostTracking/getTrackers', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $body = array();

    //optional parameters
    if (!empty($post_data['args']['trackingCode'])) {
        $query['tracking_code'] = $post_data['args']['trackingCode'];
    };
    if (!empty($post_data['args']['carrier'])) {
        $query['carrier'] = $post_data['args']['carrier'];
    };
    if (!empty($post_data['args']['pageSize'])) {
        $query['page_size'] = $post_data['args']['pageSize'];
    };
    if (!empty($post_data['args']['startDatetime'])) {
        $query['start_datetime'] = $post_data['args']['startDatetime'];
    };
    if (!empty($post_data['args']['endDatetime'])) {
        $query['end_datetime'] = $post_data['args']['endDatetime'];
    };
    if (!empty($post_data['args']['beforeId'])) {
        $query['before_id'] = $post_data['args']['beforeId'];
    };
    if (!empty($post_data['args']['afterId'])) {
        $query['after_id'] = $post_data['args']['afterId'];
    };


    $query_str = $settings['api_url'];

    //requesting remote API
    $client = new GuzzleHttp\Client(['auth' => [$post_data['args']['apiKey']]]);

    try {

        $resp = $client->get($query_str, [
            'query' => $query,
            'verify' => false
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});