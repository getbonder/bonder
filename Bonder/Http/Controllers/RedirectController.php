<?php

namespace Bonder\Http\Controllers;

/**
 * Returns a RedirectResponse.
 *
 * @author burzak
 * @author hbandura
 */
final class RedirectController extends \Bonder\Http\HttpController {

  private $redirectUri;

  public function __construct($redirectUri) {
    $this->redirectUri = $redirectUri;
  }

  protected function get(\Bonder\Http\HttpRequest $request) {
    return new \Bonder\Http\Responses\RedirectResponse($this->redirectUri);
  }

  protected function post(\Bonder\Http\HttpRequest $request) {
    return $this->get($context, $request);
  }

}
