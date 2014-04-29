<?php

namespace Bonder\Http;

/**
 * A Http Response.
 *
 * @author burzak
 * @author hbandura
 */
interface HttpResponse extends \Bonder\Response {

  /**
   * Returns the http status code.
   * 
   * @return int
   */
  public function getStatusCode();
  
  /**
   * Returns the header we should sent to the browser before any other content
   *
   * @return Array 
   */
  public function getHeaders();

  /**
   * This is the request content (HTML for example)
   *
   * @return string 
   */
  public function getContent();

}