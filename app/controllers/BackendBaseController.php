<?php 

class BackendBaseController extends Controller 
{
    /**
    * Setup the layout used by the controller.
    *
    * @return void
    */
    protected function setupLayout()
    {
        $this->layout = View::make(Config::get('view.backend.master'));
        $this->layout->title = 'Syntara - Dashboard';
        $this->layout->breadcrumb = array();
    }
}