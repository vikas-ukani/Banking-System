<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenerateTransactionPDF extends Mailable
{
    use Queueable, SerializesModels;


    public $transactions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $this->transactions
        return $this->view('mail.transactions');
    }
}
