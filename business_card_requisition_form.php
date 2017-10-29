
<?php
$control = new control();
$empid = $_SESSION['eID'];
$id=$empid;

echo  "<span style='color:#F00'>ID : $empid</span> "; 

$current_date = date("/Y-D-j");
$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);
$other_info = $control->OtherInfo($_SESSION['eID']);

$_SESSION['eID'];

$head_office_address= "House# 7/B, Road#13, Gulshan-01, Dhaka-1212, Bangladesh.";
$nmc_office_address= "House# 8/B, Road#1, Gulshan-01, Dhaka-1212, Bangladesh." ;

$joining_date = date("Y-m-d", strtotime($office_info[8]));   

$hohr_email = $control->HOHREmailSending();    //echo 'HOHR ID :'.$hohr_email[0]; echo 'HOHR Email :'.$hohr_email[1];
$hohr_email[0];


$job_location = $control->JobLocation();
$requi_count=$control->RequisitionCount($_SESSION['eID']);

$prmvalue= $control->BusinessCardAutoNo($currentyear);  //echo $prmvalue[0];
$prmvalue[0];
if(!isset($prmvalue) || $prmvalue[0]=="") $id_val =1;
else 
$id_val=$prmvalue[0];

$ref_no = 'F@H/BCR/';
$emp_dept = $office_info[4];
$present_year = date('/Y/');
$present_month = date('M/');


if($_POST['office_name']=='Head Office')
{
  $_POST['office_address']='House# 7/B, Road#13, Gulshan-01, Dhaka-1212, Bangladesh.';  
}
if($_POST['office_name']=='NMC Office')
{
  $_POST['nmc_address']='House# 8/B, Road#01, Gulshan-01, Dhaka-1212, Bangladesh.';  
}

if($_POST['office_name']=='Regional Office Address')
{
  $_POST['exe_id']; 
}


$empid = trim($_POST['emp_id']);
$empname = trim($_POST['emp_name']);
$desig= trim($_POST['designation']);
$dept = trim($office_info[4]);
$currentyear=date("Y");                                 

$ref_no = 'F@H/BCR/';
$dept =$office_info[4];
$current_date = date("/Y-F-j");        /* F - A full textual representation of a month (January through December)  */

//echo 'Department Number will be started from 1 for each year
$sql = "SELECT * FROM tbl_business_card_requisition_form WHERE department='$dept' and submission_date LIKE '$currentyear%'";
$DepartmentMaxID = mysql_query($sql);
$number = mysql_num_rows($DepartmentMaxID);
$DepartmentMaxIDInc=$number+1;


//echo 'Number of Rows will be started from 1 for each year
$test = "SELECT * FROM `tbl_business_card_requisition_form` WHERE submission_date LIKE '$currentyear%' ";
$sl_result = mysql_query($test);
$sl_no = mysql_num_rows($sl_result);  
$reference_no= $ref_no.$dept.'-'.$DepartmentMaxIDInc.$current_date.'/'.($sl_no+1);     //echo $reference_no;


/*--------------------------Start  Save Funtion---------------------------*/

if(isset($_POST['save'])) 
{                                       //Starting Curli Bracket

                            
$All_Data = array($empname,$empid, $desig, $_POST['function'], $dept, $_POST['mobile_number'], $_POST['extension_number'], $_POST['email'], $_POST['office_name'], mysql_real_escape_string($_POST['office_address']), $_POST['reason'], $image_path, $head_fuction_id, $_POST['head_id'],$_POST['hr_id'],$_POST['request_emp_name'], $_POST['head_name'], $_POST['hr_name'], $_POST['request_emp_designation'], $_POST['head_designation'], $_POST['hr_designation'], $_SESSION['employee_user'],date('Y-m-d H:i:s'),$_POST['executive_id'],$joining_date,$_POST['submission_date'],$reference_no,$_POST['reject_reason'],mysql_real_escape_string($_POST['exe_id']),$_POST['request_employee_id'], $_POST['executive_name'],$_POST['executive_designation'],$_POST['nmc_address'],$_POST['alter_number'], mysql_real_escape_string($_POST['card_justify']),$_POST['card_value'],$_POST['required_from'],$_POST['office'],$_POST['ro_co_address'],$_POST['alter_email'],$_POST['approve'], $_POST['approve_hod'],$_POST['approve_date'],$_POST['approve_hod_date'],$_POST['save']);

// executive_name=30
// approve_hod_date=43
$info = $control->Save_Func_Business_Card_Requisition_Form($All_Data);

    if ($info) 
    {
echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=edit_business_card_requisition_form&id=$id_val'>"; 

echo "<h2 style='color:red'>Information has been saved successfully </h2>";
    }


}


