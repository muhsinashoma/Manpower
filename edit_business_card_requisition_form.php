
<?php
$control = new control();
$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);

$_SESSION['eID'];
$empid = $_SESSION['eID'];
echo  "<span style='color:#F00'>ID : $empid</span> ";

$head_of_function = $control->HeadOfFunction();
$Value = $control->FetchBusinessCard($_GET['id']);   //echo $Value[2];

$hohr_email = $control->HOHREmailSending();   //echo 'HOHR ID :'.$hohr_email[0]; echo 'HOHR Email :'.$hohr_email[1];
$hohr_email[0];

$val = $control->LM_HOF_HOD($Value[2]);    //  print_r($val); 
$hof_id = $val[0];
$hod_id = $val[1];  
$md_id  = $val[2]; 

$EmailAddress = $control->EmailAddress($hof_id); 

$save = $Value[53]; 
$submit= $Value[54]; 

$reference_no=$Value[30];

$other_info = $control->OtherInfo($_SESSION['eID']);
$job_location = $control->JobLocation();
$RO_CO_Address = $control->office_name();
$ro_co_off_add=$control->All_Office_Address();
$requi_count=$control->RequisitionCount($_SESSION['eID']);  //echo $requi_count[0];




/*---------------------Start Save Funtion ------------------*/

if(isset($_POST['save'])) 
{                                  //Starting Curli Bracket


if($_POST['office_name']=='Head Office')
{
  $_POST['office_address']='House# 7/B, Road#13, Gulshan-1, Dhaka, Bangladesh.';  
}

if($_POST['office_name']=='NMC Office')
{
  $_POST['nmc_address']='House# 8/B, Road#1, Gulshan-1, Dhaka, Bangladesh.';  
}

if($_POST['office_name']=='Regional Office Address')
{
 
  $_POST['exe_id']; 
}



$All_Data = array($_POST['extension_number'],$_POST['office_name'], mysql_real_escape_string($_POST['office_address']),$_POST['reason'],$image_path,$_POST['mobile_number'], mysql_real_escape_string($_POST['exe_id']),mysql_real_escape_string($_POST['nmc_address']),$_POST['alter_number'], mysql_real_escape_string($_POST['card_justify']),$_POST['card_value'],$_POST['required_from'],$_POST['office'],$_POST['ro_co_address'],$_POST['alter_email'], $Value[0]);

$info = $control->Update_Business_Card_Requisition_Form($All_Data);

  if ($info) 
   {

     echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=edit_business_card_requisition_form&id=$Value[0]'>";
     echo "<h2 style='color:#CC0000'>Information has been saved successfully </h2>";
   }




}  //Ending Curli Bracket


/*---------------------End Save Funtion ------------------*/





/*------------- Submit Function -------------------------*/

if(isset($_POST['submit'])) 
{    //Starting Curli Bracket

                        
if($_POST['office_name']=='Head Office')
{
  $_POST['office_address']='House# 7/B, Road#13, Gulshan-1, Dhaka, Bangladesh.';  
}

if($_POST['office_name']=='NMC Office')
{
  $_POST['nmc_address']='House# 8/B, Road#1, Gulshan-1, Dhaka, Bangladesh.';  
}

if($_POST['office_name']=='Regional Office Address')
{
 
  $_POST['exe_id']; 
}



$All_Data = array($_POST['extension_number'],$_POST['office_name'], mysql_real_escape_string($_POST['office_address']),$_POST['reason'],$image_path,$_POST['mobile_number'], mysql_real_escape_string($_POST['exe_id']),mysql_real_escape_string($_POST['nmc_address']),$_POST['alter_number'], mysql_real_escape_string($_POST['card_justify']),$_POST['card_value'],$_POST['required_from'],$_POST['office'],$_POST['ro_co_address'],$_POST['alter_email'], $Value[0]);

$info = $control->Update_Business_Card_Requisition_Form($All_Data);

  if ($info) 
	 {
    echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=all_list&f=all&l=business_card_requisition_list'>";

    if($_SESSION['eID']==$hof_id or $_SESSION['eID']==$hod_id or $_SESSION['eID']==$hohr_email[0] or $_SESSION['eID']=='02-0472' or $_SESSION['eID']=='02-0917')
      {
        echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=all_list&f=all&l=approve_business_card_requisition_list'>";
      }
  
  
     echo "<h2 style='color:#CC0000'>Information has been Edited Successfully </h2>";
   }




 $data=array($Value[0],$_POST['submit']);
 {
  $saveinfo = $control->Submit_Business_Card_Requisition_Form($data);
 }



/*----------------------Start Mail Funtion ---------------------*/

//HOF Mail Sending Function 

$line_manager = $control->return_tier($_SESSION['eID']);  //echo $line_manager;

if($line_manager=='0' || $line_manager=='1' || $line_manager=='2' || $line_manager=='3')
{


$to=$EmailAddress[18].'; muhsina.akter@fiberathome.net'."\n";      // echo $to; 

$subject = "Business Card Requisition";                             //echo $subject;

$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no :  $reference_no and user id # $Value[2] </b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                                  // echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) {
            //echo "Message sent successfully.....";
            }

         else {
               //echo "Message could not be sent......";
             }



}




