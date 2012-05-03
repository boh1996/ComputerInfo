<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$xml = simplexml_load_file("assets/illutio_Computerinfo.xml");
		/*foreach ($xml->Computers as $Computer) {
			$Computers[] = $Computer;
		}
		foreach ($xml->Units as $Unit) {
			$Units[] = $Unit;
		}
		foreach ($xml->Printers as $Printer) {
			$Printers[] = $Printer;
		}*/
		self::_Import_Computer($xml->Computers[3]);
		//echo "<pre>",print_r($Computers,true),"</pre>";

	}

	private function _Import_Computer($Computer){
		if((string)$Computer->School == "GVS"){
			$Object = new Computer();
			$Data = array(
				"organization" => 1,
				"identifier" => (string)$Computer->RealId,
				"lan_mac" => (string)$Computer->LanMac,
				"ip" => (string)$Computer->Ip,
				"serial" => (string)$Computer->Serial,
				"disk_space" => (int)$Computer->Disk,
				"ram_size" => (int)$Computer->Ram,
				"last_updated" => (int)$Computer->TimeStamp,
				"created_time" => (int)$Computer->TimeStamp,
				"screen_size" => (string)$Computer->ScreenWidth."x".(string)$Computer->ScreenHeight
			);
			$LanCards = explode("|", $Computer->LanCards);
			$LacMacs = array();
			foreach ($LanCards as $Card) {
				$Card = rtrim((string)$Card,"-");
				$LacMacs[] = $Card;
			}
			$Data["lacmacs"] = $LacMacs;

			//Cpu
			$Cpu = array(
				"name" => (string)$Computer->CpuName[0],
				"cores" => (string)$Computer->CpuCores[0]
			);
			$Data["cpu"] = $Cpu;

			//Location
			if(is_integer((int)$Computer->Room) && (int)$Computer->Room != 0){
				$Location = array(
					"name" => (string)$Computer->Room,
					"room_number" => (int)$Computer->Room
				);
			} else {
				$Location = array(
					"name" => (string)$Computer->Room
				);
			}
			$Data["location"] = $Location;

			//Model
			if(is_string((string)$Computer->Model)){
				$Model = array(
					"name" => (string)$Computer->Model
				);
				if($Computer->SB == 1){
					$Model["type"] = 2;
				} else {
					$Model["type"] = 1;
				}
				$Data["model"] = $Model;
			}		
			$Object->Import($Data);
			echo "<pre>",print_r($Object->Export(),true),"</pre>";
		}
	}
}