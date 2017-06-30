<?php
class KomenKarir extends Komen implements IKomen 
{
	public function setTipe($tipe='karir'){
		$this->tipe = $tipe;
	}
}
