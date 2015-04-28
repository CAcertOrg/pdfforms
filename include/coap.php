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
// output for COAP FORM
function COAPHeader($pdf1) {
	//prints CAcert header
	$pdf1->Image('logo/CAcert-logo-colour-1000.png', 10, 5,0,20,'', 'http://www.cacert.org');

	$pdf1->SetFont(FONT,'B','18');
	$pdf1->SetXY(110,8);  //100,8
	$pdf1->MultiCell(90, 8, _("CAcert Organisation Assurance Programme"), 0, 'R', 0);  //100, 8

	$pdf1->SetFont(FONT,'I','8');
	$pdf1->SetXY(10, 22);
	$pdf1->Cell(190, 10, POBOX .' - '. WEB, 0, 1, 'C');

	$pdf1->SetFont(FONT,'','6');
	$pdf1->SetXY(10, 26);
	$pdf1->Cell(190, 10,  sprintF(_("CAcert's root certificate fingerprints SHA1: %s and MD5: %s"), CLASS1_SHA1, CLASS1_MD5), 0, 1, 'C'); // Box(Textbox)

	$pdf1->SetDrawColor(17, 86, 140); //128,128, 128);
	$pdf1->SetLineWidth(0.2);
	$pdf1->Line(10, 34, 200, 34);
	$pdf1->SetY(35);
}

function COAPFooter($pdf1, $page,$organisation) {
	//prints the footer
	$pdf1->SetFont(FONT,'','8');
	$pdf1->SetXY(10, 270);
	$strg="";
	if ($organisation['orgname']!="") {
		$strg= " '".$organisation['orgname']."'";
	}
	$pdf1->Cell(120, 3, sprintF(_('Page %s of %s to COAP'),$page,2).$strg , 0, 1, 'L');
	$pdf1->SetXY(145, 270);
	$pdf1->Cell(55, 3, '('._('printed').': '.date('M Y',time()).')', 0, 1, 'R');
}

function COAPAssuranceInfo($pdf1) {
	//prints the Assurance info block
	// store current margin values
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetFont(FONT,'','10');
	$strg = _("The CAcert Organisation Assurance Programme (COAP) aims to verify the identity of the organisation. The applicant asks the Organisation Assurer to verify to the CAcert Community that the information provided by the applicant is correct and according to the official trade office registration bodies.");
	$pdf1->MultiCell( 190, 4, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);

	$strg = sprintf(_("For more information about the CAcert Organisation Assurance Programme, including contact details to CAcert Organisation Assurers, please visit: %s."), "http://www.cacert.org");
	$pdf1->MultiCell( 190, 4, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);

	$strg = _("The completed forms are kept by the Organisation Assurer for 7 years, and in case of an arbitration request, are sent directly to the Arbitrator.");

	$pdf1->MultiCell( 190, 4, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);
}

