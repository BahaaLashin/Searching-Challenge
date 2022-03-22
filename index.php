<?php 

function SearchingChallenge($strArr) {

  // code goes here
  // define charlie location and food points
  $x = 0;
  $y = 0;
  $food = [];
  for ($i = 0 ; $i < sizeof($strArr) ; $i++)
  {
    if (strpos($strArr[$i],'C')){
      $x = $i;
      $y = strpos($strArr[$i],'C');
    }

    if (strpos($strArr[$i],'H')){
      $Hx = $i;
      $Hy = strpos($strArr[$i],'H');
    }

    $list_of_items = str_split($strArr[$i]);
    for ($z = 0 ; $z < sizeof($list_of_items) ; $z++)
    {
      if ($list_of_items[$z] == 'F'){
        array_push($food,[$i,$z]);
      }
    }

  }
  $current_point_x = $x;
  $current_point_y = $y;
  $delete_points = [];
  $total_steps = 0;
  foreach ($food as $pointFood)
  {
    $learning_rate = 100;
    foreach ($food as $pointFoodCheck)
    {
        $steps = abs($current_point_x - $pointFoodCheck[0]) + abs($current_point_y - $pointFoodCheck[1]);
      
        if ($learning_rate > $steps && !in_array($pointFoodCheck,$delete_points))
        {
          $learning_rate = $steps;
          $current_point_x = $pointFoodCheck[0];
          $current_point_y = $pointFoodCheck[1];
        }
    }
    array_push($delete_points,[$current_point_x,$current_point_y]);    
    $total_steps+=$learning_rate;
  }
  // go to home 
  $go_to_home_steps = abs($current_point_x - $Hx) + abs($current_point_y - $Hy);
  $total_steps = $total_steps + $go_to_home_steps;
  return $total_steps;

}
   
// keep this function call here  
echo SearchingChallenge(fgets(fopen('php://stdin', 'r')));  

?>
