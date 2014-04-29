<?php

namespace Bonder\Filters;

/**
 * Caller for the next filter in the chain.
 * 
 * @author burzak
 * @author hbandura
 */
interface NextFilterCaller {

  /**
   * Calls the next filter.
   * 
   * @param \Bonder\Request $request the request.
   * @return \Bonder\Response the response.
   */
  public function call(\Bonder\Request $request);

}