<?php

namespace App\Http\Controllers;

use App\Exceptions\SessionForgetException;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class CardController extends Controller
{

    public function viewCard()
    {

        $cardItemsId = session()->get('card');
        if (!empty($cardItemsId)) {
            $cardItems = Item::whereIn('id', $cardItemsId)->get();
            return view('user.components.card', ['cardItems' => $cardItems]);
        }
        return view('user.components.card');
    }

    public function add($itemId)
    {
        try {
            $itemIds = session()->get('card', []);
            $index = array_search($itemId, $itemIds);
            if ($index === false) {
                session()->push('card', $itemId);
            }
            return redirect()->back()->with('success', 'Item added to card successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Item does not added to card.');
        }

    }

    public function remove(Item $item)
    {
        $itemId = $item->id;
        $cardItemsId = session()->get('card', []);

        $index = array_search($itemId, $cardItemsId);

        if ($index !== false) {
            unset($cardItemsId[$index]);
            session()->put('card', $cardItemsId);
        }

        return redirect()->back()->with('success', 'Item removed from card successfully.');
    }
}
