<?php
function stockBuySell($RS_Results)
{
  $msgProfitLoss = "<div class='bg-info text-white p-3'>No record found</div>";

  if( !empty($RS_Results) )
  {
      $n = count($RS_Results);
    
      $i = 0;
      $maxProfit = 0;
      $prevPrice = 0;

      while( $i < $n - 1 )
      {
          while( ($i < $n - 1) && ($RS_Results[$i + 1]['stock_price'] <= $RS_Results[$i]['stock_price']) )
          {
              $i++;
          }
    
          if( $i == $n - 1 )
          {
              break;
          }
    
          $buyPrice = $RS_Results[$i]['stock_price'];
          $buy = $i++;
    
          while( ($i < $n) && ($RS_Results[$i]['stock_price'] >= $RS_Results[$i - 1]['stock_price']) )
          {
              $i++;
          }
    
          $sellPrice = $RS_Results[$i-1]['stock_price'];
          $sell = $i - 1;

          
          $prevPrice = $sellPrice-$buyPrice;
          if( $prevPrice > $maxProfit )
          {
              $maxProfit = $prevPrice;

              $msgProfitLoss = "<div class='bg-success text-white p-3'>Maximise Profit -> Purchase on : ".$RS_Results[$buy]['stock_date']." and Sell on day: ".$RS_Results[$sell]['stock_date']."</div>";
          }
      }
      

      if( empty($maxProfit) )
      {
        $min = PHP_INT_MIN;
        $buy = 0;
        $sell = 0;

        for( $i = 0; $i < $n - 1; $i++ )
        {
            $x = $RS_Results[$i+1]['stock_price'] - $RS_Results[$i]['stock_price'];
            
            if( $x > $min )
            {
                $min = $x;

                $buy = $i;
                $sell = $i+1;
            }
        }

        $msgProfitLoss = "<div class='bg-danger text-white p-3'>Minimum Loss -> Purchase on : ".$RS_Results[$buy]['stock_date']." and Sell on day: ".$RS_Results[$sell]['stock_date']."</div>";
      }
  }

  return $msgProfitLoss;
}
?>