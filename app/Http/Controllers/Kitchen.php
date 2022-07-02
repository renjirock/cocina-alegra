<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Prescription;
use App\Models\Order;

class Kitchen extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function create_order()
    {
        try {
            $new_order = new Order;

            $prescriptions = Prescription::all();
            $number_of_prescriptions = count($prescriptions);
            $prescription_to_use = rand(0, $number_of_prescriptions);
            $prescription = $prescriptions[$prescription_to_use];

            $new_order->prescription_id = $prescription->id;
            $new_order->is_available = false;
            $new_order->save();
            return redirect()->route('orders')->with('success', 'Creado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('index')->with('warning', 'Se genero un error');
        }

    }

    public function create_prescription(Request $request)
    {
        $new_prescription = new Prescription;
        $new_prescription->name = $request->input('name');
        $new_prescription->ingredients = $request->input('ingredients');
        $new_prescription->is_finished = false;
        if($new_prescription->save())
        {
            return 'ok';
        }
        else
        {
            return 'error';
        }
    }

    public function get_orders()
    {
        try {
            $orders = Order::all();
            $return_order = array();
            foreach ($orders as $order) {
                $get_prescription = Prescription::select('name')->where('id', $order->prescription_id)->first();
                array_push($return_order,
                    [
                        'id' => $order->id,
                        'name'          => $get_prescription->name,
                        'is_available'  => $order->is_available ? 'terminada ' : 'En preparacion',
                        'created_at'    => $order->created_at,
                    ]
                );
            }
            return view('orders', ['orders' => $return_order]);
        } catch (\Throwable $th) {
            return redirect()->route('index')->with('warning', 'Se genero un error');
        }

    }

    public static function get_orders_not_finished()
    {
        $orders = Order::where('is_available', false)->get();
        return $orders;
    }

    public static function get_prescription($id)
    {
        $prescription = Prescription::find($id);
        return $prescription;
    }

    public static function finish_order($id)
    {
        try {
            $order = Order::find($id);
            $order->is_available = true;
            $order->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
