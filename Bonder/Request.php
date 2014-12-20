<?php

namespace Bonder;
use Bonder\Collections\Map;


/**
 * A Request to be served.
 * 
 * @author burzak
 * @author hbandura
 */
interface Request {

  /**
   * Returns the filter variables;
   *
   * @return Map the filter variables;
   */
  public function getFilterVariables();

  /**
   * Returns the URI VARIABLES \Bonder\Collections\Map params.
   *
   * @return \Bonder\Collections\Map the map.
   */
  public function getUriVariables();

  /**
   * Returns the URI requested.
   *
   * @return string the uri.
   */
  public function getUri();

}