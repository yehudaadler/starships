<?php

require_once('ShipsFilter.php');

class ShipsTest extends \PHPUnit\Framework\TestCase
{

	private $shipsFilter;

	private $executor;
	private $deathStar;
	private $millenniumFalcon;
	private $xWing;

	public function setUp() {

		$this->shipsFilter = new ShipsFilter();

		$this->executor = $this->buildShip('Executor', '279144', '1143350000', '19000');
		$this->deathStar = $this->buildShip('Death Star', '342953', '1000000000000', '120000');
		$this->millenniumFalcon = $this->buildShip('Millennium Falcon', '4', '100000', '34.37');
		$this->xWing = $this->buildShip('X-wing', '1', '149999', '12.5');
	}
	public function tearDown() { }

	public function test2OfEach() {

		$ships = array(
			$this->executor,
			$this->deathStar,
			$this->millenniumFalcon,
			$this->xWing,
		);

		$smallShips = $this->shipsFilter->getSmallShips($ships);

		$this->assertEquals(count($smallShips), 2);
		$this->assertTrue($smallShips[0]['cost_in_credits'] >= $smallShips[1]['cost_in_credits']);

		$bigShips = $this->shipsFilter->getBigShips($ships);

		$this->assertEquals(count($bigShips), 2);
		$this->assertTrue($bigShips[0]['length'] >= $bigShips[1]['length']);

	}

	private function buildShip($name, $crew, $cost, $length) {
		return array(
			'name' => $name,
			'crew' => $crew,
			'cost_in_credits' => $cost,
			'length' => $length,
		);
	}

}