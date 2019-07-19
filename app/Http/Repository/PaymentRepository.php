<?php

namespace App\Http\Repository;


class PaymentRepository 
{
        
    public static function calHcashLimitByOrder($order_amount, $hcash_detail){
        $hcashMaxUsagePoint = $hcash_detail['maxUsablePoints'];
        $walletPoint = $hcash_detail['walletPoint'];
        $ecashAmount = 0;
        if($walletPoint>0) {
            if($hcashMaxUsagePoint >= $order_amount) {
                if($order_amount >= $walletPoint) {
                    if($walletPoint >= $hcashMaxUsagePoint) {
                        $ecashAmount = $hcashMaxUsagePoint;
                    }
                    else {
                        $ecashAmount = $walletPoint;
                    }             
                }
                else {
                    $ecashAmount = $order_amount;
                }
            }
            else {
                if($walletPoint >= $hcashMaxUsagePoint) {
                    $ecashAmount = $hcashMaxUsagePoint;
                }
                else {
                    $ecashAmount = $walletPoint;
                }
            }
        }    

        return $ecashAmount;
    }
}