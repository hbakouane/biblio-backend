<?php

namespace Modules\Order\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Order\Entities\Order;
use Modules\Profile\Entities\Profile;

class RemindCustomerToCheckoutOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order $order
     */
    protected Order $order;

    /**
     * @var Profile|mixed $customer
     */
    protected Profile $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, Profile $customer)
    {
        $this->order = $order;

        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('order::mails.remind_customer_to_checkout')
            ->subject(__('app.mail.reminder_subject', ['name' => $this->customer->user->name]))
            ->with([
                'order' => $this->order,
                'customer' => $this->customer
            ]);
    }
}
