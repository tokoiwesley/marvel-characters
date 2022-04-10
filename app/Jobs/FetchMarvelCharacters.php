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
        ini_set('memory_limit', '256M');

        $http = new Client([
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $verb = 'GET';
        $serverSideParams = Marvel::getServerSideParams();
        $limit = 100; // Set limit of number of resources in the result
        $url = config('services.marvel.endpoint') . "?$serverSideParams&limit=$limit";

        try {
            // Attempt retrieving the first set of characters
            $response = $http->request($verb, $url);
            $responseBody = json_decode($response->getBody(), true);

            $offset = $responseBody['data']['offset']; // Set character resources offset
            $limit = $responseBody['data']['limit']; // Set character resources limit for result
            $total = $responseBody['data']['total']; // Set number of all character resources

            Log::info('Marvel Characters: ', [
                'offset' => $offset,
                'limit' => $limit,
                'total' => $total,
                'count' => $responseBody['data']['count'],
            ]);

            $results = $responseBody['data']['results'];
            // Write results to DB
            foreach ($results as $result) {
                $this->saveCharacter($result);
            }

            // Check for more sets of characters
            if ($total > $limit) {
                // Update the offset for the second set of characters
                $offset += $limit;
                // Generate URLs for fetching the rest of the characters
                $urls = [];
                for ($i = 0; $offset <= $total; $i++, $offset += $limit) {
                    $urls[$i] = config('services.marvel.endpoint') . "?$serverSideParams&limit=$limit&offset=$offset";
                }

                // Fetch the rest of the characters
                foreach ($urls as $url) {
                    sleep(15);
                    Log::info('New URl: ', [$url]);
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
                        $this->saveCharacter($result);
                    }
                }
            }
        } catch (ClientException|GuzzleException $e) {
            report($e);
        }
    }

    /**
     * @param $result
     * @return void
     */
    private function saveCharacter($result): void
    {
        Character::create([
            'unique_id' => $result['id'],
            'name' => $result['name'],
            'description' => $result['description'],
            'modified' => $result['modified'],
            'resource_uri' => $result['resourceURI'],
            'thumbnail' => $result['thumbnail'],
            'comics' => $result['comics'],
            'series' => $result['series'],
            'stories' => $result['stories'],
            'events' => $result['events'],
            'urls' => $result['urls'],
        ]);
    }
}
