<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaidNotification extends Mailable
{
  use Queueable, SerializesModels;

  public $order;
  public $digitalProducts;

  public function __construct($order, $digitalProducts = [])
  {
    $this->order = $order;
     $this->digitalProducts = $digitalProducts;
  }

  public function build()
  {
    return $this->subject('Order Confirmation - Order #' . $this->order->id)
      ->view('emails.order_confirmation');
  }
}
