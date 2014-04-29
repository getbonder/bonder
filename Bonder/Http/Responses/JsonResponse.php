<?php

namespace Bonder\Http\Responses;

/**
 * @author hbandura
 * @author burzak
 */
class JsonResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  public function __construct($data) {
    parent::__construct(json_encode($data), 200, array('Content-type: text/json'));
  }
}