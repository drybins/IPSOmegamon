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
			$this->SendDebug("Dierk", "CPU", 0);
			$a = 2.1;
			$b = 28445;
			$c = $this->GetIDForIdent("CPU_0");
			SetValue($b,2.20);
			//SetValue($b,$a);
		}
	}