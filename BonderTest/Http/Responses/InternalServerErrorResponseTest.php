<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class InternalServerErrorResponseTest extends BaseResponseTest {
  
  protected function getCode() {
    return 500;
  }
  
  protected function createResponse($headers, $code, $content) {
    return new \Bonder\Http\Responses\InternalServerErrorResponse(
      $content, $headers);
  }
}