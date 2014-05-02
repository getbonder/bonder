<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
abstract class BaseResponseTest extends \PHPUnit_Framework_TestCase {
  
  protected abstract function createResponse($headers, $code, $content);
  
  protected abstract function getCode();
  
  public function testCreate() {
    $headers = array('header1', 'header2');
    $content = "my content";
    $code = $this->getCode();
    $r = $this->createResponse($headers, $code, $content);
    $this->assertEquals($content, $r->getContent());
    foreach ($headers as $header) {
      $this->assertContains($header, $r->getHeaders());
    }
    $this->assertEquals($code, $r->getStatusCode());
  }
  
}