<?php namespace KLYinfeed\GAM\Exceptions;
/**
 * Exception thrown if an argument is not String type.
 */
class NonStringTypeException extends InvalidTypeException {
    /**
     * Throwing non String type exception
     * 
     * @param any $var
     */
    public function __construct($var)
    {
        $message = $this->assembleMessage($var, 'String');
        
        parent::__construct($message);
    }
}