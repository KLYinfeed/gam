<?php namespace KLYinfeed\GAM\Traits;

trait AuthTrait
{
    /**
     * REQUEST ACCESS TOKEN
     * @param $scopes array optional
     * @return redirect to authorization page
    **/
    public function requestAccessToken($scopes=[])
    {
        \Session::put('state', $state = \Str::random(40));

        $query = http_build_query([
            'client_id' => $this->clientID,
            'redirect_uri' => $this->redirect,
            'response_type' => 'code',
            'scope' => $scopes,
            'state' => $state,
        ]);

        return redirect(static::AUTH_URL.'/authorize?'.$query);
    }

    /**
     * CALLBACK
     * @return JSON Access Token
    **/
    public function callback()
    {
        if( request('error') )
        {
            return request('description', request('error'));
        }
        elseif( request('code') )
        {
            $state = \Session::pull('state');

            if( $state != request('state') )
            {
                return abort(401);
            }

            $http = new \GuzzleHttp\Client;

            $response = $http->post(static::AUTH_URL.'/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->clientID,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri' => $this->redirect,
                    'code' => request('code'),
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        }
    }

    /**
     * GET INFO CURRENT LOGIN
    **/
    public function me()
    {
        return $this->_get('me');
    }
}