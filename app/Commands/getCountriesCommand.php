<?php

namespace App\Commands;

use Illuminate\Support\Facades\Request;
use App\Commands\Command;
//use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response;

class getCountriesCommand extends Command 
{

    use DispatchesJobs;

    /**
     * @var string
     */
    private $apiURL = 'http://restcountries.eu/rest/v1/all';

    /**
     * Create a new command instance.
     * getCountriesCommand constructor.
     */
    public function __construct(){

    }

    /**
     *  Execute the command.
     * @return mixed
     */
    public function handle(){
        $result = [];
        $countries = [];

        $client = new GuzzleClient;

        $response = $client->request('GET', $this->apiURL);
        $data = json_decode($response->getBody()->getContents());

        /**
         * @var Response $response
         */
        if (is_array($data)) {

            foreach ($data as $country){
                $countries[] = $country->name.'|'.$country->alpha2Code.'|'.$country->alpha3Code;
            }

            asort($countries);

            $result = [];
            foreach ($countries as $countryAndCode){
                $countryAndCodeArray = explode('|', $countryAndCode);
                $result[] = [
                    "name" => $countryAndCodeArray[0],
                    "code" => $countryAndCodeArray[1],
                    "code_three" => $countryAndCodeArray[2]
                ];
            }
        }

        return $result;
    }
}
