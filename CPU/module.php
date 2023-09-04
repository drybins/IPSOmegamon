<?php

declare(strict_types=1);
	class CPU extends IPSModule
	{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
			$this->RegisterTimer("Refresh_CPU", 0, 'CPU_Refresh($_IPS[\'TARGET\']);');
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			$this->SetTimerInterval("Refresh_CPU", 60 * 1000);
		}
		
		
		public function Refresh()
		{
			$this->calculate();   
		}
		
		private function Calculate()
		{
			
			$this->SetValue(37861,"2.00");
		}
	}