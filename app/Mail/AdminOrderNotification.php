<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $cartItems, $subtotal, $tax, $shipping, $total;

    public function __construct($order, $cartItems, $subtotal, $tax, $shipping, $total)
    {
        $this->order = $order;
        $this->cartItems = $cartItems;
        $this->subtotal = $subtotal;
        $this->tax = $tax;
        $this->shipping = $shipping;
        $this->total = $total;
    }

    public function build()
    {
        return $this->subject('🛒 New Order Placed - #' . $this->order->id)
                    ->view('emails.admin_order_notification');
    }
}

