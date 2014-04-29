<?php

namespace Bonder\Http\Responses;

/**
 * @author hbandura
 * @author burzak
 */
class FileNotFoundResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  public function __construct($content = null, array $headers = array()) {
    parent::__construct($content, 404, $headers);
  }
}