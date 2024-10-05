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

        $this->userUpdateService->updateUsers($changes);
    }
}
