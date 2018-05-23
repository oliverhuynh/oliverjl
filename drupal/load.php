<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
function toDrupal($backToJoomla = FALSE)  {
  static $old;
  if (!isset($old)) {
    $old = getcwd();
  }
  if (!$backToJoomla) {
    chdir(dirname(__FILE__));
  }
  else {
    chdir($old);
  }
}

define('DRUPAL_ROOT', dirname(__FILE__));

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
require_once DRUPAL_ROOT . '/includes/path.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_CONFIGURATION);
