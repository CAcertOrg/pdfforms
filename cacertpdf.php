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

//IMPORTANT coding of this file needs to be UTF-8

// Optionally define the filesystem path to your system fonts
// otherwise tFPDF will use [path to tFPDF]/font/unifont/ directory
// define("_SYSTEM_TTFONTS", "C:/Windows/Fonts/");

require_once('lib/tfpdf.php');
require_once("lib/l10n.php");

define('FONT','Freesans');  

define('POBOX','CAcert Inc. - P.O. Box 66 - Oatley NSW 2223 - Australia');
define('WEB', 'http://www.cacert.org');
define('CCA', "CAcertCommunityAgreement"); // default policy to print
define('OAP', "OrganisationAssurancePolicy"); 
define('POLICY','policy/'); // default polciy doc directory
define('EXT','.php'); // default polciy doc extention, should be html
/* finger print CAcert Root Key */ // should obtain this automatically
define('CLASS1_SHA1','135C EC36 F49C B8E9 3B1A B270 CD80 8846 76CE 8F33');
define('CLASS3_SHA1','AD7C 3F64 FC44 39FE F4E9 0BE8 F47C 6CFA 8AAD FDCE');
// next two are not used on the form
define('CLASS1_MD5','A6:1B:37:5E:39:0D:9C:36:54:EE:BD:20:31:46:1F:6B');
define('CLASS3_MD5','F7:25:12:82:4E:67:B5:D0:8D:92:B7:7C:0B:86:7A:42');	

//colour settings
define('BLACK','0, 0, 0');
define('WHITE','255, 255, 255');
define('GREYA','200, 200, 200');
define('GREYB','130, 130, 130');

define('ERROR',_('Error'));


define('LOGFILE',"./log.txt"); 

define("FPDF_FONTPATH","font/");

// init variables
$type ="";
$assureename ="";
$dob ="";
$email ="";
$date ="";
$assurername ="";
$assureraddress[0] ="";
$assureraddress[1] ="";
$assureraddress[2] ="";
$assureraddress[3] ="";
$assureraddress[4] ="";

$organisation['orgname'] ="";
$organisation['orgaddress'] ="";
$organisation['orgstate'] ="";
$organisation['orgcountry'] ="";
$organisation['orgtype'] ="";
$organisation['dba1'] ="";
$organisation['dba2'] ="";
$organisation['dba3'] ="";
$organisation['dba3'] ="";
$organisation['dba4'] ="";
$organisation['dba5'] ="";
$organisation['dba6'] ="";
$organisation['toridentifier'] ="";
$organisation['tor'] ="";
$organisation['torregion'] ="";

$organisation['domain1'] ="";
$organisation['domain2'] ="";
$organisation['domain3'] ="";
$organisation['domain4'] ="";
$organisation['domain5'] ="";
$organisation['domain6'] ="";

$organisation['admin1'] ="";
$organisation['adminmail1'] ="";
$organisation['admin2'] ="";
$organisation['adminmail2'] ="";

$organisation['orgceo'] ="";
$organisation['orgceomail'] ="";
$organisation['orgceophone'] ="";
$organisation['orgceodate'] ="";

$organisation['assurer'] = "";
$organisation['assurerdate'] = "";
$organisation['assurermail'] = "";

$printcca="";
$printoap="";

$output='cacert.pdf';

//Fill import variable from get statement
//++++ CAP form and TTP CAP form++++
if (isset($_GET['fullname'])){
	$assureename = $_GET['fullname'];
} else {
	$_GET['fullname']="";
}
if (isset($_GET['dob'])){
	$dob = $_GET['dob'];
}
if (isset($_GET['email'])){
	$email = $_GET['email'];
}
if (isset($_GET['type'])){
	$type = $_GET['type'];
}
if (isset($_GET['date'])){
	$date = $_GET['date'];
}   
if (isset($_GET['assurername'])){
	$assurername = $_GET['assurername'];
}
     
//++++ COAP form ++++
if (isset($_GET['name'])){
	$organisation['orgname'] = $_GET['name'];
}
if (isset($_GET['address'])){
	$organisation['orgaddress'] = $_GET['address'];
}
if (isset($_GET['state'])){
	$organisation['orgstate'] = $_GET['state'];
	}
if (isset($_GET['country'])){
	$organisation['orgcountry'] = $_GET['country'];
}   
if (isset($_GET['orgtype'])){
	$organisation['orgtype'] = $_GET['orgtype'];
}

if (isset($_GET['dba1'])){
	$organisation['dba1'] = $_GET['dba1'];
}
if (isset($_GET['dba2'])){
	$organisation['dba2'] = $_GET['dba2'];
}
if (isset($_GET['dba3'])){
	$organisation['dba3'] = $_GET['dba3'];
}
if (isset($_GET['dba4'])){
	$organisation['dba4'] = $_GET['dba4'];
}
if (isset($_GET['dba5'])){
	$organisation['dba5'] = $_GET['dba5'];
}
if (isset($_GET['dba6'])){
	$organisation['dba6'] = $_GET['dba6'];
}

