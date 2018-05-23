<?php

class OliverjlEditableController extends JControllerAdmin
{
  // MUST IMPLEMENT
  public $deleteRedirect = '';
  public $model = array("", "");
  // ------------

	public function getModel($name = 'xxx', $prefix = 'xxx', $config = array('ignore_request' => true))
	{
    if ($name == "xxx") {
      list($name) = $this->model;
    }
    if ($prefix == "xxx") {
      list(, $prefix) = $this->model;
    }
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
   public function delete()
    {
        try
        {
            parent::delete();
        }
        catch (Exception $e)
        {
            $this->setMessage($e->getMessage(), 'error');
        }
        // $v = isset($_GET['view']) ? $_GET['view'] : $this->view_list;
        $v = $this->deleteRedirect;
        $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $v, false));
    }

}
