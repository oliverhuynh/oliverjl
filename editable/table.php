<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

class OliverjlEditableTable extends JTable
{
    // MUST IMPLEMENT
    public $myTable = array('', '');
    public $myTableChild = array('', '');
    // --------
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct(&$db)
    {
        parent::__construct($this->myTable[0], $this->myTable[1], $db);
    }
    public function delete($pk = null)
    {
      $k = $this->_tbl_key;
      $pk = (is_null($pk)) ? $this->$k : $pk;
      if ($pk === null) {
        return FALSE;
      }

      // Remove line items
      $this->deleteChildren($pk);

      return parent::delete($pk);
    }
    function deleteChildren($oid){
      if (!$this->myTableChild[0]) {
        return ;
      }
      $query = $this->_db->getQuery(true)->delete($this->myTableChild[0])->where($this->myTableChild[1] . ' = '.$this->_db->q($oid));
      try {
        $this->_db->setQuery($query)->execute();
      }catch (Exception $e) {
        //do nothing. Because this is not harmful even if it fails.
      }
      return true;
    }
}