if (isset($_GET['identity'])){
	$organisation['toridentifier'] = $_GET['identity'];
}
if (isset($_GET['tor'])){
	$organisation['tor'] = $_GET['tor'];
}
if (isset($_GET['torregion'])){
	$organisation['torregion'] = $_GET['torregion'];
}

if (isset($_GET['domain1'])){
	$organisation['domain1'] = $_GET['domain1'];
}
if (isset($_GET['domain2'])){
	$organisation['domain2'] = $_GET['domain2'];
}
if (isset($_GET['domain3'])){
	$organisation['domain3'] = $_GET['domain3'];
}
if (isset($_GET['domain4'])){
	$organisation['domain4'] = $_GET['domain4'];
}
if   (isset($_GET['domain5'])){
	$organisation['domain5'] = $_GET['domain5'];
}
if (isset($_GET['domain6'])){
	$organisation['domain6'] = $_GET['domain6'];
}

if (isset($_GET['admin1'])){
	$organisation['admin1'] = $_GET['admin1'];
}
if (isset($_GET['admin1email'])){
	$organisation['adminmail1'] = $_GET['admin1email'];
}
if (isset($_GET['admin2'])){
	$organisation['admin2'] = $_GET['admin2'];
}
if (isset($_GET['admin2email'])){
	$organisation['adminmail2'] = $_GET['admin2email'];
}

if (isset($_GET['director'])){
	$organisation['orgceo'] = $_GET['director'];
} 
if (isset($_GET['email'])){
	$organisation['orgceomail'] = $_GET['email'];
} 
if (isset($_GET['phone']))
{
	$organisation['orgceophone'] = $_GET['phone'];
} 
if (isset($_GET['date']))
{
	$organisation['orgceodate'] = $_GET['date'];
}

if (isset($_GET['assurer'])){
	$organisation['assurer'] = $_GET['assurer'];
}
if (isset($_GET['assurerdate'])){
	$organisation['assurerdate'] = $_GET['assurerdate'];
}
if (isset($_GET['assureremail'])){
	$organisation['assurermail'] = $_GET['assureremail'];
}

//++++ TTP CAP form continue ++++
if (isset($_GET['adress'])){
	$assureraddress[0] = $_GET['adress'];
}
if (isset($_GET['adress1'])){
	$assureraddress[1] = $_GET['adress1'];
}
if (isset($_GET['adress2'])){
	$assureraddress[2] = $_GET['adress2'];
}
if (isset($_GET['adress3'])){
	$assureraddress[3] = $_GET['adress3'];
}
if (isset($_GET['adress4'])){
	$assureraddress[4] = $_GET['adress4'];
}

if (isset($_GET['nocca'])){
	$printcca = $_GET['nocca'];
}
if (isset($_GET['policy1'])){
	$printoap = $_GET['policy1'];
}

if(file_exists(LOGFILE)){
	unlink(LOGFILE);
}
 
// Settings for language
if (isset($_GET['lang'])){
	L10n::set_translation($_GET['lang']);
}else {
	L10n::set_translation('en');
}
L10n::init_gettext("pdfforms");        

//Test values
if ($_GET['fullname']=='test'){
	$organisation['orgname'] = "Heiße Nadel";
	$organisation['orgaddress'] = "Marktstraße 12, 12345 Musterstadt";
	$organisation['orgstate']= "";
	$organisation['orgcountry'] = "DE";
	$organisation['orgtype'] = "GmbH & Co KG";
	$organisation['dba1'] = ""; // trade names

	$organisation['toridentifier'] = "HRB 12345";
	$organisation['tor'] = "Amtsgericht Musterstadt";
	$organisation['torregion'] = "";

	$organisation['domain1'] = "heissenadel";
	$organisation['domain2'] = "heißenadel";
	$organisation['domain4'] = "heisse-nadel";

	$organisation['admin1'] ="Alice";
	$organisation['adminmail1'] ="alice@heissenadel";
	$organisation['admin2'] ="Bob";
	$organisation['adminmail2'] ="bob@heissenadel";

	$organisation['orgceo'] = "Charles"; 
	$organisation['orgceomail'] = "charles@heissenadel";
	$organisation['orgceophone'] = "+31 773270066";
	$organisation['orgceodate'] = "2012-07-22"; 

	$organisation['assurer'] = "My O. Assurer-Name";
	$organisation['assurerdate'] = "2012-07-22";
	$organisation['assurermail'] = "Assurer@cacert.org";
        
	$assureraddress[0] ="Bob";
	$assureraddress[1] ="Avenue1";
	$assureraddress[2] ="Condo 123";
	$assureraddress[3] ="Town";
	$assureraddress[4] ="County";

	$assureename ="Alice";
	$dob ="1960-07-13";
	$email ="alice@acme.com";
	$assurername ="bob";
}

