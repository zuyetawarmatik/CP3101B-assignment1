<?php

class Error404Controller extends BaseController {

	public function index()
	{
		$this->registry->template->show('error404');
	}

}
?>
