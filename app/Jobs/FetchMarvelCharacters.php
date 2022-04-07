<?php

namespace App\Jobs;

use App\Libraries\Marvel;
use App\Models\Character;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchMarvelCharacters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $http = new Client([
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $verb = 'GET';
        $serverSideParams = Marvel::getServerSideParams();
        $url = config('services.marvel.endpoint') . "?$serverSideParams";

        try {
            $response = $http->request($verb, $url);
            $responseBody = json_decode($response->getBody(), true);
            Log::info('Marvel Characters: ', [
                'offset' => $responseBody['data']['offset'],
                'limit' => $responseBody['data']['limit'],
                'total' => $responseBody['data']['total'],
                'count' => $responseBody['data']['count'],
            ]);

            $results = $responseBody['data']['results'];
            // Write results to DB
            foreach ($results as $result) {
                $character = new Character();
                $character->unique_id = $result['id'];
                $character->name = $result['name'];
                $character->description = $result['description'];
                $character->modified = $result['modified'];
                $character->resource_uri = $result['resourceURI'];
                $character->thumbnail = json_encode($result['thumbnail']);
                $character->comics = json_encode($result['comics']);
                $character->series = json_encode($result['series']);
                $character->stories = json_encode($result['stories']);
                $character->events = json_encode($result['events']);
                $character->urls = json_encode($result['urls']);
                $character->save();
            }

        } catch (ClientException|GuzzleException $e) {
            report($e);
        }
    }
}
