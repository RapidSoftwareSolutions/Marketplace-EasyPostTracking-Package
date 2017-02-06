<?php

namespace Test\Functional;

require_once (__DIR__.'/../../src/Models/checkRequest.php');
require_once (__DIR__.'/../../test/Functional/BaseTestCase.php');

class EasyPostTrackingTest extends BaseTestCase {

    public function testListMetrics() {

        $routes = [
            'getTracker',
            'getTrackers',
            'trackPackage'
        ];

        foreach($routes as $file) {
            $var = '{}';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/EasyPostTracking/'.$file, $post_data);



            $this->assertEquals(200, $response->getStatusCode(), 'Error in '.$file.' method');
        }
    }

}
