<?php
require_once 'SaleTerminal.php';
fwrite(STDOUT,"\n Scan the Products : \n");

$line = trim(fgets(STDIN));
$total = array();

$terminal = new SaleTerminal();

$products = array('A'=>array('1'=>2.00, '4'=>7.00), 'B'=>array('1'=>12.00), 'C'=>array('1'=>1.25, '6'=>6.00), 'D'=>array('1'=>0.15));

//set the product pricing
$terminal->setPricing($products);
//convert the input string to array
$productArray = str_split($line, 1);
//convert the array into elements as Key and Frequency/count as values
$productFrequency = array_count_values($productArray);

foreach($productFrequency as $product=>$quantity){
    $product = strtoupper($product);
    if(in_array($product,array_keys($products))){
      $terminal->scan($product,$quantity);
    }else{
        fwrite(STDOUT,"\n $product : Product info missing ! Kindly update the inventory \n");
    }
}

$totalBill = $terminal->getTotal();

fwrite(STDOUT,"\n Total bill amount  : $ $totalBill  \n");

 ?>