class caPDF extends tFPDF{
	var $htmlSeite=0;
	// Overload  Footer() Method 
	function Footer(){
		if ($this->pdftype=="html"){ 
			// place above lower page margin
			$this->SetY(-7); //-15 
			// define font 
			$this->SetFont(FONT,'I',8);  
			// centered placement of page number 
			$seite=$this->PageNo()-$this->htmlSeite;
			$this->Cell(0,10,'Page '.$seite,0,0,'C');  
		}
	}
}


//start form          
// $pdf = new tFPDF();
$pdf = new caPDF();

// add fonts
$pdf->AddFont('FONT','','FreeSans.ttf',true);
$pdf->AddFont('FONT','B','FreeSansBold.ttf',true);
$pdf->AddFont('FONT','BI','FreeSansBoldOblique.ttf',true);
$pdf->AddFont('FONT','I','FreeSansOblique.ttf',true);
$pdf->AddFont('PierreDingbats','','PierreDingbats.ttf',true);
    
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)

$pdf->SetFont('FreeSans','',14);

//create CAP form
if ($type=='cap'){
	include('include/cap.php');
	FileProperties($pdf,"CAP","Assurance");
	CAPHeader($pdf);
	CAPAssuranceInfo($pdf);
	CAPAssureeInfo($pdf, $assureename , $dob , $email);
	CAPAssurerInfo($pdf, $assurername, $date);
	CAPFooter($pdf);
	if ($assureename=="" and $assurername=""){
		$output='cacert cap blanko.pdf'; 
	}
	if ($assureename=="" and $output=='cacert.pdf'){
		$output='cacert cap assurer.pdf'; 
	} 
	if ($assurername=="" and $output=='cacert.pdf'){
		$output='cacert cap assuree.pdf'; 
	}
}

//create COAP form
if ($type=='coap'){
	//first page
	include('include/coap.php');
	FileProperties($pdf,"COAP","Organisation Assurance");
	COAPHeader($pdf);
	COAPAssuranceInfo($pdf);
	COAPOrganisationInfo($pdf, $organisation);
	COAPOrganisationStatement($pdf, $organisation);
	COAPAssurerStatement($pdf, $organisation);
	COAPFooter($pdf,1,$organisation);
	//second page with witness statement
	$pdf->AddPage();
	COAPWitnessStatemet($pdf, $organisation); 
	COAPWitnessStatemet($pdf, $organisation); 
	COAPFooter($pdf,2,$organisation);
	html2pdf($pdf,WEB."/".POLICY.CCA.".php","CAcert Community Agreement" ); 
	html2pdf($pdf,WEB."/".POLICY.OAP.".php","Organisation Assurance Policy" );    
	$output='cacert coap '.$organisation['orgname'].'.pdf';
}
//create TTP CAP form
if ($type=='ttp'){
	include('include/ttpcap.php');
	//needs to be adjusted when new countries come in
	include('include/ttpcapus.php');    
	FileProperties($pdf,"TTP","Trusted Third Party Assurance");
	TTPCAPFirstPage($pdf, $assureraddress);
	TTPCAPHeader($pdf);
	TTPAssureeInfo($pdf, $assureename , $dob , $email);    
	TTPInfo($pdf);
	TTPAssurer($pdf,$assurername);
	TTPAdvice($pdf);
	TTPAdviceFooter($pdf);
	html2pdf($pdf,WEB."/".POLICY.CCA.".php","CAcert Community Agreement" );   
	$output='cacert ttpcap '.$assureename.'.pdf'; 
}

if ($type=='test'){
	testoutput($pdf);
	$output='test.pdf'; 
} 

if ($output=='cacert.pdf'){ 
	die(printF(_('%s: not correct data sent (p1)'),Error));
}

$pdf->Output($output,'D');

//test
function testoutput($pdf1){
	html2pdf($pdf1,WEB."/".POLICY.CCA.".php","CAcert Community Agreement" );   
}

function html2pdf($pdf1, $url, $title, $title2=""){
	//converts an html page into pdf
	require_once('include/html2pdf.php');
	$fp = fopen($url,"r");
	$strContent = stream_get_contents($fp);
	fclose($fp);
	$pdf1->htmlSeite=$pdf1->PageNo();
	$pdf1->AddPage();
	$pdf1->pdftype="html";    
	WriteHTML($strContent,$pdf1);    
} 


