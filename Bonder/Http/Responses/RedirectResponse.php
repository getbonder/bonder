<?php

namespace Bonder\Http\Responses;

/**
 * @author hbandura
 * @author burzak
 */
class RedirectResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  public function __construct($redirectToUrl) {
    parent::__construct(null, 302, array("Location: $redirectToUrl"));
  }
}