//--------------End Save Funtion------------------------



//--------------Start Submit Funtion----------------------

if(isset($_POST['submit'])) 
{                                       //Starting Curli Bracket

$All_Data = array($empname,$empid, $desig, $_POST['function'], $dept, $_POST['mobile_number'], $_POST['extension_number'], $_POST['email'], $_POST['office_name'], mysql_real_escape_string($_POST['office_address']), $_POST['reason'], $image_path, $head_fuction_id, $_POST['head_id'],$_POST['hr_id'],$_POST['request_emp_name'], $_POST['head_name'], $_POST['hr_name'], $_POST['request_emp_designation'], $_POST['head_designation'], $_POST['hr_designation'], $_SESSION['employee_user'],date('Y-m-d H:i:s'),$_POST['executive_id'],$joining_date,$_POST['submission_date'],$reference_no,$_POST['reject_reason'],mysql_real_escape_string($_POST['exe_id']),$_POST['request_employee_id'], $_POST['executive_name'],$_POST['executive_designation'],$_POST['nmc_address'],$_POST['alter_number'], mysql_real_escape_string($_POST['card_justify']),$_POST['card_value'],$_POST['required_from'],$_POST['office'],$_POST['ro_co_address'],$_POST['alter_email'],$_POST['approve'], $_POST['approve_hod'],$_POST['approve_date'],$_POST['approve_hod_date'],$_POST['submit']);

// executive_name=30
// approve_hod_date=43
$info = $control->Business_Card_Requisition_Form($All_Data);

    if ($info) 
    {
echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=all_list&f=all&l=business_card_requisition_list'>"; //block this to show mail funtion
echo "<h2 style='color:red'>Information has been inserted successfully </h2>";
    }
    


/*----------------------Start Mail Funtion ---------------------*/

//HOF Mail Sending Function 

$request_empid = trim($_POST['emp_id']);
$val    = $control->LM_HOF_HOD($request_empid);  
$lm_id  = $val[0];  //print_r($val);
$hof_id = $val[1];
$hod_id = $val[2];  
$md_id  = $val[3]; 

$EmailAddress = $control->EmailAddress($hof_id); 

$line_manager = $control->return_tier($_SESSION['eID']);  //echo $line_manager;


//----------------To HOF Mail Function ----------------

if($line_manager=='0' || $line_manager=='1' || $line_manager=='2' || $line_manager=='3')
{
include_once 'view/business_mail.php';
}


//----------------To HR Personnel Mail Function ------------

//$line_manager=$control->return_tier($_SESSION['eID']);     //echo $line_manager;

if ($line_manager=='4') {
 
$to='hr@fiberathome.net; muhsina.akter@fiberathome.net'."\n";     //echo $to;   
$subject = "Business Card Requisition";                          // echo $subject;
                                                            
$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no :  $reference_no and user id # $request_empid </b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                               //  echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;


$retrival = mail($to,$subject,$message,$headers); //echo "<br>"; echo $retrival;

if($retrival) {
                // echo "Message sent successfully.....";
              }
         
          else 
               {
                 // echo "Message could not be sent......";
               }
}  



/*----------------End HR Person Mail Function ----------------*/



}   //End submit Function         //Ending submit Curli Bracket

?>


<table class="model-1" width="100%" height="20%" border="0" >   
    <tr>       
      <td>    <?php include("top_menu.php"); ?> </td>  
	</tr>		
</table> 


<html>
<head>
    
<title>Date Picker on click of Calendar Icon</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<link href="css/it.css" type="text/css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="css/business_card_modal.css">
 <script type="text/javascript" src="js/business_card_modal.js"  ></script>

<script src="js/business.js"></script>
<script type="text/javascript"> 
  function BusinessCardPreview(id)
   {
     window.open('view/business_card_preview.php?id="+id+"');
   }
</script>


</head>


    <body>
    
     <div class="model-1">
            <div class="content-wrapper">
                <div id="header">
        <!--    <p style="margin-left: 30%;"><b> </b></p>   ---->
               </div>
    
         <!----------Content Start---------------------------->
      <div id="content">
