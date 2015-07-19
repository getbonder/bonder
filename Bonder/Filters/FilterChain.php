<?php

namespace Bonder\Filters;

/**
 * A filter chain used in a request dispatch.
 * 
 * @author hbandura
 */
interface FilterChain {
  
  /**
   * Returns the controller.
   * 
   * @return \Bonder\Controller the controller.
   */
  public function getController();
  
  /**
   * Returns the filters list.
   * 
   * @return \Bonder\Filter[] the filters list.
   */
  public function getFilters();
  
  /**
   * Executes the first filter in the chain. If no filters are available,
   * calls the controller.
   * 
   * @param \Bonder\Request $request the request.
   * @return \Bonder\Response the response.
   */
  public function execute(\Bonder\Request $request);
  
}