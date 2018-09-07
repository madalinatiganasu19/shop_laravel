<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     * @param Product $product
     * @return $this
     */
    public function build(Product $product)
    {
        $products = $product::query()->whereIn(($product)->getKeyName(), session()->get('cart'))->get();

        $total=0;
        foreach ($products as $item){
            $total += $item->price;
        }

        return $this->view('emails.order')->with([
            'products' => $products,
            'total' => $total,
        ]);
    }
}
