<?php

namespace BonderTest\Mocks;


/**
 * @author hbandura
 */
final class MockFilterChainProvider implements \Bonder\Filters\FilterChainProvider {
  
  /**
   * @var \Bonder\Filters\FilterChainProviderResult
   */
  private $result;
  
  public function __construct(
          \Bonder\Filters\FilterChainProviderResult $result = null) {
    $this->result = $result;
  }
  
  public function get($uri) {
    return $this->result;
  }
  
}