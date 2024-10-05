<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\UserService\UserUpdateService;
use Faker\Factory as Faker;

class UpdateUserRandomCommand extends Command
{
    protected $signature = 'users:update';
    protected $description = 'Update user attributes with changes';
    protected $userUpdateService;

    public function __construct(UserUpdateService $userUpdateService)
    {
        parent::__construct();
        $this->userUpdateService = $userUpdateService;
    }

    public function handle()
    {
        $faker = Faker::create();
        $changes = [];

        $timezones = [
            'Europe/Amsterdam',
            'America/Los_Angeles',
            'CET',
            'GMT+1',
            'America/New_York',
            'Europe/London',
            'Asia/Tokyo',
            'Australia/Sydney'
        ];
        
        for ($i = 1; $i <= 2500; $i++) {
            $changes[] = [
                'email' => $faker->unique()->safeEmail,
                'name' => $faker->name,
                'time_zone' => $timezones[array_rand($timezones)],
            ];
        }

        $this->userUpdateService->updateUsers($changes);
    }
}
