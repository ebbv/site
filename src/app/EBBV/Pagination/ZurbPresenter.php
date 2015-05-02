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

	public function render()
	{
		// The hard-coded six represents the minimum number of pages we need to
		// be able to create a sliding page window. If we have less than that, we
		// will just render a simple range of page links insteadof the sliding.
		if ($this->lastPage < 6)
		{
			$content = $this->getPageRange(1, $this->lastPage);
		}
		else
		{
			$content = $this->getPageSlider();
		}

		return $this->getPrevious().$content.$this->getNext();
	}

	protected function getPageSlider()
	{
		$window = 2;

		// If the current page is very close to the beginning of the page range, we will
		// just render the beginning of the page range, followed by the last 2 of the
		// links in this list, since we will not have room to create a full slider.
		if ($this->currentPage <= $window)
		{
			$ending = $this->getFinish();

			return $this->getPageRange(1, $window).$ending;
		}

		// If the current page is close to the ending of the page range we will just get
		// this first couple pages, followed by a larger window of these ending pages
		// since we're too close to the end of the list to create a full on slider.
		elseif ($this->currentPage > $this->lastPage - $window)
		{
			$start = $this->lastPage - 1;

			$content = $this->getPageRange($start, $this->lastPage);

			return $this->getStart().$content;
		}

		// If we have enough room on both sides of the current page to build a slider we
		// will surround it with both the beginning and ending caps, with this window
		// of pages in the middle providing a Google style sliding paginator setup.
		else
		{
            $start = $this->getPageRange(1, 1);
            $content = $this->getActivePageWrapper($this->currentPage);
            $end = $this->getPageRange($this->lastPage, $this->lastPage);
			return $start.$this->getDots().$content.$this->getDots().$end;
		}
	}
}
