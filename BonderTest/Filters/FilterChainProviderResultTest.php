<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
final class FilterChainProviderResultTest extends \PHPUnit_Framework_TestCase {

  public function testCreate() {
    $uriVariables = new \Bonder\Collections\Map();
    $controller = $this->getMock("\Bonder\Controller");
    $filterChain = new \Bonder\Filters\FilterChain(array(), $controller);
    $fcpr = new \Bonder\Filters\FilterChainProviderResult(
      $filterChain, $uriVariables);
    $this->assertSame($filterChain, $fcpr->getFilterChain());
    $this->assertSame($uriVariables, $fcpr->getUriVariables());
  }
}