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
}