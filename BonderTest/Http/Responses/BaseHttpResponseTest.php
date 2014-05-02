<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class BaseHttpResponseTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $headers = array('header1', 'header2');
    $content = "my content";
    $code = 123;
    $r = new \Bonder\Http\Responses\BaseHttpResponse(
      $content, $code, $headers);
    $this->assertEquals($content, $r->getContent());
    foreach ($headers as $header) {
      $this->assertContains($header, $r->getHeaders());
    }
    $this->assertEquals($code, $r->getStatusCode());
  }
  
  /**
   * @runInSeparateProcess
   */
  public function testWriteTo() {
    $headers = array('header1', 'header2');
    $content = "my content";
    $code = 123;
    $r = new \Bonder\Http\Responses\BaseHttpResponse(
      $content, $code, $headers);
    $out = $this->getMock("\Bonder\Stream");
    $out->expects($this->once())->method("write")->with($content);
    $r->writeTo($out);
  }
}