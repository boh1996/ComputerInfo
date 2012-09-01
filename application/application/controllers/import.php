<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$this->load->library("Device");
		$this->load->library("Printer");
		$xml = simplexml_load_file("assets/illutio_Computerinfo.xml");
		/*foreach ($xml->Computers as $Computer) {
			self::_Import_Computer($Computer);
		}*/
		/*foreach ($xml->Units as $Unit) {
			self::_Import_Unit($Unit);
		}*/
		/*foreach ($xml->Printers as $Printer) {
			self::_Import_Printer($Printer);
		}*/
		/*foreach ($xml->Rooms as $Room) {
			echo "<pre>";
			print_r($Room);
			echo "</pre>";
		}*/
	}

	/**
	 * This function imports printers from the old format to the new one
	 * @param object $Printer The printer to import
	 * @since 1.0
	 * @access private
	 */
	private function _Import_Printer($Printer){
		if((string)$Printer->School == "GVS"){
			$Object = new Printer();
			$Data = array(
				"identifier" => (string)$Printer->Realid,
				"ip" => (string)$Printer->Ip,
				"name" => (string)$Printer->Name,
				"mac" => (string)$Printer->Mac,
				"organization" => 1,
				"last_updated" => time(),
				"created_time" => time()
			);
			$Model = array(
				"name" => (string)$Printer->Model
			);
			$Data["model"] = $Model;
			if((string)$Printer->Location != "XX"){
				$Location = array(
					"name" => (string)$Printer->Location,
					"organization" => 1
				);
				$Data["location"] = $Location;
			}
			$Object->Import($Data);
			$Object->Save();
		}
	}

	/**
	 * This function is used to import units from
	 * the old format and convert it to the new format
	 * @param object $Unit The Unit XML object
	 * @since 1.0
	 * @access private
	 */
	private function _Import_Unit($Unit){
		if((string)$Unit->School == "GVS"){
			$Object = new Device();
			$Data = array(
				"organization" => 1,
				"identifier" => (string)$Unit->BUFUUF,
				"last_updated" => time(),
				"created_time" => time(),
			);
			if((int)$Unit->Type == 1){
				$Data["type"] = 3;
				$Type = 3;
			} else if((int)$Unit->Type == 2){
				$Data["type"] = 4;
				$Type = 4;
			}
			if((string)$Unit->Model != "" && (string)$Unit->Model != "xx"){
				$Data["model"] = array(
					"name" => (string)$Unit->Model,
					"manufacturer" => array("name" => (string)$Unit->Manifacturer)
				);
				if(is_integer($Type)){

				}
				$Data["model"]["type"] = (int)$Type;
			}
			if(is_integer((int)$Unit->Room)){
				$Location = array(
					"name" => (string)$Unit->Room,
					"room_number" => (int)$Unit->Room,
					"organization" => 1
				);
			} else {
				$Location = array(
					"name" => (string)$Unit->Room,
					"organization" => 1
				);
			}
			$Data["location"] = $Location;
			$Object->Import($Data);
			/*echo "<pre>";
			print_r($Object->Export());
			echo "</pre>";*/
			$Object->Save();
		}
	}

	/**
	 * This function Imports all the computers from the old format to the new
	 * @param object $Computer The computer object
	 * @since 1.0
	 * @access private
	 */
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
			$Data["lan_macs"] = $LacMacs;

			//Cpu
			$Cpu = array(
				"detection_string" => (string)$Computer->CpuName[0],
				"cores" => (string)$Computer->CpuCores[0]
			);
			$Data["cpu"] = $Cpu;
			$Data["operating_system"] = "Windows";

			//Location
			if(is_integer((int)$Computer->Room) && (int)$Computer->Room != 0){
				$Location = array(
					"name" => (string)$Computer->Room,
					"room_number" => (int)$Computer->Room,
					"organization" => 1
				);
			} else {
				$Location = array(
					"name" => (string)$Computer->Room,
					"organization" => 1
				);
			}
			$Data["location"] = $Location;

			//Model
			if(is_string((string)$Computer->Model)){
				$Model = array(
					"name" => (string)$Computer->Model
				);
				if($Computer->SBB == 0){
					$Model["type"] = 2;
				} else {
					$Model["type"] = 1;
				}
				$Data["model"] = $Model;
			}		
			$Object->Import($Data);
			$Object->Save();
		}
	}
}