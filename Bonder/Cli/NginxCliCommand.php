<?php
namespace Bonder\Cli;


final class NginxCliCommand implements CliCommand {

  /**
   * Returns the name of this sub-command, as will be executed from the cli.
   * <p>
   * Note that no two subcommands should share name under the same application.
   *
   * @return string
   */
  public function getName() {
    return "nginx";
  }

  /**
   * Executes the action.
   *
   * @param array $options
   */
  public function execute(Array $options) {
    // TODO: Implement execute() method.
  }
}