<?php
session_start();
print_r( $_POST );

echo isset($_SESSION['National_id']) ? "รหัสประจำตัวประชาชน หรือ Passport : ".$_SESSION['National_id'] : "ผู้สมัครใหม่";


require('../fpdf185/fpdf.php');
require('../config.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('sarabun','','THSarabun.php');
$pdf->AddFont('sarabunB','','THSarabun Bold.php');

//$pdf ->Image('../assets/images/KU_Symbol_Eng.png',92,10,30);

$National_id = $_POST['National_id'];

$pdf->setFont('sarabunB','','18');



//$sql_query = " SELECT * FROM education_student WHERE National_id = '".$_SESSION['National_id']."' ";
//$result = $mysqli->query($sql_query);
//$record_number = mysqli_num_rows( $result );


    $sql = "SELECT * FROM `applications` WHERE`National_id` = National_id;";
    $query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);

$pdf->Cell(0,9,iconv('utf-8','cp874','ใบรับสมัคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','การคัดเลือกเข้าศึกษาต่อในมหาวิทยาลัยเกษตรศาสตร์'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','วิทยาเขตเฉลิมพรเกียรติ จังหวัดสกลนคร'),0,1,'C');
$pdf->Cell(0,9,iconv('utf-8','cp874','ประจำปีการศึกษา 2566 รอบที่ '.$row['Tcas_round']),0,1,'C');
$pdf->Ln();

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','รหัสบัตรประจำตัวประชาชน : '.$row ['National_id'].'                ชื่อ - นามสกุล : '.$row ['Firstname_th'].'  '.$row['Lastname_th']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','วัน เดือน ปีเกิด : '.$row ['Birth_date'].'            สัญชาติ : '.$row ['Ethnicity'].'       เชื้อชาติ : '.$row['Nationality'].'        ศาสนา : '.$row['Religion']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','บ้านเลขที่  : '.$row ['Home_no'].'  หมูjที่ : '.$row ['Village_no'].'  ตำบล : '.$row['Sub_district'].'  อำเภอ : '.$row['District'].'  จังหวัด : '.$row['Province'].' '.$row ['Postal_Code']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874',' โทรศัพท์บ้าน '.$row ['Home_number'].'   โทรศัพท์มือถือ : '.$row ['Telephone_number'].' Email : '.$row['Email']),0,1);

$sql = "SELECT * FROM `education_student` ";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);

$pdf->setFont('sarabunB','','18');
$pdf->Cell(0,10,iconv('utf-8','cp874','ข้อมูลการศึกษา'),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874','ผลการเรียนเฉลี่ยสะสม : '.$row ['edu_qualification'].' ('.$row ['stady_plan'].')  รวมเป็น '.$row ['gpax']),0,1);
$pdf->Cell(0,8,iconv('utf-8','cp874','ชื่อโรงเรียน : '.$row ['School_name']),0,1);


$pdf->setFont('sarabunB','','18');
$pdf->Cell(0,9,iconv('utf-8','cp874','สมัครเข้าศึกษา  : '.$row ['School_name']),0,1);
$pdf->Cell(0,9,iconv('utf-8','cp874','หลักสูตร   : '.$row ['School_name']),0,1);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,7,iconv('utf-8','cp874','             ข้าพเจ้าขอรับรองว่ามีคุณสมบัติครบตามประกาศรับสมัครของมหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตเฉลิมพระเกียรติ  '),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','จังหวัดสกลนคร ทุกประการ หากตรตรวจสอบในภายหลังพบว่าขาดคุณสมบัติ ข้าพเจ้ายินดีให้มหาวิทยาลัยตัดสิทธิ์ในการเข้าศึกษา'),0,1);
$pdf->Cell(0,7,iconv('utf-8','cp874','โดยไม่มีข้ออุทธรณ์ใดๆ ทั้งสิ้น'),0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$sql = "SELECT * FROM `applications`";
$query = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($query);

$pdf->setFont('sarabun','','16');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ลงชื่อ '.$row ['Firstname_th'].'  '.$row['Lastname_th'].' ผู้สมัคร '),0,1,'R');
$pdf->Cell(0,8,iconv('utf-8','cp874',' ( '.$row ['Firstname_th'].'  '.$row['Lastname_th'].' ) '),0,1,'R');

$pdf->Output();


?>