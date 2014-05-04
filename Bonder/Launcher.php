<?php

namespace Bonder;

/**
 * Bonder launcher.
 * 
 * @author hbandura
 */
final class Launcher {
  
  /**
   * @var \Bonder\ConfigurationFactory
   */
  private $configurationFactory;
  
  /**
   * @var \Bonder\Stream
   */
  private $output;
  
  /**
   * @var \Bonder\Filters\FilterChainProvider
   */
  private $filterChainProvider;
  
  /**
   * @var \Bonder\Process\Processor
   */
  private $processor;
  
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
   * Sets the processor to use.
   * 
   * @param \Bonder\Process\Processor $processor the processor.
   * @return \Bonder\Launcher this.
   */
  public function setProcessor(\Bonder\Process\Processor $processor) {
    $this->processor = $processor;
    return $this;
  }
  
  /**
   * Returns the processor.
   * 
   * @return \Bonder\Process\Processor the processor.
   */
  public function getProcessor() {
    return $this->processor;
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
    $response = $this->processor->process($job);
    $response->writeTo($this->getOutputStream());
    return $response;
  }
  
}