//----------------To HR Personnel Mail Function ------------

$line_manager=$control->return_tier($_SESSION['eID']);           //echo $line_manager;

if ($line_manager=='4') {
 
$to='hr@fiberathome.net; muhsina.akter@fiberathome.net'."\n";     //echo $to;   
$subject = "Business Card Requisition";                           //echo $subject;
                                                            
$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no :  $reference_no user id and # $Value[2]</b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                                // echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                          // echo $headers;


$retrival = mail($to,$subject,$message,$headers); 

if($retrival) {
                // echo "Message sent successfully.....";
              }
         
          else 
               {
                 // echo "Message could not be sent......";
               }
}  






}  //Ending Curli Bracket



/*----------End Submit Function ------------------------*/
?>




<table class="model-1" width="100%" height="20%" border="0" >   
    <tr>       
      <td>    <?php include("top_menu.php"); ?> </td>  
	</tr>		
</table>  


<html><head> 
<title>Date Picker on click of Calendar Icon</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   
<link href="css/it.css" type="text/css" rel="stylesheet">
<script src="js/edit_business.js"> </script>
</head>
 
<body>
    
        <div class="model-1">
            <div class="content-wrapper">
                <div id="header">
         <!---   <p style="margin-left: 30%;"><b> </b></p>---->
                     </div>
    
         <!----------Content Start---------------------------->
      <div id="content">
    
      <div> <h2 class="business-title">  Business Card Requisition Form </h2> </div>
         
<form action="" name="pic" method="post"  enctype="multipart/form-data" onSubmit="return CheckBoxMessage(this);" charset="utf-8" id="form-certificate">


 <div> <h3 id="fiber_title">Fiber @ Home</h3>
   <div id="human">
      <h3 id="buss_human">Human Resources Department</h3>
      <h3 id="buss_mandatory"> All asterisk(<font size="+1.5" style="color:#F00" >*</font>)  fields are mandatory</h3>   
    </div>       
 </div> 


<div> <b><font size="-1" style="color:#03F"> Business Card Ref No. : &nbsp; <?php echo $Value[30]; ?> </font></b></div>

   <div id="sub_date">
	 Submission Date :
	 <input type="text" name="submission_date" class="alt_date" readonly value="<?php  echo $Value[29];?>" /><br><font id="date_styl">(y-m-d)</font>
	</div>
    
