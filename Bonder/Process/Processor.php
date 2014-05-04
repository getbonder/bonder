<?php

namespace Bonder\Process;

/**
 * Processes jobs.
 * 
 * @author hbandura
 */
interface Processor {
  
  /**
   * Processes the given job, sending the request to the filter chain,
   * and returning the result.
   *
   * @param \Bonder\Process\Job $job the job.
   * @return \Bonder\Response the response.
   */
  public function process(\Bonder\Process\Job $job);
  
}