<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaymentStatus extends Component
{
    public $message;
    public $type;
    public function __construct($message)
    {
        $this->message = $message;
        switch($message){
            case "Paid":
                $this->type = "success";
                break;
            case "Due":
                $this->type = "danger";
                break;
            case "Pending":
                $this->type = "warning";
                break;

        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-status');
    }
}
