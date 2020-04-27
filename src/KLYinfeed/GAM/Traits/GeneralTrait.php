<?php namespace KLYinfeed\GAM\Traits;

trait GeneralTrait
{
    /**
     * GET INFO NETWORK
    **/
    public function get_network($params=null)
    {
        return $this->_get('network');
    }
    
    /**
     * GET INFO ORDERS
    **/
    public function get_orders($params=null)
    {
        return $this->_get('orders');
    }
    
    /**
     * GET CITIES
    **/
    public function get_cities()
    {
        return $this->_get('cities');
    }

    /**
     * GET INFO ORDER
    **/
    public function get_order($params=null)
    {
        return $this->_get('order/' . $params['id']); 
    }
    
    /**
     * GET INFO LINE ITEM
    **/
    public function get_lineitem($params=null)
    {
        return $this->_get('lineitem/' . $params['id']);
    }
	
	 /**
     * GET INFO CREATIVE
    **/
    public function get_creative($params=null)
    {
        return $this->_get('creative/' . $params['id']);
    }
}
