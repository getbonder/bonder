<?php

namespace Bonder\Process;

/**
 * Processes jobs.
 * 
 * @author hbandura
 */
final class SimpleProcessor implements \Bonder\Process\Processor {
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Process.Processor::process()
   */
  public function process(\Bonder\Process\Job $job) {
    return $job->getFilterChain()->execute($job->getRequest());
  }
    
}