<?php

namespace Bonder\Cli;

/**
 * Command line interface sub command for the bonder application.
 *
 * @author hbandura
 */
interface CliCommand {

  /**
   * Returns the name of this sub-command, as will be executed from the cli.
   * <p>
   * Note that no two subcommands should share name under the same application.
   *
   * @return string
   */
  public function getName();

  /**
   * Executes the action.
   *
   * @param array $options
   */
  public function execute(Array $options);

}