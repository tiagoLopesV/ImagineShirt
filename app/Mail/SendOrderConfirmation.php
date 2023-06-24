<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param  array  $details
     * @param  string  $pdfPath
     * @return void
     */
    public function __construct($details, $pdfPath)
    {
        $this->details = $details;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
                    ->to($this->details['email']) 
                    ->view('order.pdfFile') 
                    ->attach($this->pdfPath, [
                        'as' => 'order_confirmation.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
