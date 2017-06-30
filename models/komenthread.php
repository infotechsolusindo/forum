<?php
class KomenThread extends Komen implements IKomen 
{
	public function setTipe($tipe='thread'){
		$this->tipe = $tipe;
	}
}