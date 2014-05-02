<?php

namespace BonderTest\Http;

/**
 * @author hbandura
 */
final class HttpConfigurationFactoryTest extends \PHPUnit_Framework_TestCase {
  
  public function testUriProvider() {
    $cf = new \Bonder\Http\HttpConfigurationFactory();
    $this->assertInstanceOf("\Bonder\Http\HttpUriProvider", 
      $cf->getUriProvider());
  }
  
  public function testRequestFactory() {
    $cf = new \Bonder\Http\HttpConfigurationFactory();
    $this->assertInstanceOf("\Bonder\Http\HttpRequestFactory",
      $cf->getRequestFactory());
  }
  
}