<?php

namespace Bonder;

/**
 * The configuration factory for the bonder application.
 * 
 * @author hbandura
 */
interface ConfigurationFactory {
  
  /**
   * Returns the uri provider to use.
   * 
   * @return \Bonder\UriProvider the uri provider.
   */
  public function getUriProvider();
  
  /**
   * Returns the request factory to use.
   * 
   * @return \Bonder\RequestFactory the request factory.
   */
  public function getRequestFactory();
  
}