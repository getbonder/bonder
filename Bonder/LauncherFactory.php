<?php

namespace Bonder;

/**
 * Launcher factory class / Facade for bonder use.
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
  public static function getHttp(
    \Bonder\Filters\FilterChainProvider $filterChainProvider) {
    $launcher = self::getDefault($filterChainProvider);
    $launcher->setConfigurationFactory(new \Bonder\Http\HttpConfigurationFactory());
    return $launcher;
  }
  
  /**
   * Returns the standard filter chain provider builder.
   * 
   * @param array $resources the resources.
   * @param array $controllers the controllers.
   * @param array $filters the filters
   * 
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder the builder.
   */
  public static function getStandardFCPBuilder(
    Array $resources, Array $controllers, Array $filters) {
    $builder = new \Bonder\Builders\StandardFilterChainProviderBuilder();
    return $builder
      ->setContext(new \Bonder\Contexts\MapContext(
          \Bonder\Collections\Map::fromArray($resources)))
      ->setControllers($controllers)
      ->setFilters($filters);
  }
  
  /**
   * Returns a Launcher for http handling, using the resources given as a
   * context, and the controllers and filters as arrays of 
   * regexp => controller/filter.
   * 
   * @param array $resources the resources, the context.
   * @param array $controllers the controllers as regex => controller.
   * @param array $filters the filters as regex => filters.
   * 
   * @return \Bonder\Launcher the launcher.
   */
  public static function getStandardHttp(
    Array $resources, Array $controllers, Array $filters) {
    return self::getHttp(
      self::getStandardFCPBuilder($resources, $controllers, $filters)->build()
    );
  }
  
  /**
   * Returns a Launcher for http handling, using the resources given as a
   * context, and the controllers and filters as arrays of 
   * regexp => controller/filter. If the uri is unmatched, the default
   * controller is called.
   * 
   * @param array $resources the resources, the context.
   * @param array $controllers the controllers as regex => controller.
   * @param array $filters the filters as regex => filters.
   * @param \Bonder\Controller $defaultController the default controller.
   * 
   * @return \Bonder\Launcher the launcher.
   */
  public static function getStandardHttpWithDefault(
    Array $resources, Array $controllers, Array $filters,
    \Bonder\Controller $defaultController) {
    return self::getHttp(
      self::getStandardFCPBuilder($resources, $controllers, $filters)
      ->setDefaultController($defaultController)->build()
    );
  }
  
  /**
   * Should not be initialized.
   */
  private function __construct() {
  }
  
}