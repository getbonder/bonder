<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class BaseHttpResponseTest extends BaseResponseTest {
    
  protected function getCode() {
    return 123;
  }
  
  protected function createResponse($headers, $code, $content) {
    return new \Bonder\Http\Responses\BaseHttpResponse(
      $content, $code, $headers);
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