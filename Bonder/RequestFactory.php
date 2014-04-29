<?php

namespace Bonder;

/**
 * Creates Requests.
 * 
 * @author hbandura
 */
interface RequestFactory {
  
  /**
   * Creates and returns a new \Bonder\Request.
   * 
   * @param \Bonder\Collections\Map $uriVariables The uri variables matched.
   * @return \Bonder\Request the request.
   */
  public function createRequest(\Bonder\Collections\Map $uriVariables);
  
}