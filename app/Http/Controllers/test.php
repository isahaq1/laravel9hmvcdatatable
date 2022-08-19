<?php

                $orderIds = $orders->with('orderDetails')->cursor()->pluck('id')->toArray();
                $orderDetails = $orderDetails->with('product')
                                            ->whereIn('order_id',   $orderIds)
                                            ->cursor();
                foreach($orderDetails as $details){
                    if($details->product){
                        $totalSaleQty += (($details->case_qty * $details->product->unit_per_case) + $details->unit_qty);
                        $totalPresaleQty += (($details->order_case_qty * $details->product->unit_per_case) + $details->order_unit_qty);
                    }
                }

                $totalSaleAmount = ($totalSaleQty * $orderDetails->sum('price'));
                $averageSaleQty = $this->averageSaleQty($totalSaleQty , $orderDetailsUq1);
                $totalOrderIdByDays = $orderDetails->select('order_id')->distinct()->pluck('order_id')->toArray();
                $totalUser = $orders->select('user_id')->distinct()->get()->count();
                $totalVisitOrder = $orderDetails->select('order_id')->distinct()->get()->count();
                $totalOrderDayWise = $orders->whereIn('id',  $totalOrderIdByDays)->select('order_date')->distinct()->get()->count();
                if($totalSaleQty > 0){
                    $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
                    $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
                    $avgCallageByVisitsPerDay =  $totalSaleQty /  $totalOrderDayWise;
                }
                if($totalSaleAmount > 0){
                    $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
                }







