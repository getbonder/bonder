<?php

namespace Bonder\Http;

/**
 * Http configuration factory.
 * 
 * @author hbandura
 */
final class HttpConfigurationFactory implements \Bonder\ConfigurationFactory {
  
  public function getUriProvider() {
    return new \Bonder\Http\HttpUriProvider();
  }
  
  public function getRequestFactory() {
    return new \Bonder\Http\HttpRequestFactory();
  }
  
}