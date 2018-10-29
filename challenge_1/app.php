<?php
fwrite(STDOUT,"\n Enter the strings : \n");

$line = trim(fgets(STDIN));

$inputsArr = explode(",",$line);
$matrix = array();
$rows =0;
$cols =array();
if(count($inputsArr) > 0){
  foreach($inputsArr as $key=>$inputStr){
    $inputStr = str_replace('"',"",$inputStr);
    $matrix[$key]=str_split($inputStr,1);
    $cols[] = count(str_split($inputStr,1));
    $rows++;
  }
}
//
$cols = array_unique($cols);
if(count($cols) > 1){
  fwrite(STDOUT,"\n character length is not uniform : \n");
  exit;
}else{
  $cols = $cols[0];
}
$squareMatrix = MaximalSquare($matrix,$rows,$cols);
//get no of rows
$area = count($squareMatrix);

fwrite(STDOUT,"\n Sum of square sub matrix with all 1's  is :".pow($area,2)." \n");

//function to return the maximal square sub matrix

function MaximalSquare($matrix,$rows,$cols){
  $sum =array();

  //set the first column of sum matrix
  for($i=0;$i< $rows;$i++){
    $sum[$i][0]= $matrix[$i][0];
  }
  //set the first row of sum matrix
  for($j=0;$j < $cols;$j++){
    $sum[0][$j] = $matrix[0][$j];
  }

  for($i=1;$i<$rows;$i++){
    for($j=1;$j<$cols;$j++){
      if($matrix[$i][$j] == 1){
        $sum[$i][$j]= minimum($sum[$i][$j-1],$sum[$i-1][$j],$sum[$i-1][$j-1])+1;
      }else{
        $sum[$i][$j]=0;
      }
    }
  }

  $max_of_sum =$sum[0][0];
  $max_i = 0;
  $max_j = 0;

  for($i=0;$i<$rows;$i++){
    for($j=0;$j<$cols;$j++){
      if($max_of_sum < $sum[$i][$j]){
        $max_of_sum=$sum[$i][$j];
        $max_i = $i;
        $max_j = $j;
      }
    }
  }
  $square_matrix = array();
  for($i=$max_i;$i > ($max_i -$max_of_sum);$i--){
    for($j=$max_j;$j > ($max_j - $max_of_sum);$j--){
       $square_matrix[$i][$j] = $matrix[$i][$j];
    }
  }

  return $square_matrix;
}

function minimum($a,$b,$c){
  $min = $a;
  if($min > $b){
    $min = $b;
  }
  if($min > $c){
    $min =$c;
  }

  return $min;
}

?>
