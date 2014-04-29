<?php

namespace Bonder\Http\Responses;

/**
 * @author burzak
 * @author hbandura
 */
class InternalServerErrorResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  public function __construct($content = null, array $headers = array()) {
    parent::__construct($content, 500, $headers);
  }
}