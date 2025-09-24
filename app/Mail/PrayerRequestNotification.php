<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PrayerRequest;

class PrayerRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $prayerRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(PrayerRequest $prayerRequest)
    {
        $this->prayerRequest = $prayerRequest;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Prayer Request Submitted')
                    ->markdown('emails.prayer-request');
    }
}
