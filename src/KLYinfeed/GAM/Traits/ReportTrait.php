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
     * REPORT - ALL PLACEMENT REPORT
    **/
    public function get_report_all_placement($params=null)
    {
        if( $params ) $params = http_build_query($params);

        return $this->_get('report/placements?'.$params);
    }

	/**
     * REPORT - LINEITEM REPORT  
    **/
	public function get_lineitem_report($params=null)
    {
        $id = isset($params['id']) ? $params['id'] : null;

        if( $params ) $params = http_build_query($params);

        return $this->_get('report/lineitem/' . $id.'?'.$params);
    }

	
}
