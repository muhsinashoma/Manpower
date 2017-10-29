<?php
//Array ( [0] => F@H [1] => BCR [2] => HR-73 [3] => 2017-January-24 [4] => 74 ) 
//print_r(explode("/", $reference_no)); 
$con = mysqli_connect("localhost","root","","hris123xxxx");
$result = mysqli_query($con, "select * from tbl_business_card_requisition_form");

while ($data = mysqli_fetch_array($result)) {
	$dt[] = $data;
	}

	foreach ($dt as $d) {

		$id = $d[0];

		echo "<br>Prev=";
		$cout = explode("/", $d[30]);
		print_r($cout);
		
		if ($cout[4] == "") $cout[4] =1; else $cout[4] = $cout[4]+ 1;

echo "  ---------------- New=";
/*echo "<br>";
echo $cout[0];
echo "<br>";
echo $cout[1];
echo "<br>";
echo $cout[4]= $cout[4]+1;  //shows serial no.
//$auto_sl = $cout[4]+1; */
$nrn = implode("/", $cout); echo $nrn;
//print_r($cout);
		# code...
//$update = mysqli_query($con, "update  tbl_business_card_requisition_form set ref_no='$nrn' where id = '$id' ");

	}


?> 