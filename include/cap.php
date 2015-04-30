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

// output for CAP FORM
 function CAPHeader($pdf1) {
	//prints CAcert header for
	$pdf1->Image('logo/CAcert-logo-colour-1000.png', 10, 5,0,20,'', 'http://www.cacert.org');
	$pdf1->SetFont(FONT,'B','18');
	$pdf1->SetXY(100, 10);
	$pdf1->Cell(90, 10, _("CAcert Assurance Programme"), 0, 1, 'L');

	$pdf1->SetXY(100, 16);
	$pdf1->Cell(90, 10, _("Identity Verification Form"), 0, 1, 'L');

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

function CAPFooter($pdf1) {
	//prints the footer
	$pdf1->SetXY(145, 265);
	$pdf1->Cell(55, 10, '('._('printed').': '.date('M Y',time()).')', 0, 1, 'R');
}

function CAPAssuranceInfo($pdf1) {
	//prints the assurer info
	// store current margin values
	$linehight=4;
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetFont(FONT,'','10');
	$strg = sprintf(_("To the Assurer: The CAcert Assurance Programme (CAP) aims to verify the identities of Internet users through face-to-face witnessing of government issued identity documents. The applicant asks you to verify to CAcert.org that you have met them and verified their identity against one or more original, trusted, government photo identity documents. If you have ANY doubts or concerns about the applicant's identity, DO NOT COMPLETE OR SIGN this form. For more information about the CAcert Assurance Programme, including detailed guides for CAcert Assurers, please visit: %s."), "http://www.CAcert.org");
	$pdf1->MultiCell( 190, $linehight, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);

	$strg = _("As the assurer, you are required to keep the signed document on file for 7 years. Should CAcert Inc. have any concerns about a meeting taken place, CAcert Inc. can request proof in the form of this signed document, to ensure the process is being followed correctly. After 7 years you should dispose of this form in a secure way to preclude theft of personal data, preferably by shredding or burning it. You must not retain copies of any ID documents.");
	$pdf1->MultiCell( 190, $linehight, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);

	$strg = _("It's encouraged that you tear the top of this form off and give it to the person you are assuring as a reminder to sign up, and as a side benefit the tear off section also contains a method of offline verification of our fingerprints.");
	$pdf1->MultiCell( 190, $linehight, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);
}

function CAPAssureeInfo($pdf1, $assureename = "", $dob = "", $email = "", $date="") {
	//prints the assuree data block
	// store current margin values
	$cellcnt = 0;
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','18');
	$pdf1->Cell(80, 10, _("Applicant's Statement"), 0, 1, 'L');

	$pdf1->SetFont(FONT,'B','12');
	$posY=$pdf1->GetY();
	$pdf1->Cell(80, 8,  _('Names').':', 1, 1, 'L');

	$pdf1->SetFont(FONT,'B','12');
	$pdf1->Cell(80, 8, _("Date of Birth").':', 1, 1, 'L');

	$pdf1->SetFont(FONT,'B','12');
	$pdf1->Cell(80, 8, _("Email Address").':', 1, 1, 'L');

	$pdf1->SetFont(FONT,'','12');
	$pdf1->SetY($posY);
	$pdf1->SetX(90);
	$pdf1->Cell(106, 8, $assureename, 1, 1, 'L');
	$pdf1->SetX(90);
	$pdf1->Cell(106, 8, $dob , 1, 1, 'L');
	$pdf1->SetX(90);
	$pdf1->Cell(106, 8, $email, 1, 1, 'L');

	$pdf1->SetY($pdf1->GetY()+2);

	$pdf1->SetFont(FONT,'','9');
	$strg = _("I hereby confirm that the information stated above is both true and correct, and request the CAcert Assurer (identified below) to verify me according to CAcert Assurance Policy.");
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+2);

	$strg = _("I agree to the CAcert Community Agreement.")." (http://www.cacert.org/policy/CAcertCommunityAgreement.html)";
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+10);

	$posY=$pdf1->GetY();
	$strg =  _("Applicant's signature").": __________________________________";
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);

	if ($date == ""){
		$dateentry = '20___-___-___';
	} else {
		$dateentry = $date;
	}
	$pdf1->SetY($posY);
	$pdf1->SetX(140);
	$strg =   _("Date (YYYY-MM-DD)").": ".$dateentry;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);
	$pdf1->Rect(8, $posTY, 190, $pdf1->GetY()-$posTY);
}

function CAPAssurerInfo($pdf1, $assurername = "", $date="", $maxpoints=0) {
	//prints the Assurer block
	// store current margin values
	$cellcnt = 0;
	$pdf1->SetY($pdf1->GetY()+10);
	$posTY=$pdf1->GetY();
	$pdf1->SetY($pdf1->GetY()+0.5);
	$pdf1->SetX(12);

	$pdf1->SetFont(FONT,'BIU','18');
	$pdf1->Cell(80, 10, _('CAcert Assurer'), 0, 1, 'L');
	$pdf1->SetY($pdf1->GetY()+0,5);

	$pdf1->SetFont(FONT,'','12');
	$pdf1->Cell(150, 6, _("Assurer's Name").':', 'B', 1 , 'L');
	$pdf1->SetY($pdf1->GetY()+5);

	$pdf1->SetFont(FONT,'','9');
	$strg = _("Photo ID Shown: (ID types, not numbers. eg Drivers license, Passport)");
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$strg = "1. __________________________________________________________________";
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$strg = "2. __________________________________________________________________";
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+3);

	$strg = _("Location of Face-to-face Meeting").': _____________________________________________';
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+3);

	if($maxpoints > 0){
		$strg = _("Maximum Points").': '.$maxpoints;
	} else {
		$strg = _("Points Allocated").': ______________';
	}
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+3);

	$strg = _("Location of Face-to-face Meeting").': _____________________________________________';
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+5);

	$strg = _('I, the Assurer, hereby confirm that I have verified the Member according to CAcert Assurance Policy.');
	$pdf1->MultiCell( 188, 3, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+2);

	$posY=$pdf1->GetY();
	$strg =  _("I am a CAcert Community Member, have passed the Assurance Challenge, and have been assured with at least 100 Assurance Points.");
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+4);
	$posY=$pdf1->GetY();
	$strg =  _("Assurer's signature").": __________________________________";
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);

	if ($date == ""){
		$dateentry = '20___-___-___';
	} else {
		$dateentry = $date;
	 }
	$pdf1->SetY($posY);
	$pdf1->SetX(140);
	$strg =   _("Date (YYYY-MM-DD)").": ".$dateentry;
	$pdf1->MultiCell( 190, 5, $strg , 0, 'L', 0);
	$pdf1->SetY($pdf1->GetY()+1);
	$pdf1->Rect(8, $posTY, 190, $pdf1->GetY()-$posTY);
}
?>
