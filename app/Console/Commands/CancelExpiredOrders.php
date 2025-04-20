<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\offersModel;
use App\Models\Order;
use Illuminate\Console\Command;
use App\Models\UserOrder;
use Carbon\Carbon;

class CancelExpiredOrders extends Command
{
    protected $signature = 'orders:cancel-expired';
    protected $description = 'Cancel expired user orders and clean up associated orders if needed';

    public function handle()
    {
        $expiredOrders = UserOrder::where('paymentStatus', 'Belum Lunas')
            ->where('expires_at', '<=', now('Asia/Jakarta'))
            ->get();

        foreach ($expiredOrders as $userOrder) {
            $order = $userOrder->order;

            Order::where('noOffer', $order->noOffer)
                ->update(['remainingWeight' => $order->remainingWeight + $userOrder->weight,
                          'remainingVolume' => $order->remainingVolume + $userOrder->volume,
                          'totalAmount' => $order->totalAmount - $userOrder->totalPrice,
                          'remainingAmount' => $order->remainingAmount - $userOrder->totalPrice,
                          'commodities' => $order->commodities,
                        ]);
            if($order->remainingAmount - $userOrder->totalPrice == 0){
                $order->paymentStatus = 'Lunas'; 
                $order->save();
            }
            else{
                $order->paymentStatus = 'Belum Lunas'; 
                $order->save();
            }
            offersModel::where('noOffer', $order->noOffer)
                ->update(['remainingWeight' => $order->remainingWeight + $userOrder->weight,
                          'remainingVolume' => $order->remainingVolume + $userOrder->volume,
                          'commodities' => $order->commodities,
                        ]);
            
            Notification::create([
                'receiver_id' => $userOrder->user_id,
                'sender_id' => 1,
                'header' => 'Pesanan Dibatalkan',
                'description' => "Pesanan Anda dengan ID {$userOrder->order->noOffer} telah dibatalkan karena tidak melakukan pembayaran.",
                'is_read' => 0,
            ]);

            $userOrder->delete();

            $remainingCommodities = UserOrder::where('order_id', $order->id)
                ->pluck('commodities')
                ->flatMap(function ($item) {
                    return array_map('trim', explode(',', $item));
                })
                ->unique()
                ->implode(', ');

            $order->commodities = $remainingCommodities;
            $order->save();

            offersModel::where('noOffer', $order->noOffer)->update([
                'commodities' => $remainingCommodities,
            ]);


            $order->refresh();

            $userOrderCount = UserOrder::where('order_id', $order->id)->count();
            
            if ($userOrderCount === 0) {
                $order->delete();
                $this->info("Order ID {$order->id} deleted karena sudah tidak punya UserOrder.");
            }

            $this->info("Expired UserOrder {$userOrder->id} deleted.");
        }

        $this->info('Expired orders cleanup complete.');
    }

}
