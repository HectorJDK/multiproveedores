<?php

class PastOrder
{
    var $unitary_price;
    var $quantity;
    var $product;
    var $total;
    var $date;
    var $rating;

    public function PastOrder($product, $quantity, $unitary_price, $date, $rating)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->unitary_price = $unitary_price;
        $this->total = $this->quantity * $this->unitary_price;
        $this->date = $date;
        $this->rating = $rating;
    }

}