<?php

class ShipsFilter {

	const SMALL_SHIPS_MAX_CREW = 5;
	
	public function getSmallShips($ships) {
		$smallShips = array_filter($ships, function($elem) {
			return $elem['crew'] <= self::SMALL_SHIPS_MAX_CREW;
		});

		usort($smallShips, function($elem1, $elem2) {
			return $elem1['cost_in_credits'] <= $elem2['cost_in_credits'];  
		});

		return $smallShips;
	}

	public function getBigShips($ships) {
		$bigShips = array_filter($ships, function($elem) {
			return $elem['crew'] > self::SMALL_SHIPS_MAX_CREW;
		});

		usort($bigShips, function($elem1, $elem2) {

			// Note: if you can turn on intl in php.ini, would be nicer to use numberformatter

			$length1 = (float)str_replace(',', '', $elem1['length']);
			$length2 = (float)str_replace(',', '', $elem2['length']);

			return $length1 <= $length2;
		});

		return $bigShips;
	}
}