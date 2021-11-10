<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user', 'meals')->latest()->get();
        // dd($orders);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $meals = Meal::all();
        return view('orders.create', compact('users', 'meals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data validation
        $request->validate([
            'order_type' => 'required',
            'deliver_to' => 'required',
            'user_id' => 'required_if:order_type,Out',
            'meals' => 'required'
        ]);

        // dd($request->meals);
        $meals_ids = [];
        $total = 0;
        foreach($request->meals as $meal => $quantity) {
            $item = Meal::select('price')->find($meal);
            $total += $item->price * $quantity;
            $meals_ids[$meal] = ['quantity' => $quantity];
        }

        $data = $request->except('_token', 'meals');
        // dd($request->all());
        $data['cacher_id'] = auth()->id();
        $data['total'] = $total;
        $order = Order::create($data);

        // add meals
        $order->meals()->attach($meals_ids);

        // DB::table('order_meal')->insert([])



        return redirect()->route('orders.index')->with('msg', 'Order Created Successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $meals = Meal::all();
        return view('orders.edit', compact('order', 'users', 'meals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // data validation
        $request->validate([
            'order_type' => 'required',
            'deliver_to' => 'required',
            'user_id' => 'required_if:order_type,Out',
            'meals' => 'required'
        ]);

        // dd($request->meals);
        $meals_ids = [];
        $total = 0;
        foreach($request->meals as $meal => $quantity) {
            $item = Meal::select('price')->find($meal);
            $total += $item->price * $quantity;
            $meals_ids[$meal] = ['quantity' => $quantity]; // many to many
        }

        $data = $request->except('_token', 'meals');
        // dd($request->all());
        $data['total'] = $total;
        $order->update($data);

        // add meals
        $order->meals()->sync($meals_ids);

        return redirect()->route('orders.index')->with('msg', 'Order Updated Successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('msg', 'Order Deleted Successfully')->with('type', 'info');
    }
}
