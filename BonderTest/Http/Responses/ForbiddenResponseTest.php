<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class ForbiddenResponseTest extends BaseResponseTest {
  
  protected function getCode() {
    return 403;
  }
  
  protected function createResponse($headers, $code, $content) {
    return new \Bonder\Http\Responses\ForbiddenResponse(
      $content, $headers);
  }
  
}