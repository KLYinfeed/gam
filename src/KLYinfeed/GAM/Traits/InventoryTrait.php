<?php namespace KLYinfeed\GAM\Traits;

trait InventoryTrait
{
    /**
     * INVENTORY - ADUNIT
    **/
    public function get_adunits($params=null)
    {
        return $this->_get('adunits');
    } 
	
	public function get_placements($params=null)
    {
        return $this->_get('placements');
    }

    public function get_segment($params=null)
    {
        return $this->_get('segments', $params);
    }

    public function post_lineitem($params=null)
    {
        return $this->_post('lineitem', $params);
    }
	
    public function post_preview($params=null)
    {
        return $this->_post('preview', $params);
    }

    public function post_action_lineitem($params=null)
    {
        return $this->_post('action-lineitem', $params);
    }
}
