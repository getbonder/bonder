<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
abstract class BaseResponseTest extends \PHPUnit_Framework_TestCase {
  
  protected abstract function createResponse($headers, $code, $content);
  
  protected abstract function getCode();
  
  protected function checkContent($originalContent, $responseContent) {
    $this->assertEquals($originalContent, $responseContent);
  }
  
  protected function checkHeaders($originalHeaders, $responseHeaders) {
    foreach ($originalHeaders as $header) {
      $this->assertContains($header, $responseHeaders);
    }
  }
  
  public function testCreate() {
    $headers = array('header1', 'header2');
    $content = "my content";
    $code = $this->getCode();
    $r = $this->createResponse($headers, $code, $content);
    $this->checkContent($content, $r->getContent());
    $this->checkHeaders($headers, $r->getHeaders());
    $this->assertEquals($code, $r->getStatusCode());
  }
  
}