function COAPOrganisationInfo($pdf1, $organisation) {
	//prints the organisation block
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=0;
		$fontsize[$i]=10;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
	$cellcnt = 0;
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','14');
	$pdf1->Cell(80, 6, _("Organisation Identity Information"), 0, 1, 'L');

	$cols=2;
	$width[0]=70;
	$width[1]=120;
	$border[0]=1;
	$border[1]=1;
	$fontsize[0]=12;
	$fontsize[1]=10;
	$fonttype[0]='';
	$fonttype[1]='';
	$fillcolor[0]='242, 242, 242';
	$fillcolor[1]='255, 255, 255';

	$pdf1->SetY($pdf1->GetY()+1);
	$posY=$pdf1->GetY();
	$strg[0] = _('Name of the organisation');
	$strg[1] = $organisation['orgname'] ;
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);

	$strg[0] = _("Address (comma separated)");
	$strg[1] = $organisation['orgaddress'] ;
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);

	$strg[0] = _('Type, jurisdiction (state)');
	$strg[1]='';
	foreach( array(  $organisation['orgtype'],  $organisation['orgstate'],  $organisation['orgcountry']) as $i )
	if( $i != "" )  $strg[1] .= ( $strg[1] != "" ? ", ": "") . $i;
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);

	$strg[0] = _('Registration (id, name, region)');
	$strg[1]='';
	foreach( array(  $organisation['toridentifier'], $organisation['tor'], $organisation['torregion']) as $i )
	if( $i != "" )  $strg[1] .= ( $strg[1] != "" ? ", ": "") . $i;
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);

	$strg[0] = _('Internet domain(s)');
	$strg[1]='';
	foreach( array(  $organisation['domain1'], $organisation['domain2'], $organisation['domain3'], $organisation['domain4'], $organisation['domain5'], $organisation['domain6']) as $i )
	if( $i != "" )  $strg[1] .= ( $strg[1] != "" ? ", ": "") . $i;
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);

	$strg[0] = _('Organisation Administrator(s)')."\n"._('(name, primary email address)');
	$strg[1]='';
	foreach( array(  $organisation['admin1'], $organisation['adminmail1']) as $i )
	if( $i != "" )  $strg[1] .= ( $strg[1] != "" ? ", ": "") . $i;
	$strg1='';
	foreach( array(  $organisation['admin2'], $organisation['adminmail2']) as $i )
	if( $i != "" )  $strg1 .= ( $strg1 != "" ? ", ": "") . $i;
	if ($strg!="")   {
		$strg[1] .= "\n".$strg1;
	}
	TableRow($pdf1, $cols, $width, $border, $strg, $fontsize, $fonttype, $fillcolor, $align);
	$pdf1->SetY($pdf1->GetY()+2);
	$pdf1->Rect(8, $posTY, 194, $pdf1->GetY()-$posTY);
}

