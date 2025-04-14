<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CardOffer;

class CardOfferController extends Controller
{
    public function madari()
    {
        $offers = CardOffer::all();
        return view('card_offers', compact('offers'));
    }
}
