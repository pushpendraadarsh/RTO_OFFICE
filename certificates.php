<?php
require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');
$pdf = new FPDF('P','mm','A4');
//Add Fonts
$pdf->AddFont('seoge-UI','','seoge-UI.php');
$pdf->AddFont('seoge-UI-Bold','','Rubik-Medium.php');

$pdf->AddPage();
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_GET['certificateNo'])) {
    /***********************Constant data**************************** */
    $dealerId = $_SESSION['dealerId'];
    $OrganizationName = "SYN AUTO SOLUTIONS PVT. LTD.";
    $OrganizationAddress = "STREET NO. 11,KADIPUR INDUSTRIAL AREA,GURUGRAM,HARYANA-122001";
    $OrganizationEmail = "synautosolutionspvt.ltd@gmail.com";
    $LogoPath = "images/logo.png";
    /***************** Select data from MySQL database******************/
$certificateNo = $_GET['certificateNo'];
$select = "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerId' && certificateno='$certificateNo'";
$result = $conn->query($select);
$select2 = "SELECT * FROM dealerdemographicdata WHERE dealer_id='$dealerId'";
$result2 = $conn->query($select2);
if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0) {
$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

/*********Customer Data************/
$cusName = strtoupper($row['name']);
$cusContact = strtoupper($row['mobno']);
$cusAddress = strtoupper($row['address']);
$invoiceDatePre = $row['invoicedate'];
$invoiceDate = date("d-m-Y", strtotime($invoiceDatePre));
$invoiceno_date = $row['invoiceno'].'/'.$invoiceDate;
$invoiceDateAft1YrsPending =  adddate($invoiceDate,"1 year");
$invoiceDateAft1Yrs = substract_date($invoiceDateAft1YrsPending,"1 days");
$vehicalNo = strtoupper($row['vehicalregistrationno']);
$makeModel = strtoupper($row['model']);
$vehicalmanufactureyear = $row['vehicalmanufactureyear'];
$serialno =strtoupper( $row['serialno']);
$engineno = strtoupper($row['engineno']);
$chasisno = strtoupper($row['chasisno']);
$speed = $row['speed'];
$rotorsealno = $row['rotorsealno'];
$approvalno = strtoupper($row['approvalno']);
$rto = strtoupper($row['rto'].'/'.$row['rtostate']);
/***************dealer Data****************** */
$dealerName = strtoupper($row2['firstName'].' '.$row2['lastName']);
$dealerAddress = strtoupper($row2['address']);
/****************************QR DATA ASSETS***************************** */
 $codeText =  'Mfg by : SYN AUTO SOLUTIONS PVT. LTD. | Installed by : '.$dealerName.' | Certificate No.: '.$certificateNo.' |  Date of AMC : '.$invoiceDate.'| Renewal Date : 
 '.$invoiceDateAft1Yrs.'| Owner Name : 
 '.$cusName.' | Make/Model : '.$makeModel.' |
 Vehicle No. : '.$vehicalNo.' | Engine No. :'.$engineno.' | Chasis No.:  '.$chasisno.' | Type Approval No.: CT0VN '.$approvalno.' |  Invoice No.: '.$invoiceno_date.' |  Speed : '.$speed.' | Roto Seal No.: '.$rotorsealno.' | RTO/State : '.$rto.' |  Device Serial No.: '.$serialno;

    QRcode::png($codeText,'006_L.png');
$qr = '006_L.png';
/************************************************************************************************************/
//page border
$pdf->Rect(5, 5, 200, 287, 'S');
//Cell(width , height , text , border , end line , [align] )

$pdf->Image($LogoPath,13.5,6,25.8,17.2);
$pdf->SetFont('Arial','B',14,1);
$pdf->SetTextColor(26, 34, 117);
$pdf->Cell(190,5,$OrganizationName,0,0,"C");
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('arial','',9);
// $pdf->Cell(-5,5,'(Customer Copy)',1,1,"R");
$pdf->Text(170,13,"(Manufacturer Copy)");
$pdf->SetFont('Arial','B',8);
$pdf->Text(79.2,17.5,'AN ISO Certified Company 9001 : 2015');
$pdf->Text(53,21.5,$OrganizationAddress);
$pdf->Text(76,25.5,'Email: '.$OrganizationEmail);
//Image(url, )
$pdf->Image($qr,162,14,42,42,'png');
$pdf->SetFont('Arial','B',10);
$pdf->Text(158,59,'Date of AMC: '.$invoiceDate,);

$pdf->SetFont('Arial','',10);
$pdf->Text(11,46,'A.M.C. NO.: '.$certificateNo);
$pdf->SetFont('Arial','B',13);
$pdf->SetTextColor(228, 25, 25);
$pdf->setXY(104.5,40.5);
$pdf->Cell(1,1,'Mfg. of SPEED LIMITER DEVICE',0,0,"C");

$pdf->SetFont('Arial','BU',10);
$pdf->SetTextColor(0,0,0);
$pdf->setXY(95,44);
$pdf->Cell(20,10,'Agreement of Service Contract',0,1,"C");

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,58.2,'Other Part');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,64,'Whereas, AS THE EMPLOYER Shri/M/s '.$dealerName.' its address');
$pdf->Text(11,68,$dealerAddress);
$pdf->Text(11,72,'is serious of hiring the service of the contractor for repair and maintenance of 1 (one) unit of speed governor');
$pdf->Text(11,76,''.$dealerName.' make, installed in Vehicle No. '.$vehicalNo.'.');
$pdf->Text(11,80,' The contract is for a limited period of 12 months starting from ('.$invoiceDate.' to '.$invoiceDateAft1Yrs.')');

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,88.2,'WHEREAS');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,94,'In pursuant of circular issued by Transport department government of NCT Delhi, where in guidelines have been given to');
$pdf->Text(11,98,'provide AMC for speed governors along with the vehicle, the contractor has agreed to undertake the said repair and');
$pdf->Text(11,102.3,'maintenance and provide AMC on the conditions mentioned below:');

