<?php
  class LineItem {
		private $item;
		private $quantity;

	 	public function __construct($item, $quantity) {
			$this -> item = $item;
			$this -> quantity = $quantity;
	  	}

	  	public function __toString() {
			return "Item = ".$this -> item." : Quantity =  ".$this -> quantity;
		}
	
		public function getQuantity(){
			return $this->quantity;
		}
	
		public function changeQuantity($value){
			$this->quantity += $value;
		}
	
		public function getItem(){
			return $this->item;
		}
}