<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Order Model
 */
class OliverjlEditableModel extends JModelAdmin
{
    // MUST IMPLEMENT
    public $tableInfo = array('', '');
    public $comNPl = array('', '');
    // ----
    public function getTable($type = 'xxx', $prefix = 'xxx', $config = array())
    {
        if ($type == 'xxx') {
          list ($type) = $this->tableInfo;
        }
        if ($prefix == 'xxx') {
          list (, $prefix) = $this->tableInfo;
        }
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        list ($m, $n) = $this->comNPl;
        $form = $this->loadForm($m . '.' . $n, $n,
            array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }
        return $form;
    }
}
