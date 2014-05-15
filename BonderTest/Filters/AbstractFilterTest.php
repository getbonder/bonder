<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
final class AbstractFilterTest extends \PHPUnit_Framework_TestCase {
  
  public function testSimple() {
    $af = $this->getMockForAbstractClass("\Bonder\Filters\AbstractFilter");
    $context = $this->getMock("\Bonder\Context");
    $af->setContext($context);
    $this->assertSame($context, $af->getContext());
  }
  
}