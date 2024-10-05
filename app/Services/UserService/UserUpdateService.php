<?php

namespace App\Services\UserService;

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
                $firstName = $subscriber['name'] ?? 'N/A';
                $timeZone = $subscriber['time_zone'] ?? 'N/A';
                echo "[$email] firstname: $firstName, timezone: '$timeZone'\n";
            }
        }
    }
}
