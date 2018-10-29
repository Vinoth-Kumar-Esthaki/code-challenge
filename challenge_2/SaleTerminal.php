<?php
class SaleTerminal{
  private $pricing;
  private $total;

  public function setPricing($products){
    $this->pricing= $products;
  }
  public function getPricing($products){
    return $this->pricing;
  }
  public function scan($code,$quantity){
    if(isset($this->pricing[$code]) && count($this->pricing[$code]) > 1){
      $product = $this->pricing[$code];
      $groupUnit = max(array_keys($product));
      $subTotal = intval($quantity/$groupUnit) * $product[$groupUnit] + fmod($quantity,$groupUnit) * $product[1];
      $this->setTotal($subTotal);
    }elseif(isset($this->pricing[$code])){
      $product = $this->pricing[$code];

      $subTotal = $quantity * $product['1'];
      $this->setTotal($subTotal);
    }
  }
  public function getTotal(){
    return $this->total;
  }
  public function setTotal($subTotal){
    $this->total+=$subTotal;
  }
}
 ?>
