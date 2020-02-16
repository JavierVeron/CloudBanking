<?php
class Coche {
	protected $color;
	//protected $potencia;
	//public $marca;

	public function setColor($color) {
		$this->color = $color;
	}

	public function getColor() {
		return $this->color;
	}

	/*public function getPotencia() {
		return $this->potencia;
	}

	public function getMarca() {
		return $this->marca;
	}*/

	public function printGetCaracteristicas() {
		echo "Color: " .$this->color;
	}
}

class cocheDeLujo extends Coche {
	private $extras;

	public function setExtras($extras) {
		$this->extras = $extras;
	}

	public function getExtras() {
		return $this->extras;
	}

	public function printGetCaracteristicas() {
		echo "Color: " .$this->color;
		echo "<br>"; 
		echo "Extras: ".$this->extras;
	}

	/*public function displayColor() {
		return $this->color;
	}

	public function displayPotencia() {
		return $this->potencia();
	}

	public function displayMarca() {
		return $this->marca;
	}*/
}

/*$miCoche = new Coche();
$miCoche->setColor("Rojo");
$miCoche->potencia = 120;
$miCoche->marca = "Audi";

$miCoche2 = new Coche();
$miCoche2->setColor("Azul");
$miCoche2->potencia = 140;
$miCoche2->marca = "Ford";
echo "<p>El auto es de color: <b>" .$miCoche->getColor() ."</b></p>";*/

$miCoche = new cocheDeLujo();
$miCoche->setColor("Negro");
$miCoche->setExtras("TV");
$miCoche->printGetCaracteristicas();
?>