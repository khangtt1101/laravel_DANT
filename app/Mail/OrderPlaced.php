<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject('Xác nhận đặt hàng thành công - Đơn hàng #' . $this->order->order_code)
            ->view('emails.order-placed');
    }
}



