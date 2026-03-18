<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\ReturnRequest;

class ReturnRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $returnRequest;

    public function __construct(Order $order, ReturnRequest $returnRequest)
    {
        $this->order = $order;
        $this->returnRequest = $returnRequest;
    }

    public function build()
    {
        return $this->subject('Từ chối đổi trả đơn hàng #' . $this->order->id)
            ->view('emails.return_rejected');
    }
}
