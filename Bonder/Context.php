<?php

namespace Bonder;

/**
 * @author hbandura
 * @author burzak
 */
interface Context {

  /**
   *
   * @param string $resource
   * @return mixed
   */
  public function get($resource);

}