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

}