<div> <h2 class="business-title">  Business Card Requisition Form </h2> </div>

<form action="" name="pic" method="post"  enctype="multipart/form-data" onSubmit=" return check();" charset="utf-8" id="form-certificate">
  
 
<div> <h3 id="fiber_title">Fiber @ Home</h3>
   <div id="human">
      <h3 id="buss_human">Human Resources Department</h3>
      <h3 id="buss_mandatory"> All asterisk(<font size="+1.5" style="color:#F00" >*</font>)  fields are mandatory</h3>
          
    </div>       
 </div> 
 
  <div id="sub_date">
	 Submission Date :
	 <input type="text" name="submission_date" class="alt_date" value="<?php echo date("Y-m-d");  ?>" readonly><br>
   <font id="date_styl">(y-m-d)</font> 
	</div>
    

<fieldset>   
<legend><h5>&nbsp; PLEASE FILL IT IN CAPITAL LETTER &nbsp;</h5> </legend><br>

<div class="model-2">	  
       <table class="test-1" width="100%" border="0" > 
       
            <tr>
            <td width="18%">Employee Name : </td>
            <td><input type="text" name="emp_name" class="business-border" readonly value="<?php echo $office_info[26]; ?>"  id="up" /> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td>
            </tr>
 
           <tr>
            <td>Employee ID :</td> 
			      <td> <input type="text" name="emp_id" class="business-border" readonly value=" <?php echo $office_info[25];  ?>" />&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
           </tr>  
            
		       <tr>
             <td>Designation : </td> 
			       <td> <input type="text" name="designation" class="business-border" readonly value="<?php echo $office_info[2]; ?>"  id="up"/> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr>  
            
			
		       <tr>
            <td>Function :</td> 
			      <td> <input type="text" name="function" class="business-border" readonly value=" <?php echo $office_info[3]; ?>" id="up"/>&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
           </tr> 
		   
		       <tr>
            <td>Department :</td> 
			      <td> <input type="text" name="department" class="business-border" readonly value=" <?php echo $office_info[4]; ?>" id="up"/> &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></td> 
           </tr>  
		   
		       <tr>
             <td>Mobile Number :</td> 
			       <td> <input type="text" name="mobile_number" class="business-border" readonly value="<?php echo $other_info[15]; ?>"/>&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
           </tr>  
		   
           <tr>
            <td>Alternative Mobile No. :</td> 
			      <td> <input type="text" name="alter_number" class="business-border"  /></td> 
           </tr>
           
		      <tr>
            <td>Extension No. :</td> 
			     <td> <input type="text" name="extension_number" class="business-border"  value="<?php echo $other_info[16];  ?>" /> </td> 
          </tr>   
		   
		      <tr>
            <td>Email :</td> 
			       <td> <input type="email" name="email" class="business-border" readonly value="<?php echo $other_info[18]; ?>"/>&nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font> </td> 
          </tr>  
           
          <tr>
          <td>Alternative Email :</td> 
			    <td> <input type="email" name="alter_email" class="business-border" id="fremail" placeholder="your@email.com" /></td> 
           </tr>  

         <tr>
         <td>&nbsp;</td>
         </tr>  
   
  
	</table>   
</div>
</fieldset> 

<br>


<fieldset>   
<legend> <h5> &nbsp;Preferred Office Address &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></h5> </legend>
<div class="model-3">

<div><b> [ Please tick the Head Office / NMC Address or Fill in the Blank Box ] &nbsp;&nbsp;&nbsp;   </b>  </div><br>

<table cellspacing="1" cols="3" border="0" id="off">
    <tr>
      <td>
        <input type="radio" name="office_name" value="Head Office" id="head" onFocus="hide('tblB');hide('tblC'); show('tblA');">Head Office
       
        <input type="radio" name="office_name" value="NMC Office" id="nmc" onFocus="hide('tblA');hide('tblC');show('tblB'); return true;">NMC Office
            
        <input type="radio" name="office_name" id="regional" value="Regional Office Address"  onFocus="hide('tblA');hide('tblB'); show('tblC'); return true;"  >Regional Office Address 
      </td>  
    </tr>
  </table>
  
  
 <table id="tblA" style="DISPLAY: none" cols="1" cellpadding="2">
    <tbody>
    <tr valign="top" align="left">
      <td>
       <textarea name="office_address" class="border" readonly >House# 7/B, Road#13, Gulshan-01, Dhaka-1212, Bangladesh. </textarea>
      </td>
    </tr>
    </tbody>
