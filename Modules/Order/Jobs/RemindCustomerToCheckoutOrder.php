<?php

namespace Modules\Order\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\Order;
use Modules\Profile\Entities\Profile;
use Modules\Order\Emails\RemindCustomerToCheckoutOrder as RemindCustomerToCheckoutOrderMail;

class RemindCustomerToCheckoutOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order $order
     */
    protected Order $order;

    /**
     * @var Profile|mixed $customer
     */
    protected Profile $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->customer = $order->customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $timesCustomerHasBeenReminded = $this->customer->times_customer_has_been_reminded;

        if ($timesCustomerHasBeenReminded === 0) {
            $this->remindCustomerToCheckoutOrder();
        } else if ($timesCustomerHasBeenReminded === 1) {
            $this->sendCustomerACoupon();
        }

        $this->incrementTimesCustomerHasBeenReminded();
    }

    /**
     * Remind the customer of their pending order
     *
     * @return void
     */
    private function remindCustomerToCheckoutOrder()
    {
        Mail::to($this->customer->user->email)
            ->send(new RemindCustomerToCheckoutOrderMail($this->order, $this->customer));
    }

    /**
     * Send customer a coupon encouraging them to go back
     * to the website and pay for their order
     *
     * @return void
     */
    private function sendCustomerACoupon()
    {

    }

    /**
     * Increment the times the customer has been reminded by 1
     *
     * @return bool
     */
    private function incrementTimesCustomerHasBeenReminded()
    {
        return $this->order->update([
            'times_customer_has_been_reminded' => $this->order->times_customer_has_been_reminded + 1
        ]);
    }
}
