<?php

declare(strict_types=1);
	class CPU extends IPSModule
	{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
			$RC = $this->CreateCategory("Omegamon", 0);
			$RC = $this->CreateCategory("CPU", $RC);
			$KategorieID = $RC;
			$VarID = $this->CreateVariable("CPU_Anz_Kerne", "Anzahl Kerne der CPU", $KategorieID, 50);
			//IPS_SetParent($VarID, $RC);
			$a = count(Sys_GetCPUInfo());
			$b = $a -1;
			SetValue($VarID, $b);
			
			for($i=0;$i<$b;$i++)
			{
				$c = "CPU" . $i; 
				$d = "CPU_" . $i;
				$RC = $this->CreateVariable($c, $d, $KategorieID, 10+$i);
			}
			$RC = $this->CreateVariable("CPUAvg", "CPU average", $KategorieID, 0);
			
			$this->RegisterVariableFloat("Dierk", "Dierk", "", 11);
			
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
			//IPS_LogMessage("KategorieID: " . $KategorieID , "Dierk2");
			
			//$a = 2.1;
			//$b = 28445;
			//IPS_GetCategoryIDByName("CPU", 
			print_r($this->GetReferenceList());
			//IPS_GetObjectIDByIdent("CPU0",33275);
			$c = $this->GetIDForIdent("Dierk");
			IPS_LogMessage("KategorieID: " . $c , "Dierk2");
			$this->SetValue("CPUAvg",2.20);
			//SetValue($b,$a);
		}
		
		private function CreateCategory($KategorieName, $Parent)
		{
			$KategorieID = @IPS_GetCategoryIDByName($KategorieName, $Parent); 
			if($KategorieID === false)
			{
				$KategorieID = IPS_CreateCategory();        // Kategorie anlegen
				IPS_SetName($KategorieID, $KategorieName);  // Kategorie benennen
				IPS_SetParent($KategorieID, $Parent);       // Kategorie an die richtige stelle hängen 
			}
			return $KategorieID;
		}
		
		private function CreateVariable($VarIdent, $VarName, $Parent, $Sort)
		{
			$VarID = @IPS_GetVariableIDByName($VarName, $Parent); 
			if($VarID === false)
			{
				$VarID = $this->RegisterVariableFloat($VarIdent, $VarName, "", $Sort);
				IPS_SetParent($VarID, $Parent);       
			}
			return $VarID;
		}
	}