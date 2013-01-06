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

  //HTML parser


  
function WriteHTML($html,$pdf){
	//HTML parser
	
	$html=str_replace("\n",' ',$html);
	$html=str_replace("\r",' ',$html); //replace carriage returns by spaces
	$html=str_replace("  ",' ',$html); //replace carriage returns by spaces
	$html=str_replace("  ",' ',$html); //replace carriage returns by spaces
	$html=str_replace("  ",' ',$html); //replace carriage returns by spaces

	$html = str_replace('&trade;','™',$html);
	$html = str_replace('&copy;','©',$html);
	$html = str_replace('&euro;','€',$html);
	$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($a as $i=>$e){
		if($i%2==0){
			//Text
			if($pdf->href){
				if ($pdf->list!=""){
					$pdf->Write(5,$pdf->list);
					$pdf->list='';
				}
				PutLink($pdf->href,trim(stripslashes(txtentities($e))).' ',$pdf);
			}elseif ($pdf->htmltitle==1){
				HtmlHeader($pdf,trim(stripslashes(txtentities($e))));
			}else{
				if (trim(stripslashes(txtentities($e)))!="") {
					$pdf->Write(5,$pdf->list.trim(stripslashes(txtentities($e))).' ');
					$pdf->list='';
				}
			}
		}else{
			//Tag
			if($e{0}=='/'){
				CloseTag(strtoupper(substr($e,1)),$pdf);
			}else{
				//Extract attributes
				$a2=explode(' ',$e);
				$tag=strtoupper(array_shift($a2));
				$attr=array();
				//adjust and set LI numberation
				if ($tag=="OL"){ 
						$pdf->htmlnumberlevel+=1;
					if (strpos($e,"type=")>1){
						$postype=strpos($e,"type=");
						$pdf->htmlnumbertype[$pdf->htmlnumberlevel]=substr($e,$postype+6,1);
					}else{
						$pdf->htmlnumbertype[$pdf->htmlnumberlevel]="";
					}
					$pdf->htmlnumberi[$pdf->htmlnumberlevel]=1;
				}
				if ($tag=="UL"){
					$pdf->htmlnumberlevel+=1;
				}
				foreach($a2 as $v){
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3)){
						$attr[strtoupper($a3[1])]=$a3[2];
					}
				}
				OpenTag($tag,$attr,$pdf);
			}
		}
	}
}

function OpenTag($tag,$attr,$pdf){
	//Opening tag
	if($tag=='TITLE'){
/* 		$pdf->Ln(2);
		$pdf->SetTextColor(150,0,0);
		$pdf->SetFontSize(22); */
		$pdf->htmltitle=1;
	}
	if($tag=='B' or $tag=='I' or $tag=='U'){
		SetStyle($tag,true,$pdf);
	}
	if($tag=='A'){
		if (isset($attr['HREF'])!=""){
			$pdf->href=$attr['HREF'];
		}
	}
	if($tag=='BR'){
		$pdf->Ln(5);
	}
	if($tag=='H1'){
		$pdf->Ln(2);
		SetStyle('B',true,$pdf);
		$pdf->SetFont(FONT,'',16);
	}
	
	if($tag=='H2'){
		$pdf->Ln(2);
		SetStyle('B',true,$pdf);
		$pdf->SetFont(FONT,'',14);
	}
	if($tag=='H3'){
		$pdf->Ln(2);
		SetStyle('B',true,$pdf);
		$pdf->SetFont(FONT,'',12);
	}
	if($tag=='H4'){
		$pdf->Ln(2);
		SetStyle('B',true,$pdf);
		$pdf->SetFont(FONT,'',10);
	}
	
	if($tag=='OL'){
		$pdf->htmlnumber=1;
	}
	if($tag=='UL'){
			$pdf->htmlnumber=0;
	}
	if($tag=='LI'){
		if ($pdf->liststart!=1){
			$pdf->liststart=1;
		}else{
			$pdf->Ln(5);
		}
		$pdf->listend="";
		$pdf->SetFont(FONT,'',9);
		if 	($pdf->htmlnumber==0){
			$pdf->list='•  ';
		} else {
			$strnumber="";
			switch ($pdf->htmlnumbertype[$pdf->htmlnumberlevel]){
				case "a":
					$strnumber=chr(96+$pdf->htmlnumberi[$pdf->htmlnumberlevel]);
					break;
				case "A":
					$strnumber=chr(64+$pdf->htmlnumberi[$pdf->htmlnumberlevel]);
					break;
				case "i":
					$strnumber=strtolower(roman_number($pdf->htmlnumberi[$pdf->htmlnumberlevel]));
					break;
				case "I":
					$strnumber=strtoupper(roman_number($pdf->htmlnumberi[$pdf->htmlnumberlevel]));
					break;
				case "1":
					$strnumber=$pdf->htmlnumberi[$pdf->htmlnumberlevel];
					break;
				case "":
					$strnumber=$pdf->htmlnumberi[$pdf->htmlnumberlevel]; 
					break;
			}
			$pdf->list=$strnumber.'.  ';
			$pdf->htmlnumberi[$pdf->htmlnumberlevel]+=1;      
		}
	}
}

