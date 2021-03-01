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

	/**
     * REPORT - LINEITEM REPORT  
    **/
	public function get_custom_lineitem($params=null)
    {
        //if( $params ) $params = http_build_query($params);

        return $this->_get('report/custom-lineitem', $params);
    }

    /**
     * REPORT - CHANNEL REPORT  
    **/
    public function get_channel_report($params=null)
    {
        return $this->_get('report/channel', $params);
    }
	
    /**
     * REPORT - CHANNEL REPORT  
    **/
    public function get_unstructured_report($params=null)
    {
        return $this->_get('report/unstructured', $params);
    }

    /**
     * REPORT - IMPRESSION SITE  
    **/
    public function get_imp_site($params=null)
    {
        return $this->_get('report/imp-site', $params);
    }

    /**
     * REPORT - SAVED QUERY  
    **/
    public function get_saved_query($params=null)
    {
        return $this->_get('report/saved-query', $params);
    }

    /**
     * REPORT - BRAND CAMPAIGN
    **/
    public function get_brand_campaign($params=null)
    {
        return $this->_get('report/adv-campaign', $params);
    }

    /**
     * LINE ITEM - FORCAST
    **/
    public function get_forecast($params=null)
    {
        return $this->_get('forecast', $params);
    }
	
    /**
     * RUNNING - CAMPAIGN
    **/
    public function get_running_campaign($params=null)
    {
        return $this->_get('running-campaign', $params);
    }	
}
