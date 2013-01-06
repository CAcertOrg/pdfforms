<?php
/*
LibreSSL - CAcert web application
Copyright (C) 2004-2012  CAcert Inc.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/

//TTP CAP

function TTPCAPHeader($pdf1) {
	//prints the CAcert header
	$pdf1->Image('logo/CAcert-logo-colour-1000.png', 10, 5,0,20,'', 'http://www.cacert.org');
	
	$pdf1->SetFont(FONT,'B','18');                            
	$pdf1->SetXY(110, 10);                                           
	$pdf1->Cell(90, 10, _("Trusted Third Party"), 0, 1, 'R'); 

	$pdf1->SetXY(110, 16);                                 
	$pdf1->Cell(90, 10, _("CAcert Assurance Programme"), 0, 1, 'R'); 

	$pdf1->SetFont(FONT,'I','8'); 
	$pdf1->SetXY(10, 22);                                
	$pdf1->Cell(190, 10, POBOX .' - '. WEB, 0, 1, 'C'); 

	$pdf1->SetFont(FONT,'','6'); 
	$pdf1->SetXY(10, 26);                                  
	$pdf1->Cell(190, 10, sprintF(_("CAcert's root certificate fingerprints SHA1: %s and MD5: %s"), CLASS1_SHA1, CLASS1_MD5), 0, 1, 'C'); // Box(Textbox)

	$pdf1->SetDrawColor(17, 86, 140); //128,128, 128); 
	$pdf1->SetLineWidth(0.2); 
	$pdf1->Line(10, 34, 200, 34); 
	$pdf1->SetY(35);
}	

function TTPAdviceFooter($pdf1) { 
	//prints the foote
	$pdf1->SetFont(FONT,'','6');                      
	$pdf1->MultiCell(190, 10, "© 2012 CAcert Inc., Trusted Third Party CAcert Assurance Progamme", 0, 'C'); 
}

function TTPCAPFirstPage($pdf1, $assureraddress) {
	//prints the assurer postal address on the first page
	$pdf1->SetFont(FONT,'','6'); 
	$pdf1->SetXY(20, 40);
	$pdf1->Cell(2, 5,  '1');
	$pdf1->SetFont(FONT,'','10'); 
	$pdf1->SetXY(20, 45);
	$pdf1->Cell(100, 10,  $assureraddress[0]); 
	$pdf1->SetXY(20, 53);   
	$pdf1->Cell(100, 10,  $assureraddress[1]); 
	$pdf1->SetXY(20, 61);   
	$pdf1->Cell(100, 10,  $assureraddress[2]); 
	$pdf1->SetXY(20, 69);   
	$pdf1->Cell(100, 10,  $assureraddress[3]); 		
	$pdf1->SetXY(20, 76);   
	$pdf1->Cell(100, 10,  $assureraddress[4]); 
	$pdf1->AddPage();
}

function TTPAssureeInfo($pdf1, $assureename , $dob , $email) {
	//Prints the Assuree block on the second page
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=0;
		$fontsize[$i]=10;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
	$cols=3;
	$width[0]=178;
	$width[1]=6;
	$width[2]=6;
	$border[0]=1;
	$border[1]=1;
	$border[2]=1;
	$fontsize[0]=12;
	$fontsize[1]=12;
	$fontsize[2]=12;
	$fonttype[0]='B';
	$fonttype[1]='B';    
	$fonttype[2]='B';  
	$fillcolor[0]=WHITE;
	$fillcolor[1]=GREYA;
	$fillcolor[2]=GREYB;
	$align[1]='C';
	$align[2]='C';
	
	$pdf1->SetY($pdf1->GetY()+1);
	$posY=$pdf1->GetY();
	$strga[0] = ASSUREE;
	$strga[1]="A";
	$strga[2]="B";
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=8; 
	$width[0]=6;
	$width[1]=60;
	$width[2]=10;
	$width[3]=5;
	$width[4]=10;
	$width[5]=87;
	$width[6]=6;
	$width[7]=6;
	$border[0]=1;
	$border[1]=1;
	$border[2]='LTB';
	$border[3]='TB';
	$border[4]='TB';
	$border[5]='TRB';
	$border[6]=1;
	$border[7]=1;
	$fontsize[0]=6;
	$fontsize[1]=10;
	$fontsize[2]=10;
	$fontsize[3]=10;
	$fontsize[4]=10;
	$fontsize[5]=10;
	$fontsize[6]=9;
	$fontsize[7]=9;
	$fonttype[0]='';
	$fonttype[1]='';
	$fonttype[2]='';
	$fonttype[3]='';
	$fonttype[4]='';
	$fonttype[5]='';
	$fonttype[6]='';
	$fonttype[7]='';
	$fillcolor[0]=WHITE;
	$fillcolor[1]=WHITE;
	$fillcolor[2]=WHITE;
	$fillcolor[3]=WHITE;
	$fillcolor[4]=WHITE;
	$fillcolor[5]=WHITE;
	$fillcolor[6]=GREYA;
	$fillcolor[7]=GREYB;
	$align[1]='';
	$align[2]='';
	$align[6]='C';
	$align[7]='C';

	$strga[0] = "2.";
	$strga[1] = TEXT_1A;
	$strga[2]= TEXT_1B;
	$strga[3]= "q";
	$strga[4]= TEXT_1C;
	$strga[5]= "q";
	$strga[6]= "q";
	$strga[7]= "q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=5;    
	$width[0]=6;
	$width[1]=60;
	$width[2]=112;
	$width[3]=6;
	$width[4]=6;
	$border[0]=1;
	$border[1]=1;
	$border[2]=1;
	$border[3]=1;
	$border[4]=1;
	$fontsize[0]=7;
	$fontsize[1]=10;
	$fontsize[2]=10;
	$fontsize[3]=9;
	$fontsize[4]=9;
	$fonttype[0]='';
	$fonttype[1]='B';    
	$fonttype[2]=''; 
	$fonttype[3]='';  
	$fonttype[4]='';
	$fillcolor[0]=WHITE;
	$fillcolor[1]=WHITE;
	$fillcolor[2]=WHITE;
	$fillcolor[3]=GREYA;
	$fillcolor[4]=GREYB;
	$align[3]='C';
	$align[4]='C';
	$align[6]='';
	$align[7]='';    

	$strga[0] = "3.";
	$strga[1] = TEXT_2A;
	$strga[2]=$dob;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);
	
	$strga[0] = "4.";
	$strga[1] = TEXT_3A;
	$strga[2]=$assureename;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);     

	$strga[0] = "5.";
	$strga[1] = TEXT_4A;
	$strga[2]=$email;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);     

	$width[1]=8;
	$width[2]=164;
	$border[1]='LTB';
	$border[2]='RTB';
	$fonttype[1]='';   
	$fontsize[1]=9;
	$fontsize[2]=9;

	$strga[0] = "6.";
	$strga[1] = "q";
	$strga[2]=TEXT_5A;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  
 
	$strga[0] = "7.";
	$strga[1] = "q";
	$strga[2]=TEXT_6A;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = "8.";
	$strga[1] = "q";
	$strga[2]=TEXT_7A;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = "9.";
	$strga[1] = "q";
	$strga[2]=TEXT_8A;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = "10.";
	$strga[1] = "q";
	$strga[2]=TEXT_9A;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);     

	$strga[0] = "11.";
	$strga[1] = "q";
	$strga[2]= TEXT_10A."    ".TEXT_10B;
	$strga[3]="q";
	$strga[4]="q";    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=1;
	$width[0]=190;
	$border[0]=1;
	$fontsize[0]=9;

	$strga[0] = TEXT_10C;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$cols=4;
	$width[0]=6;
	$width[1]=172;
	$width[2]=6;
	$width[3]=6;    
	$border[0]='LTR';
	$border[1]='LTR';
	$border[2]='LTR';
	$border[3]='LTR';
	$fontsize[0]=7;
	$fillcolor[0]=GREYA;  
	$fillcolor[2]=GREYA;  
	$fillcolor[3]=GREYB;  
	
	$strga[0] = "12.";
	$strga[1]= TEXT_11A;
	$strga[2]='';
	$strga[3]='';    
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);
  
	$cols=11;
	$width[0]=6;
	$width[1]=5;
	$width[2]=25;
	$width[3]=5;    
	$width[4]=25;
	$width[5]=5;
	$width[6]=25;
	$width[7]=5;    
	$width[8]=77;
	$width[9]=6;
	$width[10]=6;            
	$border[0]='LBR';
	$border[1]='LB';
	$border[2]='B';
	$border[3]='B';
	$border[4]='B';
	$border[5]='B';
	$border[6]='B';
	$border[7]='B';
	$border[8]='BR';
	$border[9]='LBR';
	$border[10]='LBR';
 
	$fontsize[0]=7;
	$fontsize[1]=9;
	$fontsize[2]=9;
	$fontsize[3]=9;
	$fontsize[4]=9;
	$fontsize[5]=9;
	$fontsize[6]=9;
	$fontsize[7]=9;
	$fontsize[8]=9;
	$fontsize[9]=9;
	$fontsize[10]=9;
	
	$fillcolor[0]=GREYA;  
	$fillcolor[1]=WHITE;  
	$fillcolor[2]=WHITE;  
	$fillcolor[3]=WHITE;  
	$fillcolor[4]=WHITE;  
	$fillcolor[5]=WHITE;  
	$fillcolor[6]=WHITE;  
	$fillcolor[7]=WHITE;
	$fillcolor[8]=WHITE;  
	$fillcolor[9]=GREYA;  
	$fillcolor[10]=GREYB; 

	$align[3]='';
	$align[4]='';
	$align[9]='C';
	$align[10]='C';

	$strga[0] = "";
	$strga[1]= "q";
	$strga[2]= TEXT_11B;
	$strga[3]="q";
	$strga[4]=TEXT_11C;
	$strga[5]="q";
	$strga[6]=TEXT_11D;
	$strga[7]="q";
	$strga[8]=TEXT_11E;
	$strga[9]="q";
	$strga[10]="q";
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$pdf1->SetY($pdf1->GetY()+2);
}

function TTPInfo($pdf1) {
	//prints the TTP block
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=1;
		$fontsize[$i]=9;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
	$align[$i]='';
	}

	$cols=1;
	$width[0]=190;
	$fontsize[0]=12;
	$fonttype[0]='B';

	$strga[0] = TTPPARTY;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$cols=4;
	$width[0]=6;
	$width[1]=78;
	$width[2]=100;
	$width[3]=6;
	$fontsize[0]=7;
	$fonttype[0]='';
	$fonttype[1]='B'; 
	$fillcolor[0]=GREYA;
	$fillcolor[3]=GREYB;
	$align[3]='C';

	$strga[0] = '13.';
	$strga[1] = TEXT_12;
	$strga[2] = '';
	$strga[3] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$border[0]='LTR';
	$border[1]='LTR';
	$border[2]='LTR';
	$border[3]='LTR';
	$fonttype[1]='B'; 

	$strga[0] = '14.';
	$strga[1] = TEXT_13A;
	$strga[2] = '';
	$strga[3] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$border[0]='LBR';
	$border[1]='LBR';
	$border[2]='LBR';
	$border[3]='LBR';
	$fonttype[1]=''; 
	$strga[0] = '';
	$strga[1] = TEXT_13B;
	$strga[2] = '';
	$strga[3] = '';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);    

	$border[0]='LTR';
	$border[1]='LTR';
	$border[2]='LTR';
	$border[3]='LTR';
	$fonttype[1]='B'; 

	$strga[0] = '15.';
	$strga[1] = TEXT_14A;
	$strga[2] = '';
	$strga[3] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);    

	$border[0]='LBR';
	$border[1]='LBR';
	$border[2]='LBR';
	$border[3]='LBR';
	$fonttype[1]=''; 

	$strga[0] = '';
	$strga[1] = TEXT_14B;
	$strga[2] = '';
	$strga[3] = '';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);    

	$border[0]='LTR';
	$border[1]='LTR';
	$border[2]='LTR';
	$border[3]='LTR';

	$strga[0] = '16.';
	$strga[1] = TEXT_15;
	$strga[2] = '';
	$strga[3] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);    

	$border[0]='LBR';
	$border[1]='LBR';
	$border[2]='LBR';
	$border[3]='LBR';
 

	$strga[0] = '';
	$strga[1] = ' ';
	$strga[2] = '';
	$strga[3] = '';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);    

	$cols=3;
	$width[0]=6;
	$width[1]=178;
	$width[2]=6;
	$border[0]=1;
	$border[1]=1;
	$border[2]=1;
	$border[3]=1;
	$fontsize[0]=7;
	$fonttype[0]='';
	$fillcolor[0]=GREYA;
	$fillcolor[2]=GREYB;
	$align[2]='C';
	$align[3]=''; 

	$strga[0] = '17.';
	$strga[1] = TEXT_16A."\n".TEXT_16B."\n".TEXT_16C."          ".TEXT_16D;
	$strga[2] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=7; 
	$width[0]=6;
	$width[1]=78;
	$width[2]=10;
	$width[3]=5;
	$width[4]=10;
	$width[5]=75;
	$width[6]=6;
	$border[0]=1;
	$border[1]=1;
	$border[2]='LTB';
	$border[3]='TB';
	$border[4]='TB';
	$border[5]='TRB';
	$border[6]=1;
	$fontsize[0]=7;
	$fontsize[1]=9;
	$fontsize[2]=9;
	$fontsize[3]=9;
	$fontsize[4]=9;
	$fontsize[5]=9;
	$fontsize[6]=9;
	$fonttype[0]='';
	$fonttype[1]='';    
	$fonttype[2]=''; 
	$fonttype[3]='';  
	$fonttype[4]='';
	$fonttype[5]='';
	$fonttype[6]='';
	$fonttype[7]='';
	$fillcolor[0]=GREYA;
	$fillcolor[1]=WHITE;
	$fillcolor[2]=WHITE;
	$fillcolor[3]=WHITE;
	$fillcolor[4]=WHITE;
	$fillcolor[5]=WHITE;
	$fillcolor[6]=GREYB;
	$align[1]='';
	$align[2]='';
	$align[6]='C';

	$strga[0] = "18.";
	$strga[1] = "I am also a CAcert assuer";
	$strga[2]= TEXT_1B;
	$strga[3]= "q";
	$strga[4]= TEXT_1C;
	$strga[5]= "q";
	$strga[6]= "q";

	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=3;
	$width[0]=6;
	$width[1]=178;
	$width[2]=6;
	$border[2]=1;
	$fontsize[0]=7;
	$fonttype[0]='';
	$fillcolor[0]=GREYA;
	$fillcolor[2]=GREYB;
	$align[2]='C';
	$align[6]='';       

	$strga[0] = '19.';
	$strga[1] = " \n \n".TEXT_17A.'   '.TEXT_17B;
	$strga[2] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$pdf1->SetY($pdf1->GetY()+2);             
}

function TTPAssurer($pdf1,$assurer) {
	//prints the TTP Assurer block
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=1;
		$fontsize[$i]=9;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}

	$cols=1;
	$width[0]=190;
	$fontsize[0]=12;
	$fonttype[0]='B';

	$strga[0] = TTPAssurer;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$cols=3;
	$width[0]=6;
	$width[1]=78;
	$width[2]=106;
	$fontsize[0]=7;
	$fonttype[0]='';
	$fonttype[1]=''; 
	$fillcolor[0]=GREYB;
  
	$strga[0] = '20.';
	$strga[1] = $assurer;
	$strga[2] = TEXT_18;
	$strga[3] = 'q';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$cols=3;
	$width[0]=6;
	$width[1]=8;
	$width[2]=176;
	$border[0]='LTR';
	$border[1]='LT';
	$border[2]='RT';
	$fontsize[0]=7;

	$strga[0] = '21';
	$strga[1] = 'q';
	$strga[2] = TEXT_19A;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$border[0]='LBR';
	$border[1]='LB';
	$border[2]='RB';
	$fontsize[0]=7;

	$strga[0] = ' ';
	$strga[1] = 'q';
	$strga[2] = TEXT_19B;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$cols=2;
	$width[0]=6;
	$width[1]=184;
	$border[0]=1;
	$border[1]=1;
	$fontsize[0]=7;

	$strga[0] = '22';
	$strga[1] = " \n \n".TEXT_20A.'   '.TEXT_20B;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 
	$pdf1->AddPage();
}

function TTPAdvice($pdf1) {
	//prints the advice for the TTP on the third page
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=1;
		$fontsize[$i]=9;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
 
	$pdf1->SetFont(FONT,'B','12');
	$pdf1->SetXY(10, 10);
	$pdf1->MultiCell(190, 10, TEXT_A1, 0, 'L');  
	$pdf1->SetY($pdf1->GetY()+1); 

	$pdf1->SetFont(FONT,'','10');
	$pdf1->MultiCell(190, 5, TEXT_A2, 0, 'L');  
	$pdf1->SetY($pdf1->GetY()+1);
 
	$pdf1->SetFont(FONT,'','10');
	$pdf1->MultiCell(190, 5, TEXT_A3, 0, 'L');  
	$pdf1->SetY($pdf1->GetY()+1);

	$pdf1->SetFont(FONT,'B','12');
	$pdf1->MultiCell(190, 10, TEXT_A4, 0, 'L');  
	$pdf1->SetY($pdf1->GetY()+1); 

	$pdf1->SetFont(FONT,'','10');
	$pdf1->MultiCell(190, 5, TEXT_A5, 0, 'L');  
	$pdf1->SetY($pdf1->GetY()+1);

	$cols=2;
	$width[0]=15;
	$width[1]=175;
	$border[0]=0;
	$border[1]=0;

	$strga[0] = '2.';
	$strga[1] = TEXT_AT1;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '3.';
	$strga[1] = TEXT_AT2;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '4.';
	$strga[1] = TEXT_AT3;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  
	
	$strga[0] = '5.';
	$strga[1] = TEXT_AT4;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '6.-10.';
	$strga[1] = TEXT_AT5_9;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '11.';
	$strga[1] = TEXT_AT10;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '12.';
	$strga[1] = TEXT_AT11;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '13.';
	$strga[1] = TEXT_AT12;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '14.';
	$strga[1] = TEXT_AT13;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);  

	$strga[0] = '15.';
	$strga[1] = TEXT_AT14;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '16.';
	$strga[1] = TEXT_AT15;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '17.';
	$strga[1] = TEXT_AT16;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '18.';
	$strga[1] = TEXT_AT17;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '19.';
	$strga[1] = TEXT_A6;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 

	$strga[0] = '20.-22.';
	$strga[1] = TEXT_AT18_20;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align); 
}
?>
