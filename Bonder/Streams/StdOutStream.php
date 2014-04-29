<?php

namespace Bonder\Streams;

/**
 * Standard output stream.
 *
 * @author hbandura
 * @author burzak
 */
final class StdOutStream implements \Bonder\Stream {

  public function write($data) {
    print($data);
  }

}