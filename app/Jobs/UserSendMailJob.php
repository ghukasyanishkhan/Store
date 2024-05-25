<?php

namespace App\Jobs;

use App\Mail\UserMessageToAdmin;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;

class UserSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;


    /**
     * Create a new job instance.
     *
     * @param array $data
     */

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        Log::info('UserSendMailJob job started.', ['data' => $this->data]);
        try {
            Mail::send(new UserMessageToAdmin($this->data));
            Log::info('UserSendMailJob job completed.');
        } catch (UnexpectedResponseException $e) {
            Log::error('UnexpectedResponseException: ' . $e->getMessage());
            throw new Exception('You provided a wrong email address.');
        } catch (Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            throw new Exception('Your message was not sent.');
        }
    }
}
