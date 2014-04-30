<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class RedirectResponseTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $url = "https://sub.myurl.com?query=param4&query2=param5";
    $response = new \Bonder\Http\Responses\RedirectResponse($url);
    $this->assertEquals($url, $response->getRedirectUrl());
    $this->assertEquals(302, $response->getStatusCode());
    $headers = $response->getHeaders();
    $this->assertTrue(array_search("Location: $url", $headers) !== false);
  }
  
}