<?php
	
	class Pais {
		private $cd_pais;
		private $ds_pais;
		
		//M�todo constructor 
		

		function Pais() {
			
			$this->cd_pais = 0;
			$this->ds_pais = '';
		}
		
		//M�todos Get 
		

		function getCd_pais() {
			return $this->cd_pais;
		}
		
		function getDs_pais() {
			return $this->ds_pais;
		}
		
		//M�todos Set 
		

		function setCd_pais($value) {
			$this->cd_pais = $value;
		}
		
		function setDs_pais($value) {
			$this->ds_pais = $value;
		}
	
	}

