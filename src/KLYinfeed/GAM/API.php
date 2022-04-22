<?php namespace KLYinfeed\GAM;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

//TRAIT
use KLYinfeed\GAM\Traits\AuthTrait,
    KLYinfeed\GAM\Traits\AdminTrait,
    KLYinfeed\GAM\Traits\GeneralTrait,
    KLYinfeed\GAM\Traits\InventoryTrait,
    KLYinfeed\GAM\Traits\ReportTrait;

class API extends Model 
{
    use AuthTrait, AdminTrait, GeneralTrait, InventoryTrait, ReportTrait;
    
    /**
     * Constructor
     *
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);
    }

    /**
     * GET - Make the call and get the response from Infeed API
     *
     * @param string $action
     * @param array $params
     */
    public function _get($action, array $params = array())
    {
        if ($this->cacheEnabled) 
        {
            $cacheKey = $this->createCacheKey('get', $action, $params);
            
            // Check if the value is already cached
            if (Cache::has($cacheKey)) 
            {
                return Cache::get($cacheKey);
            }
        }
        
        $response = $this->_call('get', $action, $params);
        
        if ($this->cacheEnabled) 
        {
            Cache::put($cacheKey, $response, $this->cacheDuration);
        }
        
        return $response;
    }

    /**
     * POST - Make the call and get the response from Infeed API
     *
     * @param string $action
     * @param array $params
     */
    public function _post($action, array $params = array())
    {
        return $this->_call('post', $action, $params);
    }

    /**
     * Execute the request and return the response
     *
     * @param string $action
     * @param array $params
     * @return mixed
     */
    protected function _call($method, $action, array $params = array())
    {
        $url = static::API_URL . '/' . static::API_VERSION . '/' . $action;
        
        try {
            
            $headers = [
                'headers' => [
                    'Authorization' => "Bearer {$this->accessToken}",
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ];
            
            switch (strtolower($method)) 
            {
                case 'post':
                    
                    $client = new Client($headers);
                    $response = $client->post($url, [
                        'json' => $params
                    ]);
                    
                    break;
                    
                case 'get':                
                default:
                    
                    $client = new Client($headers);
                    $response = $client->get($url, [
                        'query' => $params
                    ]);
            }
            
            switch (strtolower($this->responseFormat)) 
            {
                case 'xml':
                    $body = $response->xml();
                    break;
                    
                case 'json':
                default:
                    $body = method_exists($response, 'json') ? $response->json() : json_decode($response->getBody());
            }
            
            
            return $body;
        } 
        catch (BadResponseException $ex) 
        {
            $response = $ex->getResponse();
            return $response->getBody()->getContents();
        }
    }

    /**
     * Create cache key
     *
     * @param string $action
     * @return type
     */
    protected function createCacheKey($method, $action, $params)
    {
        $key = $this->cacheKeyPrefix . $this->accessToken . $method . $action . json_encode($params);
        
        return sha1($key);
    }
    
}
