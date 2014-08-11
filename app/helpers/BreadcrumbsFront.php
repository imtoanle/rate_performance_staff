<?php 

/**
* Breadcrumb class
*/
class BreadcrumbsFront 
{
    /**
    * Create breadcrumb
    * @param array $items breadcrumb items
    * @return string
    */
    public static function create($items = NULL)
    {
        if ($items === NULL)
            $items = Config::get('breadcrumbs.error-404');
        
        $crumbs = array();
        $breadcrumbs = array();
        $count_arr = count($items);


        for ($i=0;$i<$count_arr;$i++)
        {
            $crumbs['title'] = $items[$i][0];
            if(isset($items[$i][1])) //ton tai link
            { 
                $crumbs['link'] = $items[$i][1]; 
            }
            if($i == ($count_arr - 1))
            {
                $crumbs['last'] = 1;
            }
            $breadcrumbs[] = $crumbs;
        }
        return View::make(Config::get('view.breadcrumbs'), array('crumbs' => $breadcrumbs))->render();
    }
}