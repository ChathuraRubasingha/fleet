<?php

class Vehicleinventryform extends CFormModel
{
	public $Location_ID;
    public $Vehicle_Category_ID;
	//public $GN_Division_ID;
	
	
	
	public function rules()
	{
		return array(
			array('District', 'required'),
			array('DS_Division_ID', 'required'),
			
		);
	}
		
	 public function attributeLabels()
    {
        return array(
			'District_ID'=>'District',
			'DS_Division_ID'=>'DS Division',
			'GN_Division_ID'=>'GN Division'
		);
                      
               
    }
	/*public function combodata($var)
	{
		if($var == 'District')
		{
		   	$values=Yii::app()->db->createCommand()
                   ->select('District_ID, District_Name')
                   ->from('ma_districts')
                   ->queryAll();				  
		}
		elseif($var == 'DS')
		{
			$values=	Yii::app()->db->createCommand()
					   ->select('DS_Division_ID, DS_Division_Name')
					   ->from('ma_ds_divisions')
					   ->queryAll();				
		}
		elseif($var == 'GN')
		{
		   	$values=Yii::app()->db->createCommand()
                   ->select('GN_Division_ID, GN_Division_Name')
                   ->from('ma_gn_divisions')
                   ->queryAll();				  
		}
		return($values);
	}*/
	
    public function rprint()
	{
	
		$DataSource = new ReportDataSource;
		
		$this->Location_ID = $_POST['MaLocation']['Location_ID'];
		$this->Vehicle_Category_ID = $_POST['VehicleCategory']['Vehicle_Category_ID'];
		
		
		$mystr=$DataSource->ArrayVehicleInventry($this->Location_ID,$this->Vehicle_Category_ID);    
		
		$ArrCnt=count($mystr);

			
		require_once('./protected/class/class.ezpdf.php');
		$pdf = new Cezpdf();
		$pdf->selectFont('./protected/class/fonts/Times-Roman.afm');		
		
		
                  $Location= Yii::app()->db->createCommand('Select Location_Name from ma_location where Location_ID="'.$this->Location_ID.'"')->queryAll();
                
                  $VehicleCategory= Yii::app()->db->createCommand('Select Category_Name from ma_vehicle_category where Vehicle_Category_ID="'.$this->Vehicle_Category_ID.'"')->queryAll();
                   /* $DistrictName= Yii::app()->db->createCommand('Select District_Name from ma_districts where District_ID="'.$this->District_ID.'"')->queryAll(); */         
      
			//$pdf->ezText('Ministry of Public Administration and Home Affairs',19);
			$pdf->ezText(Yii::app()->params['companyName'],19);
	
			//$pdf->ezText('Local Governance Program',15);
			$pdf->ezText('',2);
			//$pdf->ezText('Fleet Management Database System',14);		
			$pdf->ezText(Yii::app()->params['sysName'],14);
			$pdf->ezText('',5);
			$pdf->ezText('Vehicle Inventry',13);
			$pdf->ezText('',28);
			
			 $pdf->addJpegFromFile("./images/NationalSymbol.jpg",'500','740','71','87');
			
			if($this->Location_ID!='')
			{		
				$location='Location: '.$Location[0]['Location_Name'];
				$pdf->ezText($location,10);
			}
			if($this->Vehicle_Category_ID!='')
			{
				$vehiclecategory='Divisional Secretariat: '.$VehicleCategory[0]['Category_Name'];
				$pdf->ezText($vehiclecategory,10);
			}

			/*
			if($this->GN_Division_ID!='')
			{
				$gnName='Grama Niladari Division: '.$GNName[0]['GN_Division_Name'];
				$pdf->ezText($gnName,10);
			}
				*/		
			$pdf->ezText('',20);
			
			$pdf->addJpegFromFile("./images/NationalSymbol.jpg",'500','740','71','87');
			
			$pdf->addText(436,730,8,"<i>''Towards Next Generation Government''</i>",0);		
			
			//--add Line to report
			$pdf->line(560,723,30,723);
			$pdf->line(560,724.5,30,724.5);			
				
			//--set the table line style
			$pdf->setLineStyle(1);	
			
			//--add Report footer
			$Time = date("Y/m/d");
			$pdf->addText(540,10,8,$Time,0);			
			$pdf->line(580,20,15,20);	
			$pdf->addText(95,10,8,"Location- ".$Location[0]['Location_Name'],0);
             /*           $pdf->addText(420,10,8,"Generated by- ".Yii::app()->getModule('user')->user()->username);*/
					
			if($this->Vehicle_Category_ID!='')
			{
				$pdf->addText(220,10,8,"Vehicle- ".$VehicleCategory[0]['Category_Name'],0);
			}
			/*
			if($this->GN_Division_ID!='')
			{
				$pdf->addText(320,10,8,"GN- ".$GNName[0]['GN_Division_Name'],0);
			}	*/	   
			$pdf->ezStartPageNumbers(60,10,8);
			
			//--footer end--
			//print_r($mystr);exit();	
		if($ArrCnt>0)
		{
			if ($this->Vehicle_Category_ID='') 
			{

				$pdf->ezTable($mystr,array('Category_Name'=>'Category Name','Vehicle_No'=>'Vehicle No','Model'=>'Model','Make'=>'Make','Chassis_No'=>'Chassis No','Engine_No'=>'Engine No'),'',array('xPos'=>'right','xOrientation'=>'left','width'=>520));		
			}
			else
			{
				$pdf->ezTable($mystr,array('Vehicle_No'=>'Vehicle No','Model'=>'Model','Make'=>'Make','Chassis_No'=>'Chassis No','Engine_No'=>'Engine No'),'',array('xPos'=>'right','xOrientation'=>'left','width'=>520));

				}	
			
			}
		
		else
		{
			
			$pdf->ezText('* No data available for selected criteria',10);
			$pdf->ezStream();
		}	
			
			$pdf->ezStream();		
		
		   
						
	}	
}
?>


