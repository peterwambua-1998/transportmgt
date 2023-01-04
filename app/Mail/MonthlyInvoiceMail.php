<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;

class MonthlyInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $invoice;
    public $amt;

    public $parentName;
    public $parentPhone;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $amt)
    {
        $this->invoice = $invoice;
        $this->amt = $amt;


        $parent = User::find($this->invoice->parent_id);

        $this->parentName = $parent->name;
        $this->parentPhone = $parent->phone_num;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.monthlyinvoice');
    }
}
