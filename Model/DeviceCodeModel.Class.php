<?php
class DeviceCodeModel{

	function SelectDeviceCode($Map){
		$Db=GetDb();
		$Frist=true;
		$SqlParams="";
		foreach($Map as $key => $value){
			if (!$Frist){
				$SqlParams.=" And ";
			}
			$SqlParams.= $key." ";
			if(is_array($value)){//如果这是个数组的话第一个元素就是method，第二个元素就是值。
				//$Map['key']=arryarray('like','%'.$phone.'%');
				//$Map['key']=arryarray('=','%'.$phone.'%');
				$SqlParams.= $value[0]." ";
				$SqlParams.= $Db->escape($value[1]);
			}else{
				$SqlParams.= "= ";
				$SqlParams.= $Db->escape($value);
			}
			$Frist=false;
		}
		$TableName="WebDeviceCode";
		$ResultArray = $Db->get_results("SELECT * FROM ".$TableName." WHERE ".$SqlParams,ARRAY_A);
		//$Db->vardump($ResultArray);
		return $ResultArray;
		//foreach($ResultArray as $row_obj) {
		//}
	}
	function AddDeviceCode($Map){
		$Db=GetDb();
		$Frist=true;
		$SqlData="";
		$SqlKey="";
		foreach($Map as $key => $value){
			if (!$Frist){
				$SqlData.=" , ";
				$SqlData.=" , ";
			}
			$SqlKey.= $key;
			$SqlData.= "'".$Db->escape($value)."'";
			$Frist=false;
		}
		$TableName="WebDeviceCode";
		// Insert in to the DB..
		$Result=$Db->query("INSERT INTO ".$TableName."(".$SqlKey.") VALUES (".$SqlData.")");
		return $Result;
	}
}


?>