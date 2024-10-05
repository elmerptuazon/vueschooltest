<?php

namespace App\Services\UserService;
use App\Models\User;

class UserUpdateService
{
    public function updateUsers($changes)
    {
        \Log::info('Running UpdateUsersCommand start ' . now());

        $batches = $this->createBatches($changes);
        \Log::info('Running UpdateUsersCommand batches: ' . json_encode($batches));

        $this->sendBatchRequests($batches);
        \Log::info('Running UpdateUsersCommand end ' . now());
    }

    protected function createBatches($changes)
    {
        $batches = [];
        foreach (array_chunk($changes, 1000) as $chunk) {
            $batches[] = ['subscribers' => $chunk];
        }
        return $batches;
    }

    protected function sendBatchRequests($batches)
    {
        foreach ($batches as $batch) {
            foreach ($batch['subscribers'] as $subscriber) {
                $email = $subscriber['email'];
                $firstName = $subscriber['firstname'] ?? 'N/A';
                $lastName = $subscriber['lastname'] ?? 'N/A';
                $timeZone = $subscriber['timezone'] ?? 'N/A';
                // User::where('email', $subscriber['email'])->update($subscriber);
                echo "[$email] firstname: $firstName, lastname: $lastName, timezone: '$timeZone'\n";
            }
        }
    }
}