<fieldset >   
<legend> <h3>&nbsp;PLEASE FILL IT IN CAPITAL LETTER : &nbsp;</h3> </legend>
<div class="model-2">	  
       <table class="test-1" width="100%" border="0"  >   

           <tr>
             <td>&nbsp; </td>
           </tr>

            <tr>
            <td width="18%">Employee Name : </td>
            <td><input type="text" name="emp_name" class="business-border" readonly value="<?php echo $Value[1]; ?>"  id="up" />  &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td>
            </tr>
 
           <tr>
            <td>Employee ID :</td> 
			      <td> <input type="text" name="emp_id" class="business-border" readonly value=" <?php echo $Value[2];  ?>" /> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr>  
            
		       <tr>
            <td>Designation : </td> 
			     <td> <input type="text" name="designation" class="business-border" readonly value="<?php echo $Value[3]; ?>"  id="up"/> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr>  
            
			
		      <tr>
            <td>Function :</td> 
			      <td> <input type="text" name="function" class="business-border" readonly value=" <?php echo $Value[4]; ?>" id="up"/> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr> 
		   
		      <tr>
            <td>Department :</td> 
			     <td> <input type="text" name="department" class="business-border" readonly value=" <?php echo $Value[5]; ?>" id="up"/>&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
           </tr>  
		   
		      <tr>
            <td>Mobile Number :</td> 
			     <td> <input type="text" name="mobile_number" class="business-border" readonly   value="<?php echo $Value[6]; ?>"/> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr>  
           
           
           <tr>
            <td>Alternative Mobile No. :</td> 
			     <td> <input type="text" name="alter_number" class="business-border" value="<?php echo $Value[41];  ?>" /></td>
           </tr>
		   
		      <tr>
            <td>Extension No. :</td> 
			      <td> <input type="text" name="extension_number" class="business-border" value="<?php echo  $Value[7];   ?>" /> </td> 
           </tr>   
		   
		       <tr>
            <td>Email :</td> 
			      <td> <input type="email" name="email" class="business-border" readonly value="<?php echo $Value[8]; ?>"/>&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
           </tr>  
           
            <tr>
            <td>Alternative Email :</td> 
			     <td> <input type="email" name="alter_email" class="business-border" value="<?php echo $Value[47]; ?>" id="fremail" /></td> 
           </tr>  
           
           <tr>
           <td>&nbsp; </td>
           </tr>
    </table>  
</div>
</fieldset> 

<br>


<fieldset>   
<legend> <h3> &nbsp;Preferred Office Address : &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></h3> </legend>
<div class="model-3">

<div><b> [ Please tick the Head Office / NMC Address or Fill in the Blank Box ]   </b>  </div><br>

<table class="certificate-table1" id="card">
    <tr>
      <td>
        <input type="radio" name="office_name" onClick="HeadOffice(this.value)" value="Head Office" id="head" <?php if($Value[9]=="Head Office") {echo "checked";} ?> >Head Office
       
        <input type="radio" name="office_name" onClick="NMCOffice(this.value)" value="NMC Office"  id="nmc"  <?php if($Value[9]=="NMC Office") {echo "checked";} ?> >NMC Office
            
      <input type="radio" name="office_name" onClick="RegionalOffice(this.value)" value="Regional Office Address" id="regional" <?php if($Value[9]=="Regional Office Address") {echo "checked";  }    ?>   >Regional Office Address 
       
       <div id="message"></div>
      </td>
      
       
    </tr>
  </table>
  
  
   
 <!---<td>
    <?php if($Value[11]=="New Joining"){?>
      <h6 style="display:block" id="date_blc">(y-m-d)</h6>
    <?php } else ?>
 
   <?php
   {
  if($Value[11]!="New Joining"){?>
  <h6 style="display:none" id="date_blc">(y-m-d)</h6>
  <?php } ?>
 
  <?php } ?>
</td> ------>
  
  
<table id="tblC" >
    <tr>

    <td><?php if($Value[9]=="Regional Office Address") { ?> 
	<h3 style="display:block" id="job_locate">  Job Location : <font size="+1.5" style="color:#F00" >*</font> </h3>   
	<?php } else ?>
	
	<?php
	{
    if($Value[9]!="Regional Office Address"){?>
	
	<h3 style="display:none" id="job_locate"> Job Location : <font size="+1.5" style="color:#F00" >*</font> </h3>   
	<?php } ?>
	<?php } ?>
		

<select  name="exe_id" class="opt_val" id="location"  onChange="showAddress(this.value)"  <?php if($Value[9]=="Regional Office Address"){?>style="display:block;"<?php } ?> 