function CloseTag($tag,$pdf){
	//Closing tag
	if ($tag=='TITLE'){
 		$pdf->htmltitle=0;
/*		$pdf->Ln(5);
		$pdf->SetFont(FONT,'',9);
		$pdf->SetFontSize(9);
		SetStyle('U',false,$pdf);
		SetStyle('B',false,$pdf);
		$pdf->SetTextColor(0,0,0); */
	}
	if($tag=='B' || $tag=='I' || $tag=='U'){
		SetStyle($tag,false,$pdf);
	}
	if($tag=='A'){
		$pdf->href='';
	}
	if($tag=='P' || $tag=='H1' || $tag=='H2' || $tag=='H3' || $tag=='H4'  || $tag=='TR'){
		$pdf->Ln(5);
		$pdf->SetFont(FONT,'',9);
		$pdf->SetFontSize(9);
		SetStyle('U',false,$pdf);
		SetStyle('B',false,$pdf);
//		mySetTextColor($pdf,-1);
	}
	
	if($tag=='OL'){
			$pdf->htmlwidth=190;
			$pdf->htmlnumberlevel-=1;
			if ($pdf->htmlnumberlevel==0){
				$pdf->htmlnumber=0;
			}
	}
	if($tag=='UL'){
			$pdf->htmlwidth=190;
			$pdf->htmlnumberlevel-=1;
			if ($pdf->htmlnumberlevel==0){
				$pdf->htmlnumber=0;
			}
	}
	if($tag=='LI'){
		if ($pdf->listend!=1){
			$pdf->Ln(5);
			$pdf->listend=1;
		}
		$pdf->liststart="";
	}

}

function SetStyle($tag,$enable,$pdf){
	//Modify style and select corresponding font
	$pdf->$tag+=($enable ? 1 : -1);
	$style='';
	foreach(array('B','I','U') as $s){
		if($s>0){
			$style.=$s;
		}
	}
	$pdf->SetFont('',$style);
}

function PutLink($URL,$txt,$pdf){
	//Put a hyperlink
	$pdf->SetTextColor(0,0,255);
	SetStyle('U',true,$pdf);
	$pdf->Write(5,$txt,$URL);
	SetStyle('U',false,$pdf);
	$pdf->SetTextColor(0);
}

function roman_number($integer){
	$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
	$return = ''; 
	while($integer > 0){ 
		foreach($table as $rom=>$arb){ 
			if($integer >= $arb){ 
				$integer -= $arb; 
				$return .= $rom; 
				break; 
			} 
		} 
	} 
	return $return; 
} 

function txtentities($html){
	//
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans = array_flip($trans);
	return strtr($html, $trans);
}

function HtmlHeader($pdf,$title,$title1="") {
	//prints CAcert header
	$pdf->Image('logo/CAcert-logo-colour-1000.png', 10, 5,0,20,'', 'http://www.cacert.org');

	$pdf->SetFont(FONT,'B','18');
	$pdf->SetXY(100, 10);
	$pdf->Cell(90, 10, $title, 0, 1, 'L'); 

	$pdf->SetXY(100, 16);
	$pdf->Cell(90, 10, $title1, 0, 1, 'L'); 

	$pdf->SetFont(FONT,'I','8'); 
	$pdf->SetXY(10, 22);
	$pdf->Cell(190, 10, POBOX .' - '. WEB, 0, 1, 'C'); 

	$pdf->SetFont(FONT,'','6'); 
	$pdf->SetXY(10, 26);                                  
	$pdf->Cell(190, 10, sprintF(_("CAcert's root certificate fingerprints SHA1: %s and MD5: %s"), CLASS1_SHA1, CLASS1_MD5), 0, 1, 'C'); // Box(Textbox)

	$pdf->SetDrawColor(17, 86, 140); //128,128, 128); 
	$pdf->SetLineWidth(0.2); 
	$pdf->Line(10, 34, 200, 34); 
	$pdf->SetY(35);
	$pdf->SetFontSize(9);
}
?>
