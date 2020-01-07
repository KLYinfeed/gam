<?php namespace KLYinfeed\GAM\Traits;

trait AdminTrait
{
    /**
     * COMPANY - ADVERTISERS
    **/
    public function get_advertisers($params=null)
    {
        return $this->_get('advertisers');
    }
    
    /**
     * GET INFO COMPANIES
    **/
    public function get_companies($params=null)
    {
        return $this->_get('companies');
    }
    
    /**
     * GET INFO COMPANIE
    **/
    public function get_company($params=null)
    {
        return $this->_get('company/' . $params['id']);
    }
}