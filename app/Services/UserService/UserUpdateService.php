<?php

namespace App\Services;

class UserUpdateService
{
    public function updateUsers($changes)
    {
        // Create batches
        $batches = $this->createBatches($changes);

        // Send requests (logging instead of calling API)
        $this->sendBatchRequests($batches);
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
                // Log the update message
                $email = $subscriber['email'];
                $firstName = $subscriber['name'] ?? 'N/A';
                $timeZone = $subscriber['time_zone'] ?? 'N/A';
                echo "[$email] firstname: $firstName, timezone: '$timeZone'\n";
            }

            // Sleep or wait for the appropriate interval to stay within limits if needed
            sleep(72); // Assuming 50 requests can be made in 3600 seconds
        }
    }
}