// basic functions  
function TableRow($pdf2, $colums, $width, $border, $strings, $fontsize, $fonttype, $color, $align) {
	//draws a table row
	$posSX=$pdf2->GetX();
	$posX=$pdf2->GetX();
	$posY=$pdf2->GetY();
	$posXC=$posX;
	$height=5;
	//calculate hight of table row
	for($i=0;$i<$colums;$i++){   
		$posXA[$i]=$posXC;
		$posXC+=$width[$i];
		$pdf2->SetFont(FONT,$fonttype[$i],$fontsize[$i]);
		$height1=GetMultiCellHeight($pdf2, $strings[$i], $width[$i]-1) ;
		if ($height<$height1){
			$height=$height1;
		} 
//		writelog("Height: ".$strings[0].' '. $height.' '. $height1);  
	}
	//Draw background
	for($i=0;$i<$colums;$i++){   
		if ($color[$i]!='255, 255, 255') {
			$pdf2->SetFillColor($color[$i]);
			$pdf2->Rect($posXA[$i], $posY, $width[$i], $height,'F');
		} 
//		writelog("Columns: ".$strings[0].' '.$posXA[$i].' '. $posY.' '. $width[$i].' '. $height); 
	}
	//write text in multicell
	for($i=0;$i<$colums;$i++){
		$pdf2->SetY($posY);
		$pdf2->SetX($posX);
		$pdf2->SetFillColor($color[$i]);
		if ($strings[$i]=='q'){
			$pdf2->SetFont('PierreDingbats','',$fontsize[$i]);
		} else {
			$pdf2->SetFont(FONT,$fonttype[$i],$fontsize[$i]);
		}
		$pdf2->MultiCell($width[$i], 5, $strings[$i], 0, $align[$i],0); 
		$posXA[$i]=$posX;
		$posX +=$width[$i];
	}
	//draw rectangles around the areas of the multicell above with the height of the largest multicell
	$posX=$posSX;
	for($i=0;$i<$colums;$i++){
		if($border[$i]==1) {
			$pdf2->Rect($posX, $posY, $width[$i], $height);
//			writelog("Full border: ".$strings[$i].' '.$posX.' '. $posY.' '. $width[$i].' '. $height); 
		} 

		$b = strpos($border[$i],'B');
		if ($b === false) {
		} else {
			$pdf2->Line($posXA[$i], $posY + $height, $posXA[$i] + $width[$i], $posY + $height);
		}

		$b = strpos($border[$i],'T');
		if ($b === false) {
		} else {
			$pdf2->Line($posXA[$i], $posY, $posXA[$i] + $width[$i], $posY);
		}

		$b = strpos($border[$i],'L');
		if ($b === false) {
		} else {
			$pdf2->Line($posXA[$i], $posY, $posXA[$i], $posY + $height);
		}

		$b = stripos($border[$i],'R');
		if ($b === false) {
		} else {
			$pdf2->Line($posXA[$i]+ $width[$i], $posY, $posXA[$i] + $width[$i], $posY + $height);
		}
		$posX +=$width[$i];         
	}

	$pdf2->SetX($posSX);
	$pdf2->SetY($posY + $height);         
}

 function FileProperties($pdf1,$type,$program){
	//sets the file properties for the pdf file
	$pdf1->SetCreator("LibreSSL - CAcert web application");
	$pdf1->SetAuthor("© " . date("Y") . " CAcert Inc., Australia.");
	$pdf1->SetKeywords("X.509, ".$program." Programme, ".$type." form, digital certificates, CAcert, Community Agreement");
	$pdf1->SetTitle("CAcert ".$program." Programme");
	$pdf1->SetCompression(true); // turn it off when more pperformance is needed
}
 
function TableRowVariables(){
	//initialise variables for table printing
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=0;
		$fontsize[$i]=10;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
}
 
 function GetMultiCellHeight($pdf2, $string, $w) { 
	//problem is fontsize is larger then line hight
	$stext =explode("\n",  $string);             //Devide into lines
	$rows=0;
	for ($i=0; $i<count($stext); $i++){
		$str_length = $pdf2->GetStringWidth($stext[$i])+1;          
		$rows += ceil($str_length/ $w);
//		writeLog($string."\n".$stext[$i]."\n".$str_length.' '.$w);           
		$stext1 =explode(" ",  $stext[$i]);     //Devide into words
		for ($j=0; $j<count($stext1); $j++){
			$str_length = $pdf2->GetStringWidth($stext1[$j]);  //check if word is larger then width of MultiCell                 
			if ($str_length > $w){
				$rows += ceil($str_length/ $w)-1; 
			} 
		}
	}  
	$height = ($rows) * 5 ; 
	return ($height > 5 ) ? $height :5;       
} 

function writelog($str) {
	//writes data to a log file
	if ($_GET['fullname']=='test'){
		$save=fopen(LOGFILE,"a");
		$entry = "".date("d.m.Y - H:i:s ").$str."\n"; 
		fputs($save, $entry); 
		fclose($save);
	}
} 


?>                         