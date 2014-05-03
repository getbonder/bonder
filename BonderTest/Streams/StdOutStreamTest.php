<?php

namespace BonderTest\Streams;

/**
 * @author hbandura
 */
final class StdOutStreamTest extends \PHPUnit_Framework_TestCase {
  
  public function testOut() {
    $out = new \Bonder\Streams\StdOutStream();
    $data = "This is sample data \n :)";
    ob_start();
    $out->write($data);
    $stdout = ob_get_contents();
    ob_end_clean();
    $this->assertEquals($data, $stdout);
  }
  
}