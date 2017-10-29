<?php
$control=new control();

$show_Problem = $control->DeleteBusiness($_GET['id']);

 echo "<meta http-equiv='refresh' content='0;url=?e=pabx&p=all_list&f=all&l=business_card_requisition_list'>"; 
?>

