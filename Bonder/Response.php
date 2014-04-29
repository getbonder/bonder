<?php

namespace Bonder;

/**
 * A response.
 *
 * @author burzak
 * @author hbandura
 */
interface Response {

  /**
   * Writes the response to the given Stream.
   *
   * @param \Bonder\Stream $out
   */
  public function writeTo(\Bonder\Stream $out);

}