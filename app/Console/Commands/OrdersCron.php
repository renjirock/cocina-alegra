<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Bodega;
use App\Http\Controllers\Kitchen;
use Illuminate\Support\Facades\Storage;

class OrdersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at ". now());

        try {
            $orders = Kitchen::get_orders_not_finished();

            if(count($orders) == 0)
            {

            }

            foreach ($orders as $key => $order) {
                if ($key > 50) {
                    break;
                }
                $prescipton = Kitchen::get_prescription($order->prescription_id);
                $ingredients_id = explode(', ', $prescipton->ingredients);
                foreach ($ingredients_id as $ingredient_id)
                {
                    $unit = Bodega::ingredient_is_available($ingredient_id);
                    if ($unit)
                    {
                        Bodega::subtract_ingredient($ingredient_id);
                        Kitchen::finish_order($order->id);
                    }
                    else
                    {
                        $buy_unit = Bodega::buy_ingredients($ingredient_id);
                        if ($buy_unit)
                        {
                            Bodega::subtract_ingredient($ingredient_id);
                            Kitchen::finish_order($order->id);
                        }
                        else
                        {
                            break;
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }



        return 0;
    }
}