$pdf->Rect(11, 105, 190, 35, 'S');
$heiCusDetTab = 3;
$heiCusDetTab2 = 5;
$pdf->SetFont('Arial','B',10);
$pdf->Text(16,110,'A detail of Vehicle and customer is as follow:');
//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','',9);
$pdf->setXY(15,112.5);
$pdf->Cell(80,$heiCusDetTab,"Customer Name : ".$cusName,0,0);
$pdf->Cell(45,$heiCusDetTab,"Contact No : ".$cusContact,0,0);
$pdf->Cell(60,$heiCusDetTab,"Invoice No. & Date : ".$invoiceno_date,0,1);
$pdf->setXY(15,116.5);
$pdf->Cell(185,$heiCusDetTab2,"Customer Address : ".$cusAddress,0,1);
$pdf->setXY(15,121.5);
$pdf->Cell(70,$heiCusDetTab2,"Make/Model : ".$makeModel,0,0);
$pdf->Cell(55,$heiCusDetTab2,"Vehicle Manufacturing Year : ".$vehicalmanufactureyear,0,0);
$pdf->Cell(65,$heiCusDetTab2,"Serial No : ".$engineno,0,1);
$pdf->setXY(15,126.5);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Engine No.: ".$serialno,0,0);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Chasis No.: ".$chasisno,0,0);
$pdf->Cell(45,$heiCusDetTab2,"Test Report No.: CT0VN ".$approvalno,0,1);
$pdf->setXY(15,131.5);
$pdf->Cell(40,$heiCusDetTab2,"COP No. : CC0BM5369",0,0);
$pdf->Cell(40,$heiCusDetTab2,"TAC No. : CH5027",0,0);
$pdf->Cell(25,$heiCusDetTab2,"Speed : ".$speed,0,0);
$pdf->Cell(34,$heiCusDetTab2,"Roto Seal No.: ".$rotorsealno,0,0);
$pdf->Cell(46,$heiCusDetTab2,"RTO/State : ".$rto,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(117, 113, 113);
$pdf->Text(16,140,'This is to Certify the Vehicle is resealed in my presence and Electronic Speed Governor is working at set speed of '.$speed.'(+2%) KMPH');

// $data = array('17/02/025','');

// $header = array('Date - Periodic Check (Every 3 Months)', 'AMC Check No.');
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',9.7);
$pdf->setXY(11,142);
$pdf->SetMargins(23, 44, 11.7);
$pdf->Cell(95,5,'Date - Periodic Check (Every 3 Months)',1,0,'C');
$pdf->Cell(95,5,'AMC Check No.',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"3 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"6 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"9 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,7,adddate($invoiceDate,"12 month"),1,0,'C');
$pdf->Cell(95,7,'',1,1,'C');

$pdf->SetFont('Arial','B',11);
$pdf->Text(11,173,'TERMS AND CONDITIONS ARE AS FOLLOWS:');
$pdf->SetFont('Arial','',9);
$pdf->Text(11,180,'1. AMC charges shall Rupees................ be for a period of 12 months from the date of signing of the Contract.');
$pdf->Text(11,184,'2. One time free service for will be provide within the AMC period.');
$pdf->Text(11,188,'3. As per the guidelines every vehicle fitted with speed governor shall visit service point every 3 months of calibration and accuracy of the');
$pdf->Text(11,192,'speed governors.');
$pdf->Text(11,196,'4. Three months warranty on spare parts will be given from the date of fitment.');
$pdf->Text(11,200,'5. A sticker mentioning the validity of the AMC shall be provided and pasted on the left corner of the front wind shield.Any attempt to');
$pdf->Text(11,204,'tamper with the sticker shall invalidate the AMC.');
$pdf->Text(11,208,'6. The vehicle owner/employer shall bring the Vehicle to Contractor service point for availing the AMC');
$pdf->Text(11,212,'7. The Contractor shall ensure deployment of trained technical technician and staff for providing ser ices to the employer/Vehicle own of');
$pdf->Text(11,216,'speed governor.');
$pdf->Text(11,220,'8. No spare parts shall be covered under this A.MC. Any non-functional parts like Sensor, Solenoid, PCB, sealing kit and harnesses shall');
$pdf->Text(11,224,'be charged extra');
$pdf->setXY(11,225);
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(32, 8, 88);
$pdf->Cell(190,6,$OrganizationName,0,1,'C');
$pdf->Image('images/noImageAvailable.png',11,232,40,40);
$pdf->Image('images/noImageAvailable.png',61,232,40,40);
$pdf->Image('images/noImageAvailable.png',111,232,40,40);
$pdf->Image('images/noImageAvailable.png',161,232,40,40);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Text(10,291,'Customer Signature');
$pdf->Text(160,291,'Authorized Signatory');
$pdf->SetFont('Arial','I',8);
$pdf->Text(95, 295, "Page " . $pdf->PageNo() . "/4");
/*******************************************Second Page********************************************* */
$pdf->AddPage();
//page border
$pdf->Rect(5, 5, 200, 287, 'S');
//Cell(width , height , text , border , end line , [align] )

$pdf->Image($LogoPath,13.5,6,25.8,17.2);
$pdf->SetFont('Arial','B',14,1);
$pdf->SetTextColor(26, 34, 117);
$pdf->setXY(10,10);
$pdf->Cell(190,5,$OrganizationName,0,0,"C");
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('arial','',9);
// $pdf->Cell(-5,5,'(Customer Copy)',1,1,"R");
$pdf->Text(170,13,"(Dealer/Distributor Copy)");
$pdf->SetFont('Arial','B',8);
$pdf->Text(79.2,17.5,'AN ISO Certified Company 9001 : 2015');
$pdf->Text(53,21.5,$OrganizationAddress);
$pdf->Text(76,25.5,'Email: '.$OrganizationEmail);
//Image(url, )
$pdf->Image($qr,162,14,42,42,'png');
$pdf->SetFont('Arial','B',10);
$pdf->Text(158,59,'Date of AMC: '.$invoiceDate,);

$pdf->SetFont('Arial','',10);
$pdf->Text(11,46,'A.M.C. NO.: '.$certificateNo);
$pdf->SetFont('Arial','B',13);
$pdf->SetTextColor(228, 25, 25);
$pdf->setXY(104.5,40.5);
$pdf->Cell(1,1,'Mfg. of SPEED LIMITER DEVICE',0,0,"C");

$pdf->SetFont('Arial','BU',10);
$pdf->SetTextColor(0,0,0);
$pdf->setXY(95,44);
$pdf->Cell(20,10,'Agreement of Service Contract',0,1,"C");

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,58.2,'Other Part');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,64,'Whereas, AS THE EMPLOYER Shri/M/s '.$dealerName.' its address');
$pdf->Text(11,68,$dealerAddress);
$pdf->Text(11,72,'is serious of hiring the service of the contractor for repair and maintenance of 1 (one) unit of speed governor');
$pdf->Text(11,76,''.$dealerName.' make, installed in Vehicle No. '.$vehicalNo.'.');
$pdf->Text(11,80,' The contract is for a limited period of 12 months starting from ('.$invoiceDate.' to '.$invoiceDateAft1Yrs.')');

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,88.2,'WHEREAS');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,94,'In pursuant of circular issued by Transport department government of NCT Delhi, where in guidelines have been given to');
$pdf->Text(11,98,'provide AMC for speed governors along with the vehicle, the contractor has agreed to undertake the said repair and');
$pdf->Text(11,102.3,'maintenance and provide AMC on the conditions mentioned below:');

