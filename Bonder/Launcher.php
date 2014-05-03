<?php

namespace Bonder;

/**
 * Bonder launcher.
 * 
 * @author hbandura
 */
final class Launcher {
  
  /**
   * Sets the configuration factory to use.
   * 
   * @param \Bonder\ConfigurationFactory $factory the configuration factory.
   * @return \Bonder\Launcher this.
   */
  public function setConfigurationFactory(
    \Bonder\ConfigurationFactory $factory) {
    $this->configurationFactory = $factory;
    return $this;
  }
  
  /**
   * Returns the configuration factory.
   * 
   * @return \Bonder\ConfigurationFactory the configuration factory.
   */
  public function getConfigurationFactory() {
    return $this->configurationFactory;
  }
  
  /**
   * Sets the filter chain provider to use.
   * 
   * @param \Bonder\Filters\FilterChainProvider $filterChainProvider the
   * filter chain provider.
   * @return \Bonder\Launcher this.
   */
  public function setFilterChainProvider(
    \Bonder\Filters\FilterChainProvider $filterChainProvider) {
    $this->filterChainProvider = $filterChainProvider;
    return $this;
  }
  
  /**
   * Returns the filter chain provider.
   * 
   * @return \Bonder\Filters\FilterChainProvider the filter chain provider.
   */
  public function getFilterChainProvider() {
    return $this->filterChainProvider;
  }
  
  /**
   * Sets the output stream.
   * 
   * @param \Bonder\Stream $output the output stream.
   * @return \Bonder\Launcher this.
   */
  public function setOutputStream(\Bonder\Stream $output) {
    $this->output = $output;
    return $this;
  }

  /**
   * Returns the output stream.
   * 
   * @return \Bonder\Stream the output stream.
   */
  public function getOutputStream() {
    return $this->output;
  }
  
  /**
   * Launches bonder, and writes the response to the output stream.
   * 
   * @return \Bonder\Response the response.
   */
  public function launch() {
    $chainProvider = $this->getFilterChainProvider();
    $factory = $this->getConfigurationFactory();
    $uri = $factory->getUriProvider()->getUri();
    $job = new \Bonder\Process\FactoryJob(
      $uri,
      $factory->getRequestFactory(),
      $chainProvider);
    $processor = new \Bonder\Process\Processor();
    $response = $processor->process($job);
    $response->writeTo($this->getOutputStream());
    return $response;
  }
  
}