<?php

namespace Bonder;

/**
 * Launcher factory class.
 * 
 * @author hbandura
 */
final class LauncherFactory {
  
  /**
   * Creates the default Launcher.
   * 
   * @param \Bonder\Filters\FilterChainProvider $filterChainProvider
   * @return \Bonder\Launcher
   */
  private static function getDefault(
    \Bonder\Filters\FilterChainProvider $filterChainProvider) {
    $launcher = new \Bonder\Launcher();
    $launcher
      ->setOutputStream(new \Bonder\Streams\StdOutStream())
      ->setProcessor(new \Bonder\Process\SimpleProcessor())
      ->setFilterChainProvider($filterChainProvider);
    return $launcher;
  }
  
  /**
   * Creates a Launcher for http bonder use.
   * 
   * @param \Bonder\Filters\FilterChainProvider $filterChainProvider the
   * filter chain provider.
   * @return \Bonder\Launcher the launcher.
   */
  public static function http(
    \Bonder\Filters\FilterChainProvider $filterChainProvider) {
    $launcher = self::getDefault($filterChainProvider);
    $launcher->setConfigurationFactory(new \Bonder\Http\HttpConfigurationFactory());
    return $launcher;
  }
  
  /**
   * Should not be initialized.
   */
  private function __construct() {
  }
  
}