<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

class OliverjlEditableViews
{
  static function singleDelete($orderid) {
    if ($orderid == 'list') {
return <<<EOT1
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
EOT1;
    }
return <<<EOT
  <input type="hidden" name="boxchecked" value="1" />
  <input id="cb1" name="cid[]" value="{$orderid}" type="hidden" />
EOT;
  }
  static function deleteList() {
    return self::singleDelete('list');
  }
  static function toolbar() {
    JToolBarHelper::deleteList('Are you sure?', 'order.delete', 'JTOOLBAR_DELETE');
  }
}
