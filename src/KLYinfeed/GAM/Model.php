<?php namespace KLYinfeed\GAM;

use OutOfRangeException;
use InvalidArgumentException;

use KLYinfeed\GAM\Exceptions\NonStringTypeException,
    KLYinfeed\GAM\Exceptions\NonBooleanTypeException,
    KLYinfeed\GAM\Exceptions\NonIntegerTypeException;

class Model {
    
    /**
     * SERVER URL
     */
    const AUTH_URL = 'https://www.infeed.id/gam/oauth';

    const API_URL = 'https://www.infeed.id/gam/api';

    const API_VERSION = 'v.1';

    /**
     * Client ID
     * @var bool
     */
    protected $clientID = '';

    /**
     * Client Secret
     * @var bool
     */
    protected $clientSecret = '';

    /**
     * Redirect URL
     * @var bool
     */
    protected $redirect = '';

    /**
     * Access Token
     * @var bool
     */
    protected $accessToken = '';

    /**
     * Enable caching
     * @var bool
     */
    protected $cacheEnabled = false;
    
    /**
     * Cache duration in minutes
     *
     * @var int
     */
    protected $cacheDuration = 3600;
    
    /**
     * Cache key prefix
     *
     * @var string
     */
    protected $cacheKeyPrefix = "KLYinfeed.GAM.";
    
    /**
     * Response format. Can be either json or xml
     *
     * @var string
     */
    protected $responseFormat = "json";
    
    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        if (!empty($config))
        {
            $this->setConfig($config);
        }
    }
    
    /**
     * Set configuration
     *
     * @param array $config
     * @return \KLYinfeed\GAM\Model
     * @throws InvalidArgumentException
     */
    public function setConfig(array $config)
    {
        foreach ($config as $key => $value)
        {
            if (is_string($key))
            {
                $key = "set_" . $key;
                
                $name = $this->snakeCaseToCamelCase($key);
                
                $this->callSetter($name, $value);
            }
            else
            {
                throw new InvalidArgumentException("Invalid config key set!");
            }
        }
        return $this;
    }
    
    /**
     * Call the setter method
     *
     * @param type $name
     * @param type $value
     * @throws InvalidArgumentException
     */
    protected function callSetter($name, $value)
    {
        if (method_exists(__CLASS__, $name))
        {
            $this->{$name}($value);
            
        }
        else
        {
            throw new InvalidArgumentException("Invalid config key set!");
        }
    }
    
    /**
     * Converts snake_case to camelCase
     *
     * @param type $value
     * @return string
     * @throws NonStringTypeException
     */
    protected function snakeCaseToCamelCase($value)
    {
        if (is_string($value))
        {
            $value = str_replace(' ', '', ucwords(str_replace('_', ' ', $value)));
            
            $value = strtolower(substr($value, 0, 1)) . substr($value, 1);
            
            return $value;
            
        }
        else
        {
            throw new NonStringTypeException($value);
        }
    }
    
    /**
     * Get cache enabled
     *
     * @return bool
     */
    public function getCacheEnabled()
    {
        return $this->cacheEnabled;
    }
    /**
     * Set cache enabled
     *
     * @param bool $cacheEnabled
     * @return \KLYinfeed\GAM\Model
     * @throws NonBooleanTypeException
     */
    public function setCacheEnabled($cacheEnabled)
    {
        if (is_bool($cacheEnabled)) 
        {
            $this->cacheEnabled = $cacheEnabled;
            
            return $this;
        } 
        else 
        {
            throw new NonBooleanTypeException($cacheEnabled);
        }
    }
    
    /**
     * Get cache duration in minutes
     *
     * @return int
     */
    public function getCacheDuration()
    {
        return $this->cacheDuration;
    }
    
    /**
     * Set cache duration in minutes
     *
     * @param type $cacheDuration
     * @return \KLYinfeed\GAM\Model
     * @throws NonIntegerTypeException
     */
    public function setCacheDuration($cacheDuration)
    {
        if (is_int($cacheDuration))
        {
            $this->cacheDuration = $cacheDuration;
            
            return $this;
        }
        else
        {
            throw new NonIntegerTypeException($cacheDuration);
        }
    }
    
    /**
     * Get cache key prefix
     *
     * @return string
     */
    public function getCacheKeyPrefix()
    {
        return $this->cacheKeyPrefix;
    }
    
    /**
     * Set cache key prefix
     *
     * @param type $cacheKeyPrefix
     * @return \KLYinfeed\GAM\Model
     * @throws NonStringTypeException
     */
    public function setCacheKeyPrefix($cacheKeyPrefix)
    {
        if (is_string($cacheKeyPrefix))
        {
            $this->cacheKeyPrefix = $cacheKeyPrefix;
            
            return $this;
        }
        else
        {
            throw new NonStringTypeException($cacheKeyPrefix);
        }
    }
    
    
    /**
     * Get KLYinfeed API response format
     *
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }
    
    /**
     * Set KLYinfeed API response format
     *
     * @param string $responseFormat
     * @return \KLYinfeed\GAM\Model
     * @throws NonStringTypeException
     */
    public function setResponseFormat($responseFormat)
    {
        if (is_string($responseFormat)) 
        {
            $this->responseFormat = $responseFormat;
            
            return $this;
        }
        else
        {
            throw new NonStringTypeException($responseFormat);
        }
    }

    /**
     * Get GAM API Client ID
     *
     * @return string
     */
    public function getClientID()
    {
        return $this->clientID;
    }
    
    /**
     * Set GAM API Client ID
     *
     * @param string $clientID
     * @return \KLYinfeed\GAM\Model
     * @throws NonIntegerTypeException
     */
    public function setClientID($clientID)
    {
        if (is_numeric($clientID)) 
        {
            $this->clientID = $clientID;
            
            return $this;
        }
        else
        {
            throw new NonIntegerTypeException($clientID);
        }
    }

    /**
     * Get GAM API clientSecret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
    
    /**
     * Set GAM API clientSecret
     *
     * @param string $clientSecret
     * @return \KLYinfeed\GAM\Model
     * @throws NonStringTypeException
     */
    public function setClientSecret($clientSecret)
    {
        if (is_string($clientSecret)) 
        {
            $this->clientSecret = $clientSecret;
            
            return $this;
        }
        else
        {
            throw new NonStringTypeException($clientSecret);
        }
    }

    /**
     * Get GAM API Redirect
     *
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }
    
    /**
     * Set GAM API Redirect
     *
     * @param string $redirect
     * @return \KLYinfeed\GAM\Model
     * @throws NonStringTypeException
     */
    public function setRedirect($redirect)
    {
        if (is_string($redirect)) 
        {
            $this->redirect = $redirect;
            
            return $this;
        }
        else
        {
            throw new NonStringTypeException($redirect);
        }
    }

    /**
     * Get GAM API Access Token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->clientID;
    }
    
    /**
     * Set GAM API Access Token
     *
     * @param string $accessToken
     * @return \KLYinfeed\GAM\Model
     * @throws NonStringTypeException
     */
    public function setAccessToken($accessToken)
    {
        if (is_string($accessToken)) 
        {
            $this->accessToken = $accessToken;
            
            return $this;
        }
        else
        {
            throw new NonStringTypeException($accessToken);
        }
    }
    
}