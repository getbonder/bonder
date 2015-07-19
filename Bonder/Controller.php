<?php

namespace Bonder;

/**
 * A request controller/action.
 * 
 * @author burzak
 * @author hbandura
 */
interface Controller {

  /**
   * Services the request given.
   * 
   * @param \Bonder\Request $request the request to serve.
   */
  public function service(\Bonder\Request $request);

  /** Returns the Filters configuration. Should return an array
   * mapping alias names to filter classes.
   *
   * @return array An array (alias => filter class name).
   */
  public function getFilters();

}