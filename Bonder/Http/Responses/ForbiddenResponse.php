<?php

namespace Bonder\Http\Responses;

/**
 * @author hbandura
 * @author burzak
 */
class ForbiddenResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  public function __construct($content = null, array $headers = array()) {
    parent::__construct($content, 403, $headers);
  }
}