<?php
class KomenKegiatan extends Komen implements IKomen 
{
	public function setTipe($tipe='kegiatan'){
		$this->tipe = $tipe;
	}
}