else {
<?php if($Value[9]!="Regional Office Address"){?>style="display:none" <?php }?> />

             <option value="<?php echo $Value[32]; ?>" ><?php echo $Value[32]; ?> </option>
            <!-- <option disable="" >Select Job Location </option> --->
              
             <?php
			 while($row=mysql_fetch_array($job_location))
			 {
			 echo "<option>";
			 echo  $row['posting_district'];
			 echo "</option>";
			 }
			 ?>
             </select> 
    </td> 
</tr>



    <tr id="suggestions7" style="display: none;">
                       <!-- <td width="18" align="right">&nbsp;</td> --->
                       <!-- <td class="suggestionsBox6"> -->
                 <div class="suggestionList7" id="autoSuggestionsList7">&nbsp;</div>  
       </td>
    </tr> 



  <tr>  
     <td> 
	 <?php if($Value[9]=="Regional Office Address") { ?> 
	<h3 style="display:block" id="co_ro_locate">   CO/RO Location : <font size="+1.5" style="color:#F00" >*</font> </h3>   
	<?php } else ?>
	
	<?php
	{
    if($Value[9]!="Regional Office Address"){?>
	
	<h3 style="display:none" id="co_ro_locate">  CO/RO Location : <font size="+1.5" style="color:#F00" >*</font> </h3>   
	<?php } ?>
	<?php } ?>
	 
	 
  <select  name="office" class="opt_val" id="offceaddress"  onChange="Show_CORO_Address(this.value)"  <?php if($Value[9]=="Regional Office Address"){?>style="display:block;"<?php } ?> 

else {
<?php if($Value[9]!="Regional Office Address"){?>style="display:none" <?php }?> />
      <option value="<?php echo $Value[45]; ?>" ><?php echo $Value[45]; ?></option>
      <!--<option disable="" >Select CO/RO Address </option>  --->
       <?php
	  foreach($RO_CO_Address as $postarea)
	  {
		  echo "<option>";
		  echo $postarea['area_of_posting'];
		  echo "</option>";
	  }
	  ?> 
   </select> 
    </td>  	
 </tr>  


    <tr id="suggestions8" style="display: none;">
                       <!-- <td width="18" align="right">&nbsp;</td> --->
                       <!-- <td class="suggestionsBox6"> -->
                 <div class="suggestionList8" id="autoSuggestionsList8">&nbsp;</div>  
        </td>
    </tr> 



 <tr>  
    <td> 
	 <?php if($Value[9]=="Regional Office Address") { ?> 
	<h3 style="display:block" id="co_ro_office_add">   Office Address : </h3>   
	<?php } else ?>
	
	<?php
	{
    if($Value[9]!="Regional Office Address"){?>
	
	<h3 style="display:none" id="co_ro_office_add">  Office Address :  </h3>   
	<?php } ?>
	<?php } ?>
     
      <select  name="ro_co_address" class="opt_val" id="ro_co_address"  <?php if($Value[9]=="Regional Office Address"){?>style="display:block;"<?php } ?> 

else {
<?php if($Value[9]!="Regional Office Address"){?>style="display:none" <?php }?> />

      <option value="<?php echo $Value[46]; ?>" ><?php echo $Value[46]; ?></option>
    <!--  <option disable="">Select Office Address </option>  --->
      
          <?php
		   while($row=mysql_fetch_array($ro_co_off_add))
		   {
			echo "<option>"; 
			echo 'H#'. $row['house']. ', '.'Flr#'.$row['floor'].', ' . 'Flat#'.$row['flat']. ', ' .'R#'.$row['road']. ', ' .'Plot#'.$row['plot'].', '.'Sec#'.$row['sector']. ', '. 'Ward#'.$row['ward'].', '.'Vill: '.$row['village'].', '. 'PO : '.$row['post_office'].', '.'PS : '.$row['police_station'].', '.'District : '.$row['district']. ', '.'Area code #'.$row['area_code'].', '. 'Country : '.$row['country'];
			echo "</option>";
		   }
		   ?> 
   </select> 
    </td>  	
 </tr>   


</table>


 <table id="tbl-A"  cols="1" cellpadding="2" >
    <tbody>
    <tr valign="top" align="left">
    <td><input type="text" name="office_address" class="border" id="head_office" readonly value="<?php  echo $Value[10]; ?> "  <?php if($Value[9]=="Head Office"){?>style="display:block;"<?php } ?> 

else {
<?php if($Value[9]!="Head Office"){?>style="display:none" <?php }?> 
 />
      </td> 
      
    </tr>
    </tbody>
  </table>
  
  
  
  <table id="tbl-B"  cols="1" cellpadding="2">
    <tbody>
    <tr valign="top" align="left">
    <td> 
   <input type="text" name="nmc_address" class="border" id="nmc_office" readonly  value="<?php  echo $Value[40]; ?> "  <?php if($Value[9]=="NMC Office"){?>style="display:block;"<?php } ?> 

else {
<?php if($Value[9]!="NMC Office"){?>style="display:none" <?php }?> 

 /> 
     </td>   
      
    </tr>
    </tbody>
  </table>

 
 <br>
 
 <table>
     <tr>
       <td> Tel : (8802) 8812507, 8814873, 8812501, 9897921<br>

		   Fax: (8802) 8815010<br>
           www.fiberathome.net </td>

		</tr>
			   
	</table>   
</div>
</fieldset> 

 <br>
<fieldset>   
<legend> <h3>&nbsp;Reason(Please Select) :&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </h3> </legend> 
<div class="model-4"> 
<table class="certificate-table1">                       


<tr align="center">
   <td> 
      <input type="radio" name="reason"  value="New Joining"  id="new_join" onClick="NewJoining(this.value)"  <?php if($Value[11]=="New Joining") {echo "checked";} ?> >New Joining
           		
   <input type="radio" name="reason" value="Card is Exhausted" id="card_exhaust" onClick="CardExhaust(this.value)"  <?php if($Value[11]=="Card is Exhausted") {echo "checked";}  ?> >Card is Exhausted  
   
   <input type="radio" name="reason"  value="Change of Employment Status" id="change_emp"  onClick="ChangeEmployment(this.value)" <?php if($Value[11]=="Change of Employment Status") {echo "checked";} ?> >Change of Employment Status
   </td>     			 
</tr>
</table>  


<table id="tbl_V"  cols="1" cellpadding="2">
    <tr> 
      <td>  <input type="text" name="joining_date"  id="tbl_T" readonly  value="<?php echo $Value[28];  ?> "  
	  
<?php if($Value[11]=="New Joining"){?>style="display:block;"  <?php } ?> 

else {
<?php if($Value[11]!="New Joining"){?>style="display:none" <?php }?> /> 

 <!--<font size="-1" style="color:#03F; margin-left:56%; display:none" id="date_blc"> date(y-m-d)</font>   ---->
</td>
 
 
 
 <td>
    <?php if($Value[11]=="New Joining"){?>
      <h6 style="display:block" id="date_blc">(y-m-d)</h6>
    <?php } else ?>
 
   <?php
   {
  if($Value[11]!="New Joining"){?>
  <h6 style="display:none" id="date_blc">(y-m-d)</h6>
  <?php } ?>
 
  <?php } ?>
</td>
  
</tr>
</table>
  
   <table id="tbl_P"  cols="1" cellpadding="2">
    <tr>
       <td>  </td>
    </tr>
  </table>
 
  <table id="tbl_Q"   cols="1" cellpadding="2">
    <tr>
      <td> </td>
    </tr>
  </table>
</div>
</fieldset> 

<br>


<fieldset>  
<legend> <h3>&nbsp; Requirement &nbsp; <font size="+1.5" style="color:#F00" >*</font></h3> </legend>

<div id="earl_requis" 

<div style="margin-left: 21%">
    <h3 id="requi_earlier" > Earlier Requisition &nbsp;&nbsp; : &nbsp;&nbsp;
<?php echo $requi_count[0];  ?>
  </h3> 
</div>

<br>

<div class="certificate" style="margin-left:20%"> 
    <input type="radio" name="card_value" value="Regular"  onClick='RegularRequirement(this.value)' id="pr_1" <?php if($Value[43]=="Regular") {echo "checked";}  ?> />Regular

   <input type="radio" name="card_value"  value="Urgent" id="pr"  <?php if($Value[43]=="Urgent") {echo "checked";}  ?> onClick='UrgentRequirement(this.value);'/>Urgent (<font style="color:#F00" >incur 4 times extra cost to the company</font>)

  </div>



<div style="margin-left:30%">
 
  <div>
    <label id="pqr"> <?php if($Value[43]=="Urgent"){ ?><b>Justification : </b> <font size="+1.5" style="color:#F00" >*</font></label>
 
    <?php
    }
   ?>
   <input type="text" name="card_justify" id="card_justi" placeholder="Justification" value="<?php if($Value[43]=="Urgent") { echo $Value[42]; }?>" class="alt1_certificate" <?php if($Value[43]=="Urgent"){?> style="display:block"<?php 
    } 
   ?>  

  else {
   <?php if ($Value[43]!="Urgent"){?>style="display:none" <?php }?>  
   } 
  >  
  </div>



 <div style="margin-bottom: 10px;"><label id="utp" ><?php if($Value[43]=="Urgent") { ?> <b> Required From : </b> <font size="+1.5" style="color:#F00" >*</font></label>
     <?php
     }
     ?>
    <input type="text" name="required_from" placeholder="Date" value="<?php if($Value[43]=="Urgent") { echo $Value[44]; }?>" class="alt1_certificate" id="issueDate"  <?php if($Value[43]=="Urgent"){?> style="display:block" <?php } ?>  

    else {
    <?php if ($Value[43]!="Urgent"){?>style="display:none" <?php }?>  
    }
    >
    <div id="date_color"><?php if($Value[43]=="Urgent") { ?> date(y-m-d)<?php } ?></div>
  </div>

</div>
     
</div>
    
</fieldset>
    

<table id="approve-part" border="0"  style="display:none"> 
<div id="recommend" style="display:none;"> 
 <h3>&nbsp;&nbsp; Head of Function </h3> <h3 style="margin-top:-30px; margin-left:300px; ">Head of Dept.</h3> <h3 style="margin-top:-30px; margin-left:610px; ">Verified by HR</h3>
</div>

<tr>
     <td>ID:</td> 
     <td> <input type="text" name="request_employee_id" class="certificate-border" value="<?php echo $Value[33] ?>" />
     </td>
   
    <td> ID :</td> 
    <td> <input type="text" name="head_id" class="certificate-border" value="<?php echo $Value[14]; ?> " />
    </td> 
    
     <td> ID:</td> 
      <td><input type="text" name="executive_id" class="certificate-border" value="<?php echo $Value[27]; ?>" />
      </td>
  
 </tr>
 
 

<tr>
     <td>Name:</td> 
     <td> <input type="text" name="request_emp_name" class="certificate-border" value="<?php echo $Value[16]; ?>" />
     </td>
   
    <td> Name:</td> 
    <td> <input type="text" name="head_name" class="certificate-border" value="<?php echo 
$Value[17]; ?> " />
    </td>
    
   <td> Name:</td> 
      <td><input type="text" name="executive_name" class="certificate-border" value="<?php echo $Value[35]; ?>" />
      </td>
 </tr>   
 
 

   <tr>
       <td>Designation:</td> 
      <td><input type="text" name="request_emp_designation" class="certificate-border" value="<?php  echo $Value[19]; ?>" /> </td>
     
   <td>Designation:</td> 
        <td><input type="text" name="head_designation" class="certificate-border" value="<?php echo $Value[20]; ?>"  />
        </td> 
        
       <td>Designation:</td> 
       <td><input type="text"  name="executive_designation" class="certificate-border" value="<?php echo $Value[36]; ?>"/> </td>
  </tr>  
     
    
     <!---------------- HOHR  ID Name and DesigantionInformation -------------------->

<tr>
     <td>ID:</td> 
     <td> <input type="text" name="hr_id" class="certificate-border" value="<?php  echo $Value[15]; ?>" />
     </td>
   
    <td> Name:</td> 
    <td> <input type="text" name="hr_name" class="certificate-border" value="<?php echo $Value[18]; ?>" />
    </td>
    
      <td> Designation:</td> 
      <td><input type="text" name="hr_designation" class="certificate-border" value="<?php echo $Value[21]; ?>" />
      </td>
 </tr>   
   
</table> 

</fieldset>

<br>
<br>


<div id="manpower_version"> Version:2.2 Effective Date : June 30, 2015 </div>

<div style="margin-left:380px" id="submit_manpower"> 

<?php
if($Value[54]=='1')
{
?>
<input type="button" value="BACK" onClick="history.go(-1); return true;" id="fnt">

<?php
}

elseif($Value[53]=='0')
{
?>
  <input type="submit" name="save" value="SAVE" id="fnt" >

<?php
}
?>

&nbsp;&nbsp;&nbsp; <input type="submit" name="submit"  value="SUBMIT" onClick="return send();" id="fnt" >
</div>  


	<br>
    
      </form>

       </div>
                <!----------Content End---------------------------->
            </div>

        </div>
        
       
    </body>
</html>