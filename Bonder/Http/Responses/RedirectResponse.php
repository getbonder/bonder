<?php

namespace Bonder\Http\Responses;

/**
 * A redirect HttpResponse.
 * 
 * @author hbandura
 * @author burzak
 */
class RedirectResponse extends \Bonder\Http\Responses\BaseHttpResponse {
  
  private $redirectUrl;
  
  public function __construct($redirectUrl) {
    $this->redirectUrl = $redirectUrl;
    parent::__construct(null, 302, array("Location: $redirectUrl"));
  }
  
  /**
   * Returns the redirect url.
   * 
   * @return string the redirect url.
   */
  public function getRedirectUrl() {
    return $this->redirectUrl;
  }
}