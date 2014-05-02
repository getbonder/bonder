<?php

namespace BonderTest\Http;

/**
 * @author hbandura
 */
final class HttpUriProviderTest extends \PHPUnit_Framework_TestCase {
  
  public function testUri() {
    global $_SERVER;
    $uri = '/saunohuons/shaosehu';
    $_SERVER['DOCUMENT_URI'] = $uri;
    $up = new \Bonder\Http\HttpUriProvider();
    $this->assertEquals($uri, $up->getUri());
  }
  
  public function testDefault() {
    $up = new \Bonder\Http\HttpUriProvider();
    $this->assertNull($up->getUri());
  }
  
}