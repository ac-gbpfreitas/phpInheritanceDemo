<?php

//Class Pizza
class Pizza {
    public $item = "";
    public $description = "";
    public $price = 9.99;

	public function Pizza($nItem,$nDescription) {
		$this->item = $nItem;
		$this->description = $nDescription;
	}

}

?>