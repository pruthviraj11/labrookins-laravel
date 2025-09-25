<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Scheduling;

class SchedulingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $scheduling;

    /**
     * Create a new message instance.
     */
    public function __construct(Scheduling $scheduling)
    {
        $this->scheduling = $scheduling;
    }

    /**
     * Build the message.
     */
    public function build()
    {

       $eventName = $this->scheduling->event_name ?? 'Ministry Event';

        return $this->subject('📅 New Scheduling Request: ' . $eventName . ' - ' . $this->scheduling->name)
                    ->view('emails.scheduling');


        // return $this->subject('New Scheduling Form Submission')
        //             ->markdown('emails.scheduling');
    }
}
