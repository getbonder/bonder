<?php

namespace Bonder\Filters;

use Bonder\Request;

/**
 * Caller for the next filter in the chain.
 * 
 * @author burzak
 * @author hbandura
 */
interface NextFilterCaller {

  /**
   * Calls the next filter, passing along the processed
   * variable values as an array (varname => value).
   *
   * @param Request $request the request.
   * @param array $variables the variables.
   * @return \Bonder\Response the response.
   */
  public function call(Request $request, Array $variables = array());
}