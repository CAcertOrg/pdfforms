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
//Defines texts for the TTP CAP form
//American Version
//Assuree text
define('ASSUREE','Applicant');
define('TEXT_1A','I request a TTP TOPUP assurance');
define('TEXT_1B','Yes');
define('TEXT_1C','No');
define('TEXT_2A','Date of Birth: (YYYY-MM-DD)');
define('DOB','1900-01-01');
define('TEXT_3A','Name:');
define('ASSUREENAMES','John Doe');
define('TEXT_4A','Email Address:');
define('ASSUREEMAIL','assuree@c.o.');
define('TEXT_5A','I hereby confirm that the information stated above is both true and correct, and request the TTP (identified below) confirm my statements and the TTP Admin (identified below) verify me according to CAcert TTP Assurance Policy.');
define('TEXT_6A','I have read and agree to the CAcert Community Agreement (CCA). (http://www.cacert.org/policy/CAcertCommunityAgreement.html)');
define('TEXT_7A','I confirm that I am aware of the R/L/O as outlined in sections 2.1,2.2, and 2.3 of the CCA');
define('TEXT_8A','I confirm that I am aware of the CAcert internal arbitration requirement and accept internal arbitration');
define('TEXT_9A','I confirm that the email address listed on this CAP form is used as primary mail address for the account during the TTP assurance process and that I know that I need to have a working email address as the primary address in my CAcert account');
define('TEXT_10A','Applicant signature: ___________________________');
define('TEXT_10B','Date(YYYY-MM-DD): 20___-___-___');
define('TEXT_10C','(to be checked by TTP)');
define('TEXT_11A','Presented ID documents');
define('TEXT_11B','Passport');
define('TEXT_11C','ID card');
define('TEXT_11D','Driver licence');
define('TEXT_11E','Other:');
//TTP text
define('TTPPARTY',"Trusted Third Party Verifying Applicant's Identity");
define('TEXT_12','Name:');
define('TEXT_13A','Profession:');
define('TEXT_13B','(eg Notary Public, Justice of the Peace)');
define('TEXT_14A','Commission/Notary Number:');
define('TEXT_14B','(as applicable):');
define('TEXT_15','Address:');
define('TEXT_16A','City/County of ___________________, State/Commonwealth of_________________');
define('TEXT_16B','The forgoing instrument was subscribed and sworn before me on this ______ day of ______, 20____');
define('TEXT_16C','by ___________________________');
define('TEXT_16D','affidavit number: ___________________________');
define('TEXT_17A','TTP signature and seal: ___________________________');
define('TEXT_17B','Date(YYYY-MM-DD): 20___-___-___');
//TTP Assurer text
define('TTPAssurer','TTP Assurer (TTP-Admin)');
define('TTPADMINNAME','Example name');
define('TEXT_18','Points Allocated:');
define('TEXT_19A','I, the Assurer, hereby confirm that I have verified the Member according to CAcert TTP Assurance Policy.');
define('TEXT_19B','I am a CAcert Community Member, have passed the Assurance Challenge, and have been assured with at least 150 Assurance Points and are appointed as TTP Admin');
define('TEXT_20A',"TTP Admin's signature: ___________________________");
define('TEXT_20B','Date(YYYY-MM-DD): 20___-___-___');
define('TTPADMINSTREET1','Example Street 10');
define('TTPADMINSTREET2','Example Street 20');
define('TTPADMINTOWN','Exampletown');
define('TTPADMINCOUNTRY','Country');

//TTP advice text on seperate page
define('TEXT_A1','Notes to the Trusted Third Party');
define('TEXT_A2','CAcert.org (www.cacert.org) is a community based Certificate Authority that issues no charge (free) digital certificates that can be used to secure electronic data and communications, including but not limited to, email and web servers.  In addition, certificates issued by CAcert.org can be used to assert an identity to others.  For this identity assertion to be valid and trusted, the true identity of the individual must be verified. CAcert uses a Web of Trust (WoT) (see http://en.wikipedia.org/wiki/Web_of_trust) method to ensure identities.  This Trusted Third Party (TTP) Assisted Assurance assists in the verification of the identity of the individual involved.');
define('TEXT_A3','The purpose of this document is to validate that the person who appears in front of you is actually who they say they are.  Please verify the individuals identity documents as per your states Notarial requirements.');
define('TEXT_A4','Guide for the TTP in completing the TTPCAP form');
define('TEXT_A5','Please check the boxes in the column A (filled by TTP/Notary) as you work through the form. The boxes in column B are for the TTPAdmin.');
define('TEXT_AT1','Check the box if the applicant requests a TTP TOPUP.');
define('TEXT_AT2','Verify the applicants age. If the applicant is not 18 or older, DO NOT COMPLETE OR SIGN the TTPCAP form.');
define('TEXT_AT3',"Check if the presented names match the names in the ID documents. The CAcert Practice on Names document allows to have less given names stated the application form then in the ID documents. Abbreviation of given names are also allowed as long as at least on given name is given in full length. (see: http://wiki.cacert.org/PracticeOnNames) \nIf the names differ from the ones in the ID documents please copy all names on the backside of TTPCAP form.");
define('TEXT_AT4','Verify with the applicant that the stated email address is correct');
define('TEXT_AT5_9','Verify that the applicant agrees to all 5 statements. If not DO NOT COMPLETE OR SIGN the TTPCAP form.');
define('TEXT_AT10','Witness the applicant sign the TTPCAP form.');
define('TEXT_AT11',"Note all of the verified identity documents that the applicant presented. If you have ANY doubts or concerns about the Applicant's identity or presented documents, DO NOT COMPLETE OR SIGN the TTPCAP form. \nIf you are unsure see the CAcert wiki (http://wiki.cacert.org/AcceptableDocuments) for help");
define('TEXT_AT12','Fill in your name. Exception: If you are a CAcert Assurer please STOP THE PROCESS and do a normal CAcert assurances.');
define('TEXT_AT13','Fill in your capacity as the TTP.');
define('TEXT_AT14','Fill in if applicable your Commission or Notary Number.');
define('TEXT_AT15','Fill in your mailing address.');
define('TEXT_AT16','Complete the Notarial statement and if applicable insert the affidavit number.');
define('TEXT_AT17','Statement by TTP: CAcert Assurer (see note under 13.).');
define('TEXT_A6','Sign and imprint your notarial seal the TTPCAP form. The TTP will send the TTPCAP form to the address on address sheet (1.)');
define('TEXT_AT18_20','Are filled by the TTPAdmin. The TTPAdmin will keep the TTPCAP form for 7 years and will initiate the TTP TOPUP if requested. ');

?>
