<?php

namespace Bonder\Process;

/**
 * Processes jobs.
 * 
 * @author hbandura
 */
final class Processor {
  
  /**
   * Processes the given job, sending the request to the filter chain,
   * and returning the result.
   * 
   * @param \Bonder\Process\Job $job
   * @return \Bonder\Response
   */
  public function process(\Bonder\Process\Job $job) {
    return $job->getFilterChain()->call($job->getRequest());
  }
    
}