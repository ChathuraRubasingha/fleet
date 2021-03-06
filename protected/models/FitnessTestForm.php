<?php

class FitnessTestForm extends CFormModel
{

	//public $Valid_From,$Valid_To;
	public $Valid_From;
	public $Valid_To;

	
	
	public function rules()
	{
		return array(
			array('Valid_From, Valid_To', 'required')	
			
		);
	}
	
	 public function attributeLabels()
    {
        return array(
			'Valid_From'=>'From Date',	
			'Valid_To'=>'To Date'		
		);
                      
               
    }
	
	
	
    public function rprint($Valid_From,$Valid_To)
	{
		$DataSource = new ReportDataSource;
		require_once('./protected/class/class.ezpdf.php');
		$pdf = new Cezpdf();
		$pdf->selectFont('./protected/class/fonts/Courier.afm');
		
		//--Get data array 
		$mystr=$DataSource->ArrayFittnessTest($Valid_From,$Valid_To);		
		$ArrCount = count($mystr);	
			
		//--add Heddings		 
		 $pdf->ezText(Yii::app()->params['companyName'],14);
		 $pdf->ezText('',2);
		 $pdf->ezText('Fleet Management System',12);		
		 $pdf->ezText('',5);
		 $pdf->ezText('Fitness Test Due Report',10);
		 $pdf->ezText('',5);
	     $pdf->ezText('From: '.$Valid_From.' To: '.$Valid_To,10);
		 $pdf->ezText('',28);		
		 $pdf->addJpegFromFile("./images/NationalSymbol.jpg",'500','740','71','87');
		 //$pdf->addText(400,730,8,"<i>'Towards Next Generation Government'</i>",0);			
		
		 //--add Line to report
		 $pdf->line(560,723,20,723);
		 $pdf->line(560,724.5,20,724.5);	 
		 		 
		 $Top=690;
		 $Right=330;
		 $LeftFront=32;
		 $LeftBack=150;
		 $pdf->ezText('',10);
		 
		 if ($ArrCount > 0)  // $ArrCount start
		{
			$pdf->ezTable($mystr,array('Vehicle_No'=>'Vehicle No.', 'Category_Name'=>'Category','Model'=>'Model','Make'=>'Make','Valid_From'=>'Valid From','Valid_To'=>'Valid To','Fitness_test'=>'Test Status',),'',array('xPos'=>'right','xOrientation'=>'left','width'=> 540));
		}
		else
		{
			$pdf->ezText('* No data available for selected criteria',10);
			$pdf->ezStream();
		}	
		 
		 $pdf->setColor(0.0,0.0,0.0);
		
			//--add Line to report (Page footer)---
			$pdf->line(580,20,15,20);
			$pdf->addText(420,10,8,"Generated by- ".Yii::app()->getModule('user')->user()->username);			
			$Time = date("Y/m/d");
			$pdf->addText(540,10,8,$Time,0);					
			$pdf->ezStartPageNumbers(60,10,8);					
			//---Footer End here----
				
			$pdf->ezStream();					
		
	}	
}

?>