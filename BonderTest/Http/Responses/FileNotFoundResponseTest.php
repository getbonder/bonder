<?php

namespace BonderTest\Http\Responses;

/**
 * @author hbandura
 */
final class FileNotFoundResponseTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $headers = array('header1', 'header2');
    $content = "my content";
    $r = new \Bonder\Http\Responses\FileNotFoundResponse($content, $headers);
    $this->assertEquals($content, $r->getContent());
    foreach ($headers as $header) {
      $this->assertContains($header, $r->getHeaders());
    }
    $this->assertEquals(404, $r->getStatusCode());
  }
  
}