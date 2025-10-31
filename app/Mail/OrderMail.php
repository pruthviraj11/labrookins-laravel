<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
  use Queueable, SerializesModels;

  public $order;
  public $product_data;

  public function __construct($order, $product_data)
  {
    // dd($product_data);
    $this->order = $order;
    $this->product_data = $product_data;
  }

  public function build()
  {
    return $this->subject('Your Order Details')
      ->markdown('emails.orders.mail');
  }
}
