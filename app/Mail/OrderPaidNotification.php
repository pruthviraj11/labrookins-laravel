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

  public $order, $digitalProducts, $cartItems, $subtotal, $tax, $shipping, $total;

  public function __construct($order, $digitalProducts = [], $cartItems = [], $subtotal, $tax, $shipping, $total)
  {
    $this->order = $order;
    $this->digitalProducts = $digitalProducts;
    $this->cartItems = $cartItems;
    $this->subtotal = $subtotal;
    $this->tax = $tax;
    $this->shipping = $shipping;
    $this->total = $total;
  }

  public function build()
  {
    // return $this->subject('Order Confirmation - Order #' . $this->order->id)
    //   ->view('emails.order_confirmation');
    $mail = $this->subject('Order Confirmation - Order #' . $this->order->id)
      ->view('emails.order_confirmation');

    if (!empty($this->digitalProducts)) {
      // Attach all digital products (if any)
      foreach ($this->digitalProducts as $digital) {
        $filePath = storage_path('app/public/products/documents/' . basename($digital['url']));
        if (file_exists($filePath)) {
          $mail->attach($filePath, [
            'as' => $digital['name'] . '.' . pathinfo($filePath, PATHINFO_EXTENSION),
            'mime' => mime_content_type($filePath),
          ]);
        }
      }
    }

    return $mail;
  }
}
