<?php namespace KLYinfeed\GAM;

use Closure;
use InvalidArgumentException;

class GAM extends API
{
    /**
     * Constructor
     *
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);
    }

    /**
     * METHOD: GET
     * @param $action String action example: advertiser
     * @param $params Array optional parameters
     * @return callback
     */
    public function get($action, $callback=null, $params=null)
    {
        $this->_callFunc('get_'.$action, $callback, $params);

        return $this;
    }

    /**
     * METHOD: CREATE
     * @param $action String action example: advertiser
     * @param $params Array optional parameters
     * @return callback
     */
    public function create($action, $callback=null, $params=null)
    {
        $this->_callFunc('post_'.$action, $callback, $params);

        return $this;
    }

    /**
     * METHOD: UPDATE
     * @param $action String action example: advertiser
     * @param $params Array optional parameters
     * @return callback
     */
    public function update($action, $callback=null, $params=null)
    {
        $this->_callFunc('patch_'.$action, $callback, $params);

        return $this;
    }

    /**
     * METHOD: DELETE
     * @param $action String action example: advertiser
     * @param $params Array optional parameters
     * @return callback
     */
    public function delete($action, $callback=null, $params=null)
    {
        $this->_callFunc('delete_'.$action, $callback, $params);

        return $this;
    }

    /**
     * _CALL FUNCTION
     * @param $action String action example: advertiser
     * @param $params Array optional parameters
     * @return callback
     */
    private function _callFunc($action, $callback=null, $params=null)
    {
        if (!method_exists($this, $action))
        {
            throw new InvalidArgumentException("Invalid method!");
        }

        if ($callback instanceof Closure) 
        {
            return call_user_func($callback, $this->{$action}($params));
        }
    }
}