function COAPOrganisationStatement($pdf1, $organisation) {
	//prints the ogranisation statement block
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=0;
		$fontsize[$i]=10;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+3);
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','14');
	$pdf1->Cell(80, 6, _("Organisation's Statement"), 0, 1, 'L');

	$pdf1->SetFont(FONT,'','10');
	$strg= sprintF(_("Make sure you have read and agreed with the CAcert Community Agreement (%s)."), WEB."/".POLICY.CCA.EXT);
	$pdf1->MultiCell( 190, 4, $strg , 0, 'L', 0, WEB."/".POLICY.CCA.EXT);

	$cols=2;

	$width[0]=70;
	$width[1]=120;
	$border[0]=0;
	$border[1]=0;
	$fontsize[0]=12;
	$fontsize[1]=10;
	$fonttype[0]='B';
	$fonttype[1]='';
	$fillcolor[0]='255, 255, 255';
	$fillcolor[1]='255, 255, 255';

	$pdf1->SetY($pdf1->GetY()+1);
	$posY=$pdf1->GetY();
	$strga[0] = _('Authorized signatory').':';
	$strga[1]= $organisation['orgceo'];
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$fontsize[0]=10;
	$fonttype[0]='';

	$pdf1->SetY($pdf1->GetY()+1);
	$posY=$pdf1->GetY();
	$strga[0] = _('Contact email address').':';
	$strga[1]= $organisation['orgceomail'];
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$pdf1->SetY($pdf1->GetY()+3);

	$width[0]=5;
	$width[1]=185;
	$strga[0]='q'; // checkbox
	$strga[1] =_('I agree to the CAcert Community Agreement').'.';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$strga[0]='q'; // checkbox
	$strga[1] =_('I hereby confirm that all information is complete and accurate and will notify CAcert of any updates or changes thereof').'.';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$strga[0]='q'; // checkbox
	$strga[1] =_('I am duly authorised to act on behalf of the organisation, I grant operational certificate administrative privileges to the specified Organisation Administrator and, I request the Organisation Assurer to verify the organisation information according to the Assurance Policies').'.';
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$posY=$pdf1->GetY();

	if ($organisation['orgceodate'] == ""){
		$dateentry = '20___-___-___';
	} else {
		$dateentry = $organisation['orgceodate'];
	}
	$strg =   _("Date (YYYY-MM-DD)").": ".$dateentry;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($posY);
	$pdf1->SetX(130);

	$strg =  _('Signature and organisation stamp');
	$pdf1->MultiCell( 180, 5, $strg , 0, 'L', 0);

	$pdf1->SetY($pdf1->GetY()+15);
	$pdf1->Rect(8, $posTY, 194, $pdf1->GetY()-$posTY)+2;
}

 function COAPAssurerStatement($pdf1, $organisation) {
	//prints Assurer statement block
	$cols=11;
	for ($i = 0; $i <= $cols-1; $i++) {
		$width[$i]='';
		$border[$i]=0;
		$fontsize[$i]=10;
		$fonttype[$i]='';
		$fillcolor[$i]=WHITE;
		$align[$i]='';
	}
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+3);
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','14');
	$pdf1->Cell(80, 6, _("Organisation Assurer's Statement"), 0, 1, 'L');

	$cols=2;

	$width[0]=70;
	$width[1]=120;
	$border[0]=0;
	$border[1]=0;
	$fontsize[0]=12;
	$fontsize[1]=10;
	$fonttype[0]='B';
	$fonttype[1]='';
	$fillcolor[0]='255, 255, 255';
	$fillcolor[1]='255, 255, 255';

	$pdf1->SetY($pdf1->GetY()+1);
	$posY=$pdf1->GetY();
	$strga[0] = _('Organisation Assurer').':';
	$strga[1]="";
	foreach( array(  $organisation['assurer'], $organisation['assurermail']) as $i )
	if( $i != "" )  $strga[1] .= ( $strga[1] != "" ? ", ": "") . $i;
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$pdf1->SetY($pdf1->GetY()+1);

	$width[0]=5;
	$width[1]=185;
	$strga[0]='q'; // checkbox
	$strga[1] =_("I, the Assurer, hereby confirm that I have verified the official information for the organisation, I will witness the organisation's identity in the CAcert Organisation Assurance Programme, and complete the Assurance.");
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);

	$strga[0]='q'; // checkbox
	$strga[1] =_('I am a CAcert Community Member, have passed the Organisation Assurance Challenge, and have been appointed for Organisation Assurances within the country where the organisation is registered.');
	TableRow($pdf1, $cols, $width, $border, $strga, $fontsize, $fonttype, $fillcolor, $align);
	$posY=$pdf1->GetY();

	if ($organisation['assurerdate'] == ""){
		$dateentry = '20___-___-___';
	} else {
		$dateentry = $organisation['assurerdate'];
	}
	$strg =   _("Date (YYYY-MM-DD)").": ".$dateentry;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($posY);
	$pdf1->SetX(130);

	$strg =  _("Organisation Assurer's signature");
	$pdf1->MultiCell( 180, 5, $strg , 0, 'L', 0);

	$pdf1->SetY($pdf1->GetY()+15);
	$pdf1->Rect(8, $posTY, 194, $pdf1->GetY()-$posTY)+2;
}

 function COAPWitnessStatemet($pdf1, $organisation) {
	//prints the witness block on the second page
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+3);
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+3);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','14');
	$pdf1->MultiCell( 190, 5, _("Witness's Statement") , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->SetFont(FONT,'','10');
	$pdf1->MultiCell( 190, 5,  _("Witness name:") , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->MultiCell( 190, 5, _("Witness primary email address:") , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	if ( $organisation['orgceo']!=''){
		$strg1=  $organisation['orgceo'] ;
	} else {
		$strg1=  '__________________________';
	}
	$strg= sprintF(_('I, named above, verify that I saw %s signing the above CAcert Organisation Assurance Programme form and that I checked the identity.'),$strg1) ;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->MultiCell( 190, 5, _('Location:') , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->MultiCell( 190, 5, _('Date:') , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->MultiCell( 190, 5, _('Signature (add your CARS statement)'), 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+0.5);

	$pdf1->SetFont(FONT,'','7');
	$strg='CARS = CAcert Assurer Reliable Statement (https://wiki.cacert.org/CARS)' ;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0,'https://wiki.cacert.org/CARS');
	$pdf1->SetY($pdf1->GetY()+2);

	$pdf1->Rect(8, $posTY, 194, $pdf1->GetY()-$posTY)+2;
	$pdf1->SetY($pdf1->GetY()+15);
}

?>
