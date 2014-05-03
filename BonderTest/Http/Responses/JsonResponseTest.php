<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class JsonResponseTest extends BaseResponseTest {
  
  protected function getCode() {
    return 200;
  }
  
  protected function createResponse($headers, $code, $content) {
    return new \Bonder\Http\Responses\JsonResponse($content);
  }
  
  protected function checkContent($originalContent, $responseContent) {
    $this->assertEquals(json_encode($originalContent), $responseContent);
  }
  
  protected function checkHeaders($originalHeaders, $responseHeaders) {
    // Do nothing.
  }
}