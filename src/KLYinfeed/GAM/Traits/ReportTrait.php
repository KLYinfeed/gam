<?php namespace KLYinfeed\GAM\Traits;

trait ReportTrait
{
    /**
     * REPORT - CREATIVE REPORT
    **/
	public function get_creative_name($params=null)  
    {
        return $this->_get('report/creative-name/' . $params['name']);
    }
	/**
     * REPORT - PLACEMENT REPORT
    **/
	public function get_placement($params=null)
    {
        return $this->_get('report/placement/' . $params['id']);
    }
	/**
     * REPORT - LINEITEM REPORT  
    **/
	public function get_lineitem_report($params=null)
    {
        return $this->_get('report/lineitem/' . $params['id']);
    }

	
}