$pdf->Rect(11, 105, 190, 35, 'S');
$heiCusDetTab = 3;
$heiCusDetTab2 = 5;
$pdf->SetFont('Arial','B',10);
$pdf->Text(16,110,'A detail of Vehicle and customer is as follow:');
//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','',9);
$pdf->setXY(15,112.5);
$pdf->Cell(80,$heiCusDetTab,"Customer Name : ".$cusName,0,0);
$pdf->Cell(45,$heiCusDetTab,"Contact No : ".$cusContact,0,0);
$pdf->Cell(60,$heiCusDetTab,"Invoice No. & Date : ".$invoiceno_date,0,1);
$pdf->setXY(15,116.5);
$pdf->Cell(185,$heiCusDetTab2,"Customer Address : ".$cusAddress,0,1);
$pdf->setXY(15,121.5);
$pdf->Cell(70,$heiCusDetTab2,"Make/Model : ".$makeModel,0,0);
$pdf->Cell(55,$heiCusDetTab2,"Vehicle Manufacturing Year : ".$vehicalmanufactureyear,0,0);
$pdf->Cell(65,$heiCusDetTab2,"Serial No : ".$engineno,0,1);
$pdf->setXY(15,126.5);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Engine No.: ".$serialno,0,0);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Chasis No.: ".$chasisno,0,0);
$pdf->Cell(45,$heiCusDetTab2,"Test Report No.: CT0VN ".$approvalno,0,1);
$pdf->setXY(15,131.5);
$pdf->Cell(40,$heiCusDetTab2,"COP No. : CC0BM5369",0,0);
$pdf->Cell(40,$heiCusDetTab2,"TAC No. : CH5027",0,0);
$pdf->Cell(25,$heiCusDetTab2,"Speed : ".$speed,0,0);
$pdf->Cell(34,$heiCusDetTab2,"Roto Seal No.: ".$rotorsealno,0,0);
$pdf->Cell(46,$heiCusDetTab2,"RTO/State : ".$rto,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(117, 113, 113);
$pdf->Text(16,140,'This is to Certify the Vehicle is resealed in my presence and Electronic Speed Governor is working at set speed of '.$speed.'(+2%) KMPH');

// $data = array('17/02/025','');

// $header = array('Date - Periodic Check (Every 3 Months)', 'AMC Check No.');
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',9.7);
$pdf->setXY(11,142);
$pdf->SetMargins(23, 44, 11.7);
$pdf->Cell(95,5,'Date - Periodic Check (Every 3 Months)',1,0,'C');
$pdf->Cell(95,5,'AMC Check No.',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"3 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"6 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"9 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,7,adddate($invoiceDate,"12 month"),1,0,'C');
$pdf->Cell(95,7,'',1,1,'C');

$pdf->SetFont('Arial','B',11);
$pdf->Text(11,173,'TERMS AND CONDITIONS ARE AS FOLLOWS:');
$pdf->SetFont('Arial','',9);
$pdf->Text(11,180,'1. AMC charges shall Rupees................ be for a period of 12 months from the date of signing of the Contract.');
$pdf->Text(11,184,'2. One time free service for will be provide within the AMC period.');
$pdf->Text(11,188,'3. As per the guidelines every vehicle fitted with speed governor shall visit service point every 3 months of calibration and accuracy of the');
$pdf->Text(11,192,'speed governors.');
$pdf->Text(11,196,'4. Three months warranty on spare parts will be given from the date of fitment.');
$pdf->Text(11,200,'5. A sticker mentioning the validity of the AMC shall be provided and pasted on the left corner of the front wind shield.Any attempt to');
$pdf->Text(11,204,'tamper with the sticker shall invalidate the AMC.');
$pdf->Text(11,208,'6. The vehicle owner/employer shall bring the Vehicle to Contractor service point for availing the AMC');
$pdf->Text(11,212,'7. The Contractor shall ensure deployment of trained technical technician and staff for providing ser ices to the employer/Vehicle own of');
$pdf->Text(11,216,'speed governor.');
$pdf->Text(11,220,'8. No spare parts shall be covered under this A.MC. Any non-functional parts like Sensor, Solenoid, PCB, sealing kit and harnesses shall');
$pdf->Text(11,224,'be charged extra');
$pdf->setXY(11,225);
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(32, 8, 88);
$pdf->Cell(190,6,$OrganizationName,0,1,'C');
$pdf->Image('images/noImageAvailable.png',11,232,40,40);
$pdf->Image('images/noImageAvailable.png',61,232,40,40);
$pdf->Image('images/noImageAvailable.png',111,232,40,40);
$pdf->Image('images/noImageAvailable.png',161,232,40,40);

$pdf->SetFont('seoge-UI-Bold','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Text(10,291,'Customer Signature');
$pdf->Text(160,291,'Authorized Signatory');
$pdf->SetFont('Arial','I',8);
$pdf->Text(95, 295, "Page " . $pdf->PageNo() . "/4");
/*******************************************Third Page********************************************* */
$pdf->AddPage();
//page border
$pdf->Rect(5, 5, 200, 287, 'S');
//Cell(width , height , text , border , end line , [align] )

$pdf->Image($LogoPath,13.5,6,25.8,17.2);
$pdf->SetFont('Arial','B',14,1);
$pdf->SetTextColor(26, 34, 117);
$pdf->setXY(10,10);
$pdf->Cell(190,5,$OrganizationName,0,0,"C");
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('arial','',9);
// $pdf->Cell(-5,5,'(Customer Copy)',1,1,"R");
$pdf->Text(170,13,"(Customer Copy)");
$pdf->SetFont('Arial','B',8);
$pdf->Text(79.2,17.5,'AN ISO Certified Company 9001 : 2015');
$pdf->Text(53,21.5,$OrganizationAddress);
$pdf->Text(76,25.5,'Email: '.$OrganizationEmail);
//Image(url, )
$pdf->Image($qr,162,14,42,42,'png');
$pdf->SetFont('Arial','B',10);
$pdf->Text(158,59,'Date of AMC: '.$invoiceDate,);

$pdf->SetFont('Arial','',10);
$pdf->Text(11,46,'A.M.C. NO.: '.$certificateNo);
$pdf->SetFont('Arial','B',13);
$pdf->SetTextColor(228, 25, 25);
$pdf->setXY(104.5,40.5);
$pdf->Cell(1,1,'Mfg. of SPEED LIMITER DEVICE',0,0,"C");

$pdf->SetFont('Arial','BU',10);
$pdf->SetTextColor(0,0,0);
$pdf->setXY(95,44);
$pdf->Cell(20,10,'Agreement of Service Contract',0,1,"C");

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,58.2,'Other Part');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,64,'Whereas, AS THE EMPLOYER Shri/M/s '.$dealerName.' its address');
$pdf->Text(11,68,$dealerAddress);
$pdf->Text(11,72,'is serious of hiring the service of the contractor for repair and maintenance of 1 (one) unit of speed governor');
$pdf->Text(11,76,''.$dealerName.' make, installed in Vehicle No. '.$vehicalNo.'.');
$pdf->Text(11,80,' The contract is for a limited period of 12 months starting from ('.$invoiceDate.' to '.$invoiceDateAft1Yrs.')');

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,88.2,'WHEREAS');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,94,'In pursuant of circular issued by Transport department government of NCT Delhi, where in guidelines have been given to');
$pdf->Text(11,98,'provide AMC for speed governors along with the vehicle, the contractor has agreed to undertake the said repair and');
$pdf->Text(11,102.3,'maintenance and provide AMC on the conditions mentioned below:');

