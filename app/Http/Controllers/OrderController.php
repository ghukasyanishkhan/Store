<?php

namespace App\Http\Controllers;

use App\Exceptions\SessionForgetException;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class OrderController extends Controller
{

    public function order(Request $request)
    {
        $itemIds = $request->input('item_ids');
        $cardItems = Item::find($itemIds);
        try {
            $userId = $request->user()->id;
            foreach ($cardItems as $item) {
                $order = new Order();
                $order->user_id = $userId;
                $order->item_id = $item->id;
                $order->save();
            }
            session()->forget('card');
            if (session()->has('card')) {
                throw new SessionForgetException;
            }
            return back()->with('success', 'Card ordered successfully');
        } catch (SessionForgetException) {
            return back()->with('error', 'Card cannot remove from session');
        } catch (\Exception $e) {
            return back()->with('error', 'Card cannot to order');
        }
    }

    public function orderView(Request $request)
    {
        $items = [];
        try {
            $orders = $request->user()->orders()->get();
            foreach ($orders as $order) {
                $item = Item::find($order->item_id);
                if ($item) {
                    $items[] = [
                        'item' => $item,
                        'order' => $order
                    ];
                }
            }
            return view('user.components.orders', ['items' => $items]);
        } catch (\Exception) {
            return view('user.components.orders')->with('error', 'server error');
        }
    }

    public function remove(Order $order)
    {
        if ($order->delete()) {
            return back()->with('success', 'Order cancelled successfully.');
        }
        return back()->with('error', 'Failed to cancel order');
    }

    public function userOrders(User $user)
    {
        try {
            $orders = $user->orders()->get();
            if ($orders) {
                return view('dashboard', ['orders' => $orders]);
            }
            return view('dashboard')->with('error', 'User does not has orders');
        } catch (Exception) {
            return view('dashboard')->with('error', 'Server error');
        }
    }

    public function usersOrder()
    {
        try {
            $users = User::has('orders')->get();
            return view('dashboard', ['users' => $users]);
        } catch (Exception $e) {

            return redirect()->route('dashboard')->with('error', 'Server error');
        }
    }
}
