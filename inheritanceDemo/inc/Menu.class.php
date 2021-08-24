<?php

//Class Menu
class Menu {

	//Build an array for menu.
	public $menuItems = array();

	//Build an array for each class type for all the classes.
	public $pizzas = array();
	public $drinks = array();

	//This function returns a flat array of objects and puts them to $this->menuItems
	function parseMenuData($fileContents)   {

		//Lines
		$lines = explode("\n",$fileContents);
		//Walk the lines
		for ($i = 1; $i < count($lines); $i++) {
			//Pull the columns
			$columns = explode("|",$lines[$i]);

			//If the class is Pizza
			if ( $columns[0] == "pizza" ) {
				//Parse the different kinds of pizza
				switch ($columns[1])    {
				
					case "Basics"://Make a new pizza Basics
						$item = new Basics($columns[2],$columns[3]);
					break;

					case "Veggie"://Make a new pizza Veggie
						$item = new Veggie($columns[2],$columns[3]);
					break;

					case "Meat"://Make a new pizza Meat
						$item = new Meat($columns[2],$columns[3]);
					break;

					case "Chicken"://Make a new pizza Chicken
						$item = new Chicken($columns[2],$columns[3]);
					break;
				}
			}
			//Or if its a Drink
			if ( $columns[0] == "drink" ) {

				//Parse the different kinds of drinks
				switch ($columns[1])    {
					case "Juice"://Make a new drink Juice
						$item = new Juice($columns[2]);
					break;
					case "Pop"://Make a new drink Pop
						$item = new Pop($columns[2]);
					break;
				}
			}
			//Add the item
			$this->menuItems[] = $item;

		}

	}

	/* Build the menu into specific categories based on the subclass and the class name
	* Pizzas should go in the pizzas array
	* Drinks should go in the drinks array
	*/

	function buildMenu() {

		//Walk through the entire menu, put each item in its respective array by class and type. HINT use is_subclass_of
		foreach ($this->menuItems as $item) {
			//var_dum($this->menu);
			//If it's a Drink (check is_subclass_of)
			if (is_subclass_of($item, "Drink"))   {
				//Check what type. HINT use gettype
				//Use getClass
				switch (get_class($item)) {

					//If it's Pop
					case "Pop"://Add to the drinks array with the key "pop"
						$this->drinks["pop"][] = $item;
					break;

					//If it's Juice
					case "Juice"://Add to the drinks array with the key "juice"
						$this->drinks["juice"][] = $item;
					break;

					default:
						Page::notify(array("Problem we dont know where to put this drink!". get_class($item)));
					break;
				}
			}

			//If it's Pizza (check is_subclass_of)
			if (is_subclass_of($item, "Pizza"))   {

				//Use getClass
				switch (get_class($item)) {
					case "Basics"://Add to the pizzas array with the "basics" key
						$this->pizzas["basics"][] = $item;
					break;

					case "Veggie"://Add to the pizzas array with the "basics" key
						$this->pizzas["veggie"][] = $item;
					break;
					
					case "Chicken"://Add to the pizzas array with the "basics" key
						$this->pizzas["chicken"][] = $item;
					break;

					case "Meat"://Add to the pizzas array with the "basics" key
						$this->pizzas["meat"][] = $item;
					break;

					default:
						Page::notify(array("Problem we dont know where to put this Pizza". get_class($item)));
					break;
				}
			}
		}
		//Sort the arrays
		ksort($this->pizzas,SORT_STRING);
		ksort($this->drinks,SORT_STRING);
	}
}
?>