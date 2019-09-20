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
}