<?php

namespace Bonder;

/**
 * A data stream.
 *
 * @author hbandura
 * @author burzak
 */
interface Stream {

  /**
   * Writes the given data to this stream.
   *
   * @param mixed $data the data to write.
   */
  public function write($data);

}