</table>
  
  
  <table id="tblB" style="DISPLAY: none" cols="1" cellpadding="2">
    <tbody>
    <tr valign="top" align="left">
      <td>
      <textarea name="nmc_address" class="border" readonly  >House# 8/B, Road#01, Gulshan-01, Dhaka-1212, Bangladesh. </textarea>
      </td>
    </tr>
    </tbody>
  </table>
  
  

  
<table id="tblC" style="DISPLAY: none" cols="1" cellpadding="2">
  <tr>
		<td>Job Location :</td>
      <td>  
        <select name="exe_id" class="opt_val" id="location" onChange="showAddress(this.value)"  />

<!--- onClick='RigionalAddress(this.value);' -->

          <option value="">Select</option> 
          <?php
			    while($row=mysql_fetch_array($job_location))
			    {
			      echo "<option>";
			      echo  $row['posting_district'];
			      echo "</option>";
			    }
			  ?>
        </select>  
      <font size="+1.5" style="color:#F00" >*</font></td>     
</tr>  



<tr id="suggestions7" style="display: none;">
                       <!-- <td width="18" align="right">&nbsp;</td> --->
                       <!-- <td class="suggestionsBox6"> -->
                 <div class="suggestionList7" id="autoSuggestionsList7">&nbsp;</div>  
        </td>
</tr> 



  <tr>
	     <td>CO/RO Location :  </td>
          <td> 
          <select name="office" class="opt_val" id="offceaddress" onChange="Show_CORO_Address(this.value)"   />
           <option value="">Select</option> 
           </select> 
         <font size="+1.5" style="color:#F00" >*</font> 
         </td>  	
     </tr>   
 
 
     
     <tr id="suggestions8" style="display: none;">
                       <!-- <td width="18" align="right">&nbsp;</td> --->
                       <!-- <td class="suggestionsBox6"> -->
                 <div class="suggestionList8" id="autoSuggestionsList8">&nbsp;</div>  
        </td>
    </tr> 



     <tr>
	    <td>Office Address :  </td>
          <td> <select name="ro_co_address" class="opt_val" id="ro_co_address"  />
          <option value="">Select</option>  
           </select> </td> 
    </tr>  

</table>


 <br>

 
 <table>
     <tr>
       <td> Tel : (+88 02)  8812501, 8814873, 8812507, 9897921 <br>
		   Fax : +88 0258815010 <br>
           www.fiberathome.net </td>

		</tr>
			   
	</table>   
</div>
</fieldset> 

 <br>

 
<fieldset>   
<legend> <h5>&nbsp; Reason(Please Select)  &nbsp;&nbsp;<font size="+1.5" style="color:#F00" >*</font></h5> </legend> 
<div class="model-4"> 
<table class="certificate-table1" >                       
<tr align="center">


    <td><input type="radio" name="reason" value="New Joining" id="new_join"  onClick="NewJoining(this.value)" />New Joining
          
     <input type="radio" name="reason"  value="Card is Exhausted" id="card_exhaust"  onClick="CardExhaust(this.value)" />Card is Exhausted  
               
     <input type="radio" name="reason"  value="Change of Employment Status"  id="change_emp" onClick="ChangeEmployment(this.value)"/>Change of Employment Status</td> 
     
     <div id="msg1"></div> 
</tr>
</table> 

<table id="tbl_V" style="DISPLAY: none" cols="1" cellpadding="2">
    <tbody>
    <tr valign="top" align="left"> 
      <td> <input type="text" name="joining_date"  id="tbl_T" readonly  value="<?php echo $joining_date;  ?> "  /><br>
 <font id="date_styl2" >(y-m-d)</font> </td>
    </tr>
    </tbody>
  </table>
  
 <table id="tbl_P"  cols="1" cellpadding="2">
    <tr valign="top" align="left">
       <td>  </td>
    </tr>
  </table>
 
 
  <table id="tbl_Q"   cols="1" cellpadding="2">
    <tr valign="top" align="left">
      <td> </td>
    </tr>
  </table>
 
</div>
</fieldset> 
<br>


