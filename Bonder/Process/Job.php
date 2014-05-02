<?php

namespace Bonder\Process;

/**
 * A Job to process.
 * 
 * @author hbandura
 */
interface Job {
  
  /**
   * The filter chain to be used in the process.
   * 
   * @return \Bonder\Filters\FilterChain the filter chain.
   */
  public function getFilterChain();
  
  /**
   * The request to send to the filter chain.
   * 
   * @return \Bonder\Request the request.
   */
  public function getRequest();
  
}