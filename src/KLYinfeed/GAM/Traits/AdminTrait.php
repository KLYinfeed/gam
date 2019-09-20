<?php namespace KLYinfeed\GAM\Traits;

trait AdminTrait
{
    /**
     * COMPANY - ADVERTISERS
    **/
    public function get_advertisers($params=null)
    {
        return $this->_get('get-advertisers');
    }
}