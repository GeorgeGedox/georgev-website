<?php

namespace App\Classes;


use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

class DribbbleAPI
{
    protected $apiBase;

    /**
     * @var Client
     */
    protected $__client;
    protected $__token = null;

    public function __construct($token = null)
    {
        $this->apiBase = config('services.dribbble.api_base');

        $config = ['base_uri' => $this->apiBase];

        if (!empty($token)) {
            $this->__token = $token;
            $config = Arr::add($config, 'Authorization', "Bearer {$this->__token}");
        }

        $this->__client = new Client($config);
    }

    public static function generateAuthorizationURL($client_id, $redirect_uri = null)
    {
        return "https://dribbble.com/oauth/authorize?client_id={$client_id}&redirect_uri={$redirect_uri}";
    }

    /**
     * @param $code String Code returned from the authorization callback
     * @param $redirect_uri String URL where users will be sent
     * @return array Array containing the 'access_token' needed for future requests
     */
    public function authenticate($code, $redirect_uri = null)
    {
        $params = [
            'client_id' => config('services.dribbble.client_id'),
            'client_secret' => config('services.dribbble.client_secret'),
            'code' => $code
        ];

        if ($redirect_uri){
            $params = Arr::add($params, 'redirect_uri', $redirect_uri);
        }

        $response = $this->__client->post('https://dribbble.com/oauth/token',[
            'form_params' => $params
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->__token = $data['access_token'];

        return $data;
    }

    /**
     * @param int $perPage
     * @return mixed
     * @throws \Exception
     */
    public function listShots(int $perPage = null){
        if (!$this->__token){
            throw new \Exception('No API token given!');
        }

        $uri = 'user/shots';
        if (isset($perPage)){
            $cachePagination = Cache::get('dribbble.shots.pagination');
            if ($cachePagination !== $perPage){
                Cache::forever('dribbble.shots.pagination', $perPage, 7200);
                Cache::forget('dribbble.shots');
            }
            $uri .= "?per_page={$perPage}";
        }

        $data = Cache::remember('dribbble.shots', 7200, function () use ($uri){
            $response = $this->__client->get($uri, [
                'headers' => [
                    'Authorization' => "Bearer {$this->__token}"
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        });

        return $data;
    }
}