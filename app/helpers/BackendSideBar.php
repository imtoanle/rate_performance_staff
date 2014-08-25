<?php
class BackendSideBar
{
	public static function create_root_open($title, $arrRoutes, $icon )
	{
			$active = in_array(Route::currentRouteName(), $arrRoutes) ? 'active' : '';
			$html = '<li class="'.$active.'">
    		<a href="javascript:;"><i class="'.$icon.'"></i><span class="title">'.$title.'</span>
    		<span class="arrow '.(!empty($active) ? 'open' : '').'"></span>
    		</a>';
    	$html .= '<ul class="sub-menu">';

  		return $html;
	}

	public static function create_root_close()
	{
  		return '</ul></li>';
	}

	public static function create_node($title, $routeName, $icon )
	{

			$active = Route::currentRouteName() == $routeName ? 'active' : '';
			$link = $routeName == '' ? '' : route($routeName);
			return '<li class="'.$active.'">
    		<a href="'.$link.'"><i class="'.$icon.'"></i><span>'.$title.'</span></a>
  		</li>';
	}

	public static function checkActive($arrSub)
	{
		if(isset($arrSub[3]) && $arrSub[3] == 'last')
		{
			if (Route::currentRouteName() == $arrSub[1])
			{
				return 'active';
			}
			else return '';
		} else
		{
			foreach ($arrSub as $miniSub) 
			{
				if(isset($miniSub[3]) && is_array($miniSub[3]))
				{
					return self::checkActive($miniSub[3]);
				}else
				{
					return self::checkActive($miniSub);
				}
			}
		}
	}
}