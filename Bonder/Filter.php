<?php

namespace Bonder;

/**
 * A Request filter.
 * 
 * @author hbandura
 * @author burzak
 */
interface Filter {

  /**
   * Filters the request. May or may not pass the request to the
   * next filter in the chain. To continue the filter chain execution, ensure
   * calling $next->call($request).
   *
   * @param \Bonder\Request $request
   * @param \Bonder\Filters\NextFilterCaller $next
   * 
   * @return \Bonder\Response The response.
   */
  public function filter(\Bonder\Request $request, 
          \Bonder\Filters\NextFilterCaller $next);

}