$pdf->Rect(11, 105, 190, 35, 'S');
$heiCusDetTab = 3;
$heiCusDetTab2 = 5;
$pdf->SetFont('Arial','B',10);
$pdf->Text(16,110,'A detail of Vehicle and customer is as follow:');
//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','',9);
$pdf->setXY(15,112.5);
$pdf->Cell(80,$heiCusDetTab,"Customer Name : ".$cusName,0,0);
$pdf->Cell(45,$heiCusDetTab,"Contact No : ".$cusContact,0,0);
$pdf->Cell(60,$heiCusDetTab,"Invoice No. & Date : ".$invoiceno_date,0,1);
$pdf->setXY(15,116.5);
$pdf->Cell(185,$heiCusDetTab2,"Customer Address : ".$cusAddress,0,1);
$pdf->setXY(15,121.5);
$pdf->Cell(70,$heiCusDetTab2,"Make/Model : ".$makeModel,0,0);
$pdf->Cell(55,$heiCusDetTab2,"Vehicle Manufacturing Year : ".$vehicalmanufactureyear,0,0);
$pdf->Cell(65,$heiCusDetTab2,"Serial No : ".$engineno,0,1);
$pdf->setXY(15,126.5);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Engine No.: ".$serialno,0,0);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Chasis No.: ".$chasisno,0,0);
$pdf->Cell(45,$heiCusDetTab2,"Test Report No.: CT0VN ".$approvalno,0,1);
$pdf->setXY(15,131.5);
$pdf->Cell(40,$heiCusDetTab2,"COP No. : CC0BM5369",0,0);
$pdf->Cell(40,$heiCusDetTab2,"TAC No. : CH5027",0,0);
$pdf->Cell(25,$heiCusDetTab2,"Speed : ".$speed,0,0);
$pdf->Cell(34,$heiCusDetTab2,"Roto Seal No.: ".$rotorsealno,0,0);
$pdf->Cell(46,$heiCusDetTab2,"RTO/State : ".$rto,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(117, 113, 113);
$pdf->Text(16,140,'This is to Certify the Vehicle is resealed in my presence and Electronic Speed Governor is working at set speed of '.$speed.'(+2%) KMPH');

// $header = array('Date - Periodic Check (Every 3 Months)', 'AMC Check No.');
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',9.7);
$pdf->setXY(11,142);
$pdf->SetMargins(23, 44, 11.7);
$pdf->Cell(95,5,'Date - Periodic Check (Every 3 Months)',1,0,'C');
$pdf->Cell(95,5,'AMC Check No.',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"3 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"6 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"9 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,7,adddate($invoiceDate,"12 month"),1,0,'C');
$pdf->Cell(95,7,'',1,1,'C');

$pdf->SetFont('Arial','B',11);
$pdf->Text(11,173,'TERMS AND CONDITIONS ARE AS FOLLOWS:');
$pdf->SetFont('Arial','',9);
$pdf->Text(11,180,'1. AMC charges shall Rupees................ be for a period of 12 months from the date of signing of the Contract.');
$pdf->Text(11,184,'2. One time free service for will be provide within the AMC period.');
$pdf->Text(11,188,'3. As per the guidelines every vehicle fitted with speed governor shall visit service point every 3 months of calibration and accuracy of the');
$pdf->Text(11,192,'speed governors.');
$pdf->Text(11,196,'4. Three months warranty on spare parts will be given from the date of fitment.');
$pdf->Text(11,200,'5. A sticker mentioning the validity of the AMC shall be provided and pasted on the left corner of the front wind shield.Any attempt to');
$pdf->Text(11,204,'tamper with the sticker shall invalidate the AMC.');
$pdf->Text(11,208,'6. The vehicle owner/employer shall bring the Vehicle to Contractor service point for availing the AMC');
$pdf->Text(11,212,'7. The Contractor shall ensure deployment of trained technical technician and staff for providing ser ices to the employer/Vehicle own of');
$pdf->Text(11,216,'speed governor.');
$pdf->Text(11,220,'8. No spare parts shall be covered under this A.MC. Any non-functional parts like Sensor, Solenoid, PCB, sealing kit and harnesses shall');
$pdf->Text(11,224,'be charged extra');
$pdf->setXY(11,225);
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(32, 8, 88);
$pdf->Cell(190,6,$OrganizationName,0,1,'C');
$pdf->Image('images/noImageAvailable.png',11,232,40,40);
$pdf->Image('images/noImageAvailable.png',61,232,40,40);
$pdf->Image('images/noImageAvailable.png',111,232,40,40);
$pdf->Image('images/noImageAvailable.png',161,232,40,40);

$pdf->SetFont('seoge-UI-Bold','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Text(10,291,'Customer Signature');
$pdf->Text(160,291,'Authorized Signatory');

$pdf->SetFont('Arial','I',8);
$pdf->Text(95, 295, "Page " . $pdf->PageNo() . "/4");
/*******************************************Fourth Page********************************************* */
$pdf->AddPage();
//page border
$pdf->Rect(5, 5, 200, 287, 'S');
//Cell(width , height , text , border , end line , [align] )

$pdf->Image($LogoPath,13.5,6,25.8,17.2);
$pdf->SetFont('Arial','B',14,1);
$pdf->SetTextColor(26, 34, 117);
$pdf->setXY(10,10);
$pdf->Cell(190,5,$OrganizationName,0,0,"C");
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('arial','',9);
// $pdf->Cell(-5,5,'(Customer Copy)',1,1,"R");
$pdf->Text(170,13,"(Department Copy)");
$pdf->SetFont('Arial','B',8);
$pdf->Text(79.2,17.5,'AN ISO Certified Company 9001 : 2015');
$pdf->Text(53,21.5,$OrganizationAddress);
$pdf->Text(76,25.5,'Email: '.$OrganizationEmail);
//Image(url, )
$pdf->Image($qr,162,14,42,42,'png');
$pdf->SetFont('Arial','B',10);
$pdf->Text(158,59,'Date of AMC: '.$invoiceDate,);

$pdf->SetFont('Arial','',10);
$pdf->Text(11,46,'A.M.C. NO.: '.$certificateNo);
$pdf->SetFont('Arial','B',13);
$pdf->SetTextColor(228, 25, 25);
$pdf->setXY(104.5,40.5);
$pdf->Cell(1,1,'Mfg. of SPEED LIMITER DEVICE',0,0,"C");

$pdf->SetFont('Arial','BU',10);
$pdf->SetTextColor(0,0,0);
$pdf->setXY(95,44);
$pdf->Cell(20,10,'Agreement of Service Contract',0,1,"C");

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,58.2,'Other Part');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,64,'Whereas, AS THE EMPLOYER Shri/M/s '.$dealerName.' its address');
$pdf->Text(11,68,$dealerAddress);
$pdf->Text(11,72,'is serious of hiring the service of the contractor for repair and maintenance of 1 (one) unit of speed governor');
$pdf->Text(11,76,''.$dealerName.' make, installed in Vehicle No. '.$vehicalNo.'.');
$pdf->Text(11,80,' The contract is for a limited period of 12 months starting from ('.$invoiceDate.' to '.$invoiceDateAft1Yrs.')');

$pdf->SetFont('Arial','BU',12);
$pdf->Text(11,88.2,'WHEREAS');

$pdf->SetFont('Arial','',10);
$pdf->Text(11,94,'In pursuant of circular issued by Transport department government of NCT Delhi, where in guidelines have been given to');
$pdf->Text(11,98,'provide AMC for speed governors along with the vehicle, the contractor has agreed to undertake the said repair and');
$pdf->Text(11,102.3,'maintenance and provide AMC on the conditions mentioned below:');

$pdf->Rect(11, 105, 190, 35, 'S');
$heiCusDetTab = 3;
$heiCusDetTab2 = 5;
$pdf->SetFont('Arial','B',10);
$pdf->Text(16,110,'A detail of Vehicle and customer is as follow:');
//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','',9);
$pdf->setXY(15,112.5);
$pdf->Cell(80,$heiCusDetTab,"Customer Name : ".$cusName,0,0);
$pdf->Cell(45,$heiCusDetTab,"Contact No : ".$cusContact,0,0);
$pdf->Cell(60,$heiCusDetTab,"Invoice No. & Date : ".$invoiceno_date,0,1);
$pdf->setXY(15,116.5);
$pdf->Cell(185,$heiCusDetTab2,"Customer Address : ".$cusAddress,0,1);
$pdf->setXY(15,121.5);
$pdf->Cell(70,$heiCusDetTab2,"Make/Model : ".$makeModel,0,0);
$pdf->Cell(55,$heiCusDetTab2,"Vehicle Manufacturing Year : ".$vehicalmanufactureyear,0,0);
$pdf->Cell(65,$heiCusDetTab2,"Serial No : ".$engineno,0,1);
$pdf->setXY(15,126.5);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Engine No.: ".$serialno,0,0);
$pdf->Cell(70,$heiCusDetTab2,"Vehicle Chasis No.: ".$chasisno,0,0);
$pdf->Cell(45,$heiCusDetTab2,"Test Report No.: CT0VN ".$approvalno,0,1);
$pdf->setXY(15,131.5);
$pdf->Cell(40,$heiCusDetTab2,"COP No. : CC0BM5369",0,0);
$pdf->Cell(40,$heiCusDetTab2,"TAC No. : CH5027",0,0);
$pdf->Cell(25,$heiCusDetTab2,"Speed : ".$speed,0,0);
$pdf->Cell(34,$heiCusDetTab2,"Roto Seal No.: ".$rotorsealno,0,0);
$pdf->Cell(46,$heiCusDetTab2,"RTO/State : ".$rto,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(117, 113, 113);
$pdf->Text(16,140,'This is to Certify the Vehicle is resealed in my presence and Electronic Speed Governor is working at set speed of '.$speed.'(+2%) KMPH');

// $data = array('17/02/025','');

// $header = array('Date - Periodic Check (Every 3 Months)', 'AMC Check No.');
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',9.7);
$pdf->setXY(11,142);
$pdf->SetMargins(23, 44, 11.7);
$pdf->Cell(95,5,'Date - Periodic Check (Every 3 Months)',1,0,'C');
$pdf->Cell(95,5,'AMC Check No.',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"3 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"6 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,5,adddate($invoiceDate,"9 month"),1,0,'C');
$pdf->Cell(95,5,'',1,1,'C');
$pdf->setX(11);
$pdf->Cell(95,7,adddate($invoiceDate,"12 month"),1,0,'C');
$pdf->Cell(95,7,'',1,1,'C');

$pdf->SetFont('Arial','B',11);
$pdf->Text(11,173,'TERMS AND CONDITIONS ARE AS FOLLOWS:');
$pdf->SetFont('Arial','',9);
$pdf->Text(11,180,'1. AMC charges shall Rupees................ be for a period of 12 months from the date of signing of the Contract.');
$pdf->Text(11,184,'2. One time free service for will be provide within the AMC period.');
$pdf->Text(11,188,'3. As per the guidelines every vehicle fitted with speed governor shall visit service point every 3 months of calibration and accuracy of the');
$pdf->Text(11,192,'speed governors.');
$pdf->Text(11,196,'4. Three months warranty on spare parts will be given from the date of fitment.');
$pdf->Text(11,200,'5. A sticker mentioning the validity of the AMC shall be provided and pasted on the left corner of the front wind shield.Any attempt to');
$pdf->Text(11,204,'tamper with the sticker shall invalidate the AMC.');
$pdf->Text(11,208,'6. The vehicle owner/employer shall bring the Vehicle to Contractor service point for availing the AMC');
$pdf->Text(11,212,'7. The Contractor shall ensure deployment of trained technical technician and staff for providing ser ices to the employer/Vehicle own of');
$pdf->Text(11,216,'speed governor.');
$pdf->Text(11,220,'8. No spare parts shall be covered under this A.MC. Any non-functional parts like Sensor, Solenoid, PCB, sealing kit and harnesses shall');
$pdf->Text(11,224,'be charged extra');
$pdf->setXY(11,225);
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(32, 8, 88);
$pdf->Cell(190,6,$OrganizationName,0,1,'C');
$pdf->Image('images/noImageAvailable.png',11,232,40,40);
$pdf->Image('images/noImageAvailable.png',61,232,40,40);
$pdf->Image('images/noImageAvailable.png',111,232,40,40);
$pdf->Image('images/noImageAvailable.png',161,232,40,40);

$pdf->SetFont('seoge-UI-Bold','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Text(10,291,'Customer Signature');
$pdf->Text(160,291,'Authorized Signatory');

$pdf->SetFont('Arial','I',8);
$pdf->Text(95, 295, "Page " . $pdf->PageNo() . "/4");

}else{
}
}else{
    header("Location: /");
}
// $pdf->Output($certificateNo.'.pdf','D');
$pdf->Output();
?>
