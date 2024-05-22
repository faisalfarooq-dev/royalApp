<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use App\Services\ApiRequestService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

class CreateAuthorCommand extends Command
{
    use WithFaker;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $url = config('api.url', false);
            $api_request_service = new ApiRequestService();
            $faker = Faker::create();
            $author_data = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'birthday' => Carbon::now()->subYears(10),
                'biography' => $faker->text(20),
                'gender' => 'male',
                'place_of_birth' => $faker->city,
            ];

            $login_credentials = [
                'email' => config('mail.admin_email', 'ahsoka.tano@royal-apps.io'),
                'password' => config('mail.password', 'Kryze4President'),
            ];

            $auth_response = $api_request_service->authenticateApi($login_credentials);

            $auth_response = Helper::postRequestFromCommand($auth_response['token_key'])
                ->post($url . 'authors', $author_data);

            if (isset($auth_response['code'])) {
                throw new Exception($auth_response['message']);
            }

        } catch (Exception $e) {
            Log::error('error in create author command and the error is => ', [$e->getMessage()]);
        }
    }
}
