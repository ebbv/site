<?php namespace EBBV\Pagination;

class ZurbPresenter extends \Illuminate\Pagination\Presenter {

	public function getActivePageWrapper($text)
	{
		return '<li class="current"><a>'.$text.'</a></li>'."\n";
	}

	public function getDisabledTextWrapper($text)
	{
		return '<li class="unavailable"><a>'.$text.'</a></li>'."\n";
	}

	public function getPageLinkWrapper($url, $page, $rel = null)
	{
		return '<li><a href="'.$url.'">'.$page.'</a></li>'."\n";
	}
}