<fieldset>   
<legend><h5>&nbsp; Requirement &nbsp; <font size="+1.5" style="color:#F00" >*</font></h5> </legend>

<table class="certificate-table1"  id="card" >  

<tr>
<td>
<h3 id="requi_color"> Earlier Requisition &nbsp;&nbsp; : &nbsp;&nbsp;
<?php 
echo $requi_count[0];  
?>
</h3> 
</td>
</tr>

<tr>
    <td><input type="radio" name="card_value" value="Regular" id="regular" onFocus="hide('tblY');" />Regular 
    <input type="radio" name="card_value"  value="Urgent" id="urgent" onFocus="show('tblY'); return true;"/>Urgent (<font  style="color:#F00" >incur 4 times extra cost to the company</font>) 
  </td>   
</tr>


  <table id="tblY" style="display:none;">
     <tr>
      <td>
      Justification :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  type="text" name="card_justify" id="card_justi" />&nbsp;<font size="+1.5" style="color:#F00" >*</font></td>
     </tr>

     <tr>
     <td>Required From : <input type="text" name="required_from" id="issueDate" placeholder="Date" />&nbsp;<font size="+1.5" style="color:#F00" >*</font> <div id="date_color">date(y-m-d)</div></td>
     </tr>
  </table>

</table>
          

<table id="approve-part" border="0"  style="display:none;" > 
<div id="recommend" style="display: none;"> 
 <h3 style="margin-top:2px; ">&nbsp;&nbsp; Head of Function </h3> <h3 style="margin-top:-30px; margin-left:300px; ">Head of Dept.</h3> <h3 style="margin-top:-30px; margin-left:610px; ">Verified by HR Person</h3>
</div>
<br>

 <tr>  
       <!------------------- Head of Function ID tr3  -------->
 
     <td>ID:</td> 
     <td><input type="text" name="request_employee_id" class="certificate-border"   /></td>
     
   
      <!------------------- Head of Dept ID tr4  -------->
   
    <td> ID :</td> 
    <td><input type="text" name="head_id" class="certificate-border" /></td> 
    
    
    <!-------------------HR Executive ID -------->
    
     <td> ID:</td> 
      <td><input type="text" name="executive_id" class="certificate-border" /></td>
      
 </tr>
 
 


<tr>
                        <!------------------- Head of Function Name tr3  -------->
     <td>Name:</td> 
     <td> <input type="text" name="request_emp_name" class="certificate-border"  /> </td>
    
    
            <!------------------- Head of Dept Name tr4  -------->
   
      <td> Name:</td> 
      <td><input type="text" name="head_name" class="certificate-border"  /></td>
    
    
            <!-------------------HR Executive Name -------->
    
       <td> Name:</td> 
      <td><input type="text" name="executive_name" class="certificate-border" /></td>
      
 </tr>   
 
 
 

   <tr>
   
     <!------------------- Head of Function Designation tr3  -------->
   	<td>Designation:</td> 
  		<td><input type="text" name="request_emp_designation" class="certificate-border" /> </td>
     
     
         <!------------------- Head of Dept Designation tr4  -------->
      <td>Designation:</td> 
		  <td><input type="text" name="head_designation" class="certificate-border"   /> </td> 
       
        
            <!-------------------HR Executive Designation -------->
        
      <td>Designation:</td> 
	    <td><input type="text"  name="executive_designation" class="certificate-border" /> </td>
  </tr>  
   
   

   <!---------------- HOHR  ID Name and Desigantion Information -------------------->

<tr>
     <td>ID:</td> 
     <td> <input type="text" name="hr_id" class="certificate-border"  /></td>
     
     <td> Name:</td> 
     <td> <input type="text" name="hr_name" class="certificate-border"  /></td>
    
    
    <td> Designation:</td> 
    <td><input type="text" name="hr_designation" class="certificate-border"  /></td>
      
  
 </tr>   
   
 </table>  

<br>
            
</fieldset> 


<br>
<div id="manpower_version"> Version:2.2 Effective Date : June 30, 2015 </div>
<div align="center" id="submit_manpower"><input type="submit" name="save" value="SAVE" id="fnt" >&nbsp;&nbsp;&nbsp;<input type="submit" name="submit"  value="SUBMIT" onClick="return send();" id="fnt"></div>
	<br>





      </form>

       </div>
                <!----------Content End---------------------------->
      </div>

        </div>
        
       
    </body>
</html>