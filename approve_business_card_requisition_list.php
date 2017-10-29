<?php

$control = new control();
$empid = $_SESSION['eID'];
echo  "<span style='color:#F00'>ID : $empid</span> ";  

$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);

$head_of_function = $control->HeadOfFunction();      //Head of Function

$job_location = $control->JobLocation();

$empdept = $control->employee_department_list();

$empdesignaiton = $control->employee_designation_list();

$empfunction = $control->employee_workarea_list();

$dept= $office_info[4];                      // echo $dept;

$hohr_email = $control->HOHREmailSending();  //echo 'HOHR ID :'.$hohr_email[0]; echo 'HOHR Email :'.$hohr_email[1];

$hohr_email[0];                               // echo HOHR ID :
 
//$scm = $control->SCMApprovalList($empid);    //echo 'SCM Employe List'.$scm[0];

$userDetails=$control->UserEmployeeInfo($_SESSION['eID']);  //echo 'User Email'.$userDetails[5];



if (isset($_POST['btnSearch'])) {
    $statement = "";
  
  
   if ($_POST['employee_name_4'] != "" && $_POST['employee_id_4'] !=""  ) {
  
     $statement .=" and tbl_business_card_requisition_form.emp_name = '$_POST[employee_name_4]' and tbl_business_card_requisition_form.emp_id = '$_POST[employee_id_4]' "; 
    }
  
  
   if($_POST['employee_id_4'] != "") {
    $statement .=(" and tbl_business_card_requisition_form.emp_id='$_POST[employee_id_4]' ") ; 
    } 
  
  
    if ($_POST['department'] != "") {
        $statement .=" and tbl_business_card_requisition_form.department like '%$_POST[department]%'";
    }

   if ($_POST['designation'] != "") {
        $statement .=" and tbl_business_card_requisition_form.designation like '%$_POST[designation]%'";
    }

   if ($_POST['function'] != "") {
        $statement .=" and tbl_business_card_requisition_form.function like '%$_POST[function]%'";
    }
  
  if ($_POST['office_name'] != "") {
        $statement .=" and tbl_business_card_requisition_form.office_name like '%$_POST[office_name]%'";
    }

  if ($_POST['reason'] != "") {
        $statement .=" and tbl_business_card_requisition_form.reason like '%$_POST[reason]%'";
    }
  
  
  if($_POST['month'] !="")
   {
     $statement .=(" and tbl_business_card_requisition_form.ref_no like'%$_POST[month]%' ");
     }
  
  
  if($_POST['year'] !="")
   {
     $statement .=(" and tbl_business_card_requisition_form.ref_no like'%$_POST[year]%' ");
     }
   
   if($_POST['card_requirement'] !="")
  {
    $statement .=(" and tbl_business_card_requisition_form.card_value like '%$_POST[card_requirement]%' ");
  }
  
   
  if($_POST['deliver_pending'] !="")
  {
     
    if($_POST['deliver_pending'] == '1')  $deliver='1';

      $statement .= (" and (tbl_business_card_requisition_form.scm_approve='$deliver') ");

  } 



    $mod_statement = str_replace("'", "*", $statement);
}

 $allProblemInfo = $control->BusinessCardRequisitionApprove($empid,$statement); 

if(isset($_POST['Submit']))
{

  $data = array($_POST['id'],$_POST['approve'],$_POST['approve_hr'], $_POST['reject_reason'], $office_info[25],$office_info[26], $office_info[2], $_POST['approve_date'],$_POST['approve_date_hr'], $_POST['approve_hod'], $_POST['approve_hod_date'], $_POST['scm_approve'], $_POST['scm_approve_id'],$_POST['approve_date_scm'], $_POST['inventory_approve'], $_POST['approve_date_inventory']);


	
   //---------- Approval of HOF/HOHR  --------------- 
 
  if(($_POST['approve']=='1') || ($_POST['approve']=='2' && $_POST['reject_reason']!='') )
    {
      $info=$control->BusinessCardApprove_HOF_or_HOHR($data);
   
    } 
   
  

   // ---------- Approval of HOD/HOHR  ---------------  
   
   if(($_POST['approve_hod']=='1') || ($_POST['approve_hod']=='2' && $_POST['reject_reason']!='') )
   { 
      $info = $control->ApproveBusinessHOD($data);
   }
   
 
 //---------- Approval of HR Executive(Mahmudul Hasan) -------------

  if(($_POST['approve_hr']=='4' ) || ($_POST['approve_hr']=='5' && $_POST['reject_reason']!=''))
   {
      $info = $control->BusinessCardApprove_HR_Person($data);
   }

  
  //--------- Approval by SCM (Nayman) ---------------  
   
    if($_POST['scm_approve']=='1')
    {
        $info=$control->ApproveBySCM($data);

    }

//-----------Approval by Inventory-----------------*/

    /* if($_POST['inventory_approve'])
      {
        $info=$control->ApprovebyInventory($data);
      }

  */


    if ($info)
	   {
echo "<meta http-equiv='refresh'content='0;url=?e=pabx&p=all_list&f=all&l=approve_business_card_requisition_list'>";  //block this to show mail funtion
        echo "<h2 id='tie' >Your request has been approved successfully </h2>";
      }



//----------------------To HOD Mail Function if(HOF!=HOD) ----------------------

$line_manager = $control->return_tier($_SESSION['eID']);  

$info=$control->Business_Card_UserMailFunction($data);   
$ref_no = $info[4];              //echo 'Reference-No'  $ref_no; 

$user_id = $info[1];            //echo $user_id = $info[1];
$val    = $control->LM_HOF_HOD($info[1]);  
$lm_id  = $val[0];  //print_r($val);
$hof_id = $val[1];
$hod_id = $val[2];  
$md_id  = $val[3]; 

if(($line_manager=='3' && $_POST['approve']=='1'))
{

$EmailAddress = $control->EmailAddress($hod_id); 
$to=$EmailAddress[18].'; muhsina.akter@fiberathome.net'."\n";   // echo $to;  

$subject = "Business Card Requisition";                         // echo $subject;

$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no: $ref_no and user id # $user_id</b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                              //  echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                        // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) {
            //echo "Message sent successfully.....";
         }
          else {
            //echo "Message could not be sent......";
         }

} //end if return_tier 3 
         



//--------------------To HR Person Mail Function (if HOF=HOD) ---------------------

if(($line_manager=='4' && $_POST['approve_hod']=='1') || ($line_manager=='4' && $_POST['approve_hod']=='')) 
{
$to='hr@fiberathome.net; muhsina.akter@fiberathome.net'."\n";        //   echo $to;
$subject = "Business Card Requisition";                              //  echo $subject; 

$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no: $ref_no and user id # $user_id </b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                                      //  echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) 
       {
            //echo "Message sent successfully.....";
         }

         else {
            //echo "Message could not be sent......";
         }


}


/*---------------------To SCM Personnel Mail Function  ---------------------*/

if($office_info[4]=='HR' && $office_info[29]=="Team Member" && $_POST['approve_hr']=='4' )
{

$to='scm@fiberathome.net; muhsina.akter@fiberathome.net'."\n";    // echo $to;
$subject = "Business Card Requisition";                           // echo $subject; 


$note .="Dear Concern,"."<br><br>";
$note .="Business card approval has remained pending against the <b>reference no: $ref_no and user id # $user_id </b>"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd";

$message = $note;                                                //  echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) 
       {
            //echo "Message sent successfully.....";
         }

         else {
            //echo "Message could not be sent......";
         }
}



//---------------------To User Mail Function (if SCM level approve) --------------------

if($_POST['scm_approve']=='1')
{

$to=$info[0].'; muhsina.akter@fiberathome.net'."\n";         // echo $to;
$subject = "Business Card Requisition";                      // echo $subject;

$note .="Dear Concern,"."<br><br>";
$note .="Your business card requisition has been approved from SCM personnel against the <b>reference no: $ref_no</b>"."<br><br>";
$note .="Thanks & best regards"."<br><br>";
$note .="$office_info[26]"."<br>";
$note .="$office_info[2], $office_info[4]"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd"."<br><br>";



$message = $note;                                            // echo $message;
    
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                               // echo $headers;

$retrival = mail($to,$subject,$message,$headers);

if($retrival) {
            //echo "Message sent successfully.....";
         }else {
            //echo "Message could not be sent......";
         }

} //end if return_tier 3 



//----------------To User Mail From any Level Rejected---------------

if(($_POST['approve']=='2') || ($_POST['approve_hod']=='2') || ($_POST['approve_hr']=='5') ) 

{

$to=$info[0].'; muhsina.akter@fiberathome.net'."\n";         //  echo $to;

$subject = "Business Card Requisition";                      // echo $subject;

$note .="Dear Concern,"."<br><br>";
$note .="Your business card requisition has been rejected against reference no. <b>$ref_no.......!</b>"."<br><br>";
$note .="Thanks & best regards"."<br><br>";
$note .="$office_info[26]"."<br>";
$note .="$office_info[2], $office_info[4]"."<br>";
$note .="HRIS Link : https://192.168.2.4/hris"."<br><br>";
$note .="Fiber @ Home Ltd"."<br><br>";

$message=$note;                                               //echo $message;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
$headers .='From: hr@fiberathome.net';                        // echo $headers;

$retrival = mail($to,$subject,$message,$headers);  //echo "<br>"; echo $retrival;

if($retrival) {
            //echo "Message sent successfully.....";
         }
         else {
            //echo "Message could not be sent......";
         }

 }  //endif
   





}  //End Submit Function 

?>

<table width="100%" height="20%" border="0" bgcolor="" class="model-1">   
    <tr>       
     <td>    <?php include("top_menu.php"); ?> </td> 
	</tr>		
</table> 



<!DOCTYPE html> 
 <html>
 <head>
 <link href="css/it.css" rel="stylesheet" type="text/css" >

 <style type="text/css">
   
   label {
  display: block;
}
 </style>
 <script type="text/javascript">
 
 function popitup(id)
 {
	 window.open("view/view_business_card_list.php?id="+id, "Details", "scrollbars=yes,width=900,height=600");
	 
 }

  function BusinessCardPreview(id)
 {

   window.open("view/business_card_preview.php?id="+id, "Card", "scrollbars=yes,width=900,height=900" );
 }

 </script>
 


<script type="text/javascript">
        function lookupEmp(inputString) {
            if(inputString.length == 0) {
                // Hide the suggestion box.
                $('#suggestions').hide();
            } else {
                $.post("view/Employee3.php", {queryString: ""+inputString+""}, function(data){
                    if(data.length >0) {
                        $('#suggestions').show();
                        $('#autoSuggestionsList').html(data);
                    }
                });
            }
        } //end lookup

        function fill(thisValue) {
            $('#empname').val(thisValue);
            setTimeout("$('#suggestions').hide();", 200);
        }
        function EmpID(thisValue)
        {
            $('#empid').val(thisValue);
        }
       
        function EmpDesignation(thisValue)
        {
            //alert('thisValue');
            $('#empdesig').val(thisValue);
        }
		
		 function EmpDepartment(thisValue)
        {
            //alert('thisValue');
            $('#empdepartment').val(thisValue);
        }
		
		 function EmpFunction(thisValue)
        {
            $('#empfunc').val(thisValue);
        }
		
		
		 function EmpJobLocation(thisValue)
        {
            $('#empjoblocation').val(thisValue);
        }
		
		
    </script>

 </head>

<body>
    <div class="">
        <div class="model-1">
            <div id="header">
             <!--   <p style="margin-left: 30%;"><b> </b></p> --->
            </div>

            <!----------Content Start---------------------------->
            <div id="content">
   

          
<form name="input" method="post" action="" enctype="multipart/form-data" onSubmit="return validateForm()" > 
                   
<fieldset style="border-radius: 5px 5px 5px 5px;">
                    <legend class="fld">&nbsp;Search&nbsp;</legend>
                    <table>
                    
  <tr>
   <td>Emp Name :</td>
   <td> <input type="text" id="empname" onKeyUp="lookupEmp(this.value)" name="employee_name_4" class="requirement" value="<?php echo $_POST['employee_name_4'];  ?>" <?php {echo "selected";} ?> /></td>
     
    <td> &nbsp;&nbsp;Emp ID :</td>
    <td><input type="text" id="empid"  name="employee_id_4"  value="<?php echo $_POST['employee_id_4'] ?>" <?php {echo "selected";} ?> style="width:145px; height:15px; border-radius:5px" />
    </td> 
    
     <td>&nbsp;&nbsp;Department :</td>
     <td>  
      <select name="department" style="width:160px; height:27px; border-radius:5px" >
       <option value="">Select </option> 
        <?php foreach($empdept as $row){  ?>
        <option 
        <?php 
         if($_POST['department'] == $row['department_name']) { echo 'selected="selected"';} ?> value="<?php echo $row['department_name']; ?>"> <?php echo $row['department_name']; ?>
        </option>
        <?php } ?> 
    </select>

         </td>  
    </tr>  
      
  
      
      <tr  id="suggestions" style="display: none;">
                     <td width="50" align="right"></td> 
                       <td class="suggestionsBox" > 
                       <div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
                </td>
       </tr>  
                
                    
                    
 <tr>       
  <td>Designation :</td>
    <td> <select name="designation" style="width:160px; height:27px; border-radius:5px" >
    <option value="">Select</option> 
    <?php foreach($empdesignaiton as $desig) 
    { 
    ?>
    <option 
    <?php if ($_POST['designation']==$desig['designation']) {echo 'selected="selected"';} ?> value="<?php echo $desig['designation']; ?>" > <?php echo $desig['designation']; ?></option>
    <?php
     } 
    ?>
  </select>
  </td>
  
  <td> &nbsp;&nbsp;Function : </td>
      <td>
      <select name="function" style="width:160px; height:27px; border-radius:5px">
      <option value="">Select</option>
     <?php foreach ($empfunction as $empfunc) 
     {
     ?>  
     <option <?php if ($_POST['function']==$empfunc['work_field']) { echo 'selected="selected"' ;  }?> value="<?php echo $empfunc['work_field']; ?>"><?php echo $empfunc['work_field'];?></option> 
      <?php
      }
      ?> 
      </select>
    </td>
      
    <td>&nbsp;&nbsp;Reason : </td>
          <td>
          <select name="reason" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="New Joining" <?php if($_POST['reason']=="New Joining") echo "selected";  ?>>New Joining</option>
          <option value="Card is Exhausted" <?php if ($_POST['reason']=="Card is Exhausted") { echo "selected";
            } ?>>Card is Exhausted</option>
            <option value="Change of Employment Status" <?php if($_POST['reason']=="Change of Employment Status") {echo "selected"; } ?> >Change of Employment Status</option>
           </select>
     </td>
  </tr>       



<tr>
     <td> Month :  </td>
      <td>
          <select name="month" style="width:160px; height:27px; border-radius:5px">
            <option value="" >Select</option>
          
          <?php 
           $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep", "Oct","Nov","Dec");
            foreach ($months as $month)
             {
            ?>  
           <option  value="<?php echo  $month; ?>"  <?php if ($_POST['month']=="$month") {echo "selected";} ?> > <?php echo $month; ?></option>;

           <?php
             }
           ?>
           </select>
     </td>  
     
     
     <td>&nbsp;&nbsp;Year :  </td>
      <td>
           <select name="year" style="width:160px; height:27px; border-radius:5px">
            <?php
             $current_year = date('Y');

         //for($i=2016; $i<=$current_year; $i++ )
         //echo '<option value="'.$current_year.'" selected="selected">'.$current_year.'</option>';

          echo "<option value='$current_year' >$current_year</option>";
          echo "<option value='' disabled>Other : </option>";

             foreach (range($current_year, 2016) as $years) 
            {
            ?>
            <option value="<?php echo $years; ?>" <?php if ($_POST['year']=="$years") 
            {echo "selected"; } ?> > <?php echo $years; ?></option>;

            <?php
             }
            ?>
           </select>
     </td>
     

     <td>&nbsp;&nbsp;PO Done /Pending : </td>
     <td>
       <select name="deliver_pending" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="1"  <?php if($_POST['deliver_pending']=="1")  {echo "selected"; } ?> >PO Done</option>
            <option value="0"  <?php if($_POST['deliver_pending']=="0") {echo "selected";} ?>  >Pending</option>
           </select>
     </td>


     
</tr>


<tr>
<td>Requirement : </td>
          <td>
          <select name="card_requirement" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="Regular" <?php if($_POST['card_requirement']=="Regular")  {echo "selected"; } ?> >Regular</option>
            <option value="Urgent" <?php  if ($_POST['card_requirement']=="Urgent")  {echo "selected"; }  ?>  >Urgent</option>
           </select>
</td>

<td>&nbsp;&nbsp;Office Name : </td>
          <td>
          <select name="office_name" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="Head Office" <?php if($_POST['office_name']=="Head Office")  {echo "selected"; } ?> >Head Office</option>
            <option value="NMC Office" <?php if($_POST['office_name']=="NMC Office")  {echo "selected"; } ?> >NMC Office</option>
            <option value="Regional Office Address" <?php if($_POST['office_name']=="Regional Office Address")  {echo "selected"; } ?> >Regional Office Address</option>
           </select>
</td>

</tr> 

<tr>
 <td> </td>
 <td>  </td>
 <td> </td>
 <td> </td>
 <td><input type="submit" name="btnSearch" value="Search" id="src"> </td>
</tr>

</table>
</fieldset>


<br><br>

<div> <h3 class="manpower-title"> Approval List of Business Card Requisition </h3> </div>


 <hr/> 
 <br><br>

<table class="TFtable-business" border="1" bordercolor="#CCCCCC" style="border-radius:5px 5px 5px 5px;" width="100%" cellpadding="2" cellspacing="0">         
                       
                        <tr id="business">
                            <td>SLNo.</td>
                            <td>Ref No.</td> 
                            <td>EmployeeInformation</td>

                            <td>Reason </td>
                            <td>OfficeName</td> 
                            <td>Requirement </td>

                            <td>Submission Status</td>
                            
                            <td>HOF/HOHR </td>
                            <td>HOD/HOHR </td>
                            <td>HR Verification</td>
                            
                            
						                <td>SCM Verification</td> 
                     <!---       <td>Inventory Verification</td>  ------>
                            <td>RejectReason<br>
Mandatory(<font size="+2" style="color:#F00" >*</font>) </td> 
						  

		<td>Action</td>


    <td>
       <h3> View  </h3> 
    </td> 

 
 <?php
 //if($scm[0]==$empid)
 if((($office_info[4]=='Supply Chain') && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' )) || ($office_info[4]=='HR' && $office_info[29]=="Team Member")) 
 {
 ?>
   <td>
      <form>
          <h3><input id="ChkAll" type="checkbox" onchange="javascript:CheckedAll();" /><span style="color: #03F">SelectAll</span> </h3> <h3> <input type="button" value="Click" id="btntest" /> </h3> 
      </form>
    </td> 

<?php
}
?>

          </tr>


                <?php
				             foreach($allProblemInfo as $alt):

                    $val    = $control->LM_HOF_HOD($alt[2]);       //  print_r($val);
                    $lm_id  = $val[0]; 
                    $hof_id = $val[1];
                    $hod_id = $val[2];  
                    $md_id  = $val[3]; 
                
              //  if(($hof_id==$empid) || ($hod_id==$empid) || ($hohr_email[0]==$empid) || ($empid=='02-0472') || ($empid=='02-0917')  ||($empid==$scm[0]) ) 

        if(($hof_id==$empid) || ($hod_id==$empid) || ($hohr_email[0]==$empid) || ($office_info[4]=='HR' && $office_info[29]=="Team Member") || ($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' ))) 
               {
				      ?> 	
                            			
                      <tr>
							             <td><b><?php static $i=1; echo $i++ ;  ?> </b></td>
                            <td><span style='color:#03F'><?php echo $alt[30]; ?></span></td>

                           <td id="body-row">
                             <?php echo "<span><b>ID : </b>$alt[2]</span>"; echo '<br>'; ?>
                             <?php echo "<span><b>Name : </b>$alt[1]</span>"; echo '<br>'; ?>
                             <?php echo "<span><b>Desig : </b>$alt[3]</span>"; echo '<br>'; ?>
                             <?php echo "<span><b>Func : </b>$alt[4]</span>"; echo '<br>'; ?>
                             <?php echo "<span><b>Dept. : </b>$alt[5]</span>"; echo '<br>' ?>
                            </td>

                            <td><?php echo $alt[11]; ?></td>
                            <td><?php echo $alt[9]; ?></td>
                            <td><?php echo $alt[43];?></td>
           
           
<!------------------Submission Status------------------------------------------>                 
    <td>    
	   <?php 
			   $approve="<img src=\"images/tick.gif\" width=20px;height=20px  />";
		     echo $approve;   
			 ?>
    </td>

 <form action="" method="post" enctype="multipart/form-data">
 
   
   <!-------------------1st td ------- HOF/HOHR  Approval ----------------------------> 
          <td>   
					<?php
            $approve="<img src=\"images/tick.gif\" width=20px;height=20px  />";
            $reject="<img src=\"images/cal_close.gif\" width=20px;height=20px />";
            $pending="<img src=\"images/stay.gif\" width=22px; height=22px  />";


				 if($alt[25]=='1' )
					 {
		         echo $approve;
					 }

				elseif($alt[25]=='2')
					  {
				      echo $reject;
					  }
						
	
				//elseif($empid=='02-0472' || $empid=='02-0917')
            elseif ($office_info[4]=='HR' && $office_info[29]=="Team Member")
						{ 
		           echo $pending;
						} 
						
			 elseif($empid!=$hof_id and $empid!=$hohr_email[0])
						{
		             echo $pending;
						}  


						 else{
							?>

                
                <?php
				     //  if($empid==$alt[33]  || $empid==$alt[15] )

                //$hohr_email[0]

                 if($empid==$hof_id  || $empid==$hohr_email[0] )
						   
               {
					   ?> 
                <select name="approve" class="brand" style="width:70px" id="reason-type" onChange="OnChange(this.form.approve)" >
                            <option value="">Select</option> 
                            <option value="1">Approve </option> 
                            <option value="2">Reject</option>
                  </select>
                             
                    <?php
                    }
                    ?>
                             
              <?php
						}
						
					   ?>
                      
                     </td>
                     
                  
   
   <!-------------------2nd td -------------HOD/HOHR Approval ----------------------------> 
 
              <td>   
              <?php

						   if($alt[48]=='1')
							 {
		             echo $approve;
							 }

							 elseif($alt[48]=='2')
							  {
						     echo $reject;
							  }

						   elseif($alt[25]=='2')
							 
							  {
								 echo ' ';  
							  }
							  
						  elseif($alt[25]=='')
							  {
                  echo $pending; 
							  }
						 
					   elseif($empid!=$hod_id and $empid!=$hohr_email[0])
							{
		                  echo $pending; 
							}  
						
					
					
							
    /*-------------After Approved by HOF/HOHR then option will get HOD/HOHR---------------*/	
	
	
	          /*  elseif($alt[25]!='1')
						 {
						          $pending="<img src=\"images/stay.ico\" width=22px;height=22px  />"; 
		                  echo $pending;  
						 }
             */
						 
						   //elseif($alt[14]==$alt[33])
           /*  elseif($hof_id==$hod_id)
							{
						        $approve="<img src=\"images/Check.ico\" width=20px;height=20px  />";
		                 echo $approve;
							} */
	                  
	                //elseif($head_funtion!=$head_dept)

             /* elseif($hof_id!=$hod_id)
							{
						         $pending="<img src=\"images/stay.ico\" width=22px;height=22px  />"; 
		                 echo $pending; 
							}   */  
							
						   else{
							?>
 
               <?php
                  if($empid==$hod_id || $empid==$hohr_email[0])     // 16  hr_id  // 15  head_id
						   {
						  ?> 
                          
                <select name="approve_hod" class="brand" style="width:70px" id="reason-type" onChange="OnChange(this.form.approve_hod)" >
                            <option value="">Select</option> 
                            <option value="1">Approve </option> 
                            <option value="2">Reject</option>
                            </select>
                             <?php
                              }
                             ?>
                
					   <?php
						}
					   ?>
               
                  </td>
                  
                  
 
 
  <!---------------------3rd td  ------HR Personel Approval  ---------------------->       
  
            <td>
							<?php
               
						     if($alt[26]=='4' )
							 {
		              echo $approve;
							 }
							
							elseif($alt[26]=='5')
							{		
						      echo $reject;
							}
							
							
							 elseif($alt[25]=='')
							 {
                 echo $pending;
							 }
                             
							 
							elseif($alt[25]=='2')
							  {
								  echo ' ';  
							  }

							elseif($alt[48]=='2')
							{
								echo ' ';
							}
							

            
              elseif(!($office_info[4]=='HR' && $office_info[29]=="Team Member"))  
							{
		            echo $pending; 
							}
							
							   
                                 
 /*-------------After Approved by HOD/HOHR then option will get HR Person--------------*/
	 	
						elseif($alt[25]!='1')
						 {
		          echo $pending;  
						 }  
						 
						 
						  elseif($alt[48]!='1')
						 {
		             echo $pending;  
						 }   
						 	 
						else{
							?>
                       
              <?php
             
              if($office_info[4]=='HR' && $office_info[29]=="Team Member")
						  {
						  ?>
                 <select name="approve_hr" class="brand" style="width:70px" id="reason-hr" onChange="OnChange(this.form.approve_hr)" >
                 <option value=""> Select </option> 
                 <option value="4">Verify</option> 
                 <option value="5">Reject</option> 
              </select>
                             
                <?php
                  }
                ?>
                             
            <?php
						 }
						?>
      </td>
      

        
    <!---------------------4th--- td------SCM Approval ----------------------> 
           <td> 
           <?php

              if($alt[55]=='1' )
               {
                 // echo $approve;

                echo '<span style="color:#33C; font-weight:bold; font-size:12px"> PO Done </span>';
               }
              
               elseif($alt[25]=='')
               {
                 echo $pending;
               }
                             
               
              elseif($alt[25]=='2')
                {
                  echo ' ';  
                }

              elseif($alt[48]=='2')
              {
                echo ' ';
              }
              

              elseif($alt[26]=='5')
              {
                echo ' ';
              }
              

             // elseif($empid!=$scm[0] )
              elseif(!($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' ))) 
              {
                echo $pending; 
              }
              
                 
                                 
 /*-------------After Approved by  HR then option will get SCM Person--------------*/
    
            elseif($alt[25]!='1')
             {
              echo $pending;  
             }  
             
             
            elseif($alt[48]!='1')
             {
                 echo $pending;  
             }   


             elseif ($alt[26]!='4') {
             echo $pending;
            }

            
            else{
           ?>

      	
            <?php
				   // if($empid==$scm[0])
            if($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' ))
						{
					   ?> 
                  <select name="scm_approve" class="brand" style="width:70px" id="reason-type" onChange="OnChange(this.form.approve)" >
                            <option value="">Select</option> 
                            <option value="1">PO Done </option> 

                   </select>
                         <?php
                           }
                        ?>


                <?php
                }
                ?>
            </td>  
                     
                 


      <!---------------------5th--td------Inventory Approval ----------------------> 

     <!---  <td>         	
            <?php
             $approve="<img src=\"images/Check.ico\" width=20px;height=20px  />";
             $reject="<img src=\"images/cal_close.gif\" width=20px;height=20px />";
             $pending="<img src=\"images/stay.ico\" width=22px;height=22px  />"; 
            
				       if($alt[58]=='1' )
						  {
					      //echo $approve;
                echo '<span style="color:#393; font-weight:bold; font-size:12px">Received </span>';
              }

            
             elseif($alt[58]=='2' )
              {
                //echo $approve;
                echo '<span style="color:#33C; font-weight:bold; font-size:12px"> Delivered  </span>';
              }


            elseif($alt[25]=='')
               {
                 echo $pending;
               }
                             
               
               elseif($alt[25]=='2')
                {
                  echo ' ';  
                }

              elseif($alt[48]=='2')
              {
                echo ' ';
              }

              elseif($alt[26]=='5')
              {
                echo ' ';
              }
                

          elseif($empid!='02-0800')
             {
                echo $pending;
             }
             

//-------------After Approved by  HR then option will get SCM Person--------
    
            elseif($alt[25]!='1')
             {
              echo $pending;  
             }  
             
          elseif($alt[48]!='1')
             {
                 echo $pending;  
             }   
             
           elseif ($alt[26]!='4') {
             echo $pending;
           }
            

            elseif ($alt[55]!='1') {
              echo $pending;
            }

          

             else{

              if($empid=='02-0800')
              {
            ?>
                <select name="inventory_approve" class="brand" style="width:70px" id="reason-type" onChange="OnChange(this.form.approve)" >
                            <option value="">Select</option> 
                            <option value="1">Received</option> 
                            <option value="2">Delivered</option> 
                 </select>
             <?php
               }
             ?>
             
         <?php
           }
        ?>   
      </td> ---->   

      
        
<td id="text-reason"> 
<input type="text" name="reject_reason" <?php if($alt[25]=='2' || $alt[26]=='5' || $alt[48]=='2' || $alt[58]=='2'){?>style="display:none" <?php } ?> <?php if($alt[25]=='1' && $alt[26]=='4' && $alt[48]=='1' && $alt[55]=='1') {?> style="display:none" <?php }?> spellcheck="true" id="reject-lineman">  
	
<script type="text/javascript">
  
 function OnChange(dropdown)
 {

    var myindex  = dropdown.selectedIndex
	//alert(myindex);
    var SelValue = dropdown.options[myindex].value
	
	//alert(SelValue);

	if(SelValue=='2' || SelValue=='5' )
	{ 
     	var reject_value=document.getElementById('reject-lineman').value;
		
		if(reject_value=='')
		{
	    // alert('Reject Reason is Mandatory !');
		 return false;
		 
		}
	}
  
 }

</script>  


<?php
	echo  $alt[31]; 
	?>
</td>

 
	    
  <td>   
  <input type="hidden" name="id" value="<?php echo $alt[0]; ?>"/>

  <?php
  if(($empid==$hof_id and $alt[25]=='') || ($empid==$hohr_email[0] and $alt[25]=='' ))    //  HOF or HOHR
  {
  ?>
  
  <div><input type="submit"  name="Submit"  value="Submit" id="approve-submit" onClick="return send();"></div> 

  <?php
  }

 elseif((($empid==$hod_id and $alt[48]=='') and ($alt[25]=='1')) || (($empid==$hohr_email[0] and $alt[48]=='') and ($alt[25]=='1' )))  //  HOD or HOHR  

   {
  ?>
    
  <div><input type="submit"  name="Submit"  value="Submit" id="approve-submit" onClick="return send();"></div> 

  <?php
  }
 

// else if(($empid=='02-0472' || $empid=='02-0917' and $alt[26]=='') and ($alt[48]=='1') )    //  HR Person

elseif (($office_info[4]=='HR' && $office_info[29]=="Team Member" and $alt[26]=='') and ($alt[48]=='1')) 
 {
 ?>

 <div><input type="submit"  name="Submit"  value="Submit" id="approve-submit" onClick="return send();"></div> 

<?php
}
                                                          

elseif (($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' )) and ($alt[55]=='' and $alt[26]=='4'))    //  SCM Approval Person
{
?>
 <div><input type="submit"  name="Submit"  value="Submit" id="approve-submit" onClick="return send();"></div> 
<?php
}

elseif ($empid=='02-0800' and $alt[58]=='0' and $alt[55]=='1')                //  Inventory Approval Person
 {

?>
<div><input type="submit"  name="Submit"  value="Submit" id="approve-submit" onClick="return send();"></div> 

<?php
}
?>

   <br> 
  </td>
         
         

<td>
<h3> <a class="print" href=""  onClick="popitup(<?php echo $alt[0]; ?>)" title="print" >View</a>  </h3>

	     <?php
        if(($empid==$hof_id and $alt[25]=='') || ($empid==$hohr_email[0] and $alt[25]=='' ))   //  HOF or HOHR
	     {
         ?>   
	 
       <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="Details">Details</a>
         <?php
		 }
		 
		 
		elseif((($empid==$hod_id and $alt[48]=='') and ($alt[25]=='1')) || (($empid==$hohr_email[0] and $alt[48]=='') and ($alt[25]=='1' )))   //HOD or HOHR
		 {
		 ?> 
         <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="Details">Details</a>
         <?php
		 }
		 

	// else if(($empid=='02-0472' || $empid=='02-0917'  and $alt[26]=='') and ($alt[48]=='1') )   //  HR Approval Person

    else if(($office_info[4]=='HR' && $office_info[29]=="Team Member" and $alt[26]=='') and ($alt[48]=='1') )   //HR Approval Person
		 {
		 ?>
    <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="Details">Details</a>
    
    <?php
		 }

       //  SCM Approval Person
  elseif (($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' )) and ($alt[55]=='0' and $alt[26]=='4')) 
     {
		?>
  
 <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="Details">Details</a>
     <?php
     }

     elseif($empid=='02-0800' and $alt[58]=='0' and $alt[55]=='1' )    //  Inventory Approval Person
     {
     ?>
   
   <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="Details">Details</a>
 
    <?php
    } 
    ?>

  </td>


<td>
<script>

function CheckedAll(){
    debugger
     if ($('#ChkAll').is(':checked')) {
         
          $('#DivChk input[type=checkbox]').attr('checked', 'checked');           
     }
     else {
          $('#DivChk input[type=checkbox]:checked').removeAttr('checked');
     }
   }


// Returns an array with values of the selected (checked) checkboxes in "frm"
function getSelectedChbox(frm) {
  var selchbox = [];   

  var inpfields = frm.getElementsByTagName('input');

  var nr_inpfields = inpfields.length;

  for(var i=0; i<nr_inpfields; i++) {


    if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) 

      selchbox.push(inpfields[i].value);
  }

 return selchbox;
}

 
 document.getElementById('btntest').onclick = function()
 {
  var selchb = getSelectedChbox(this.form);     // gets the array returned by getSelectedChbox()

   //var selchb;
   window.open("view/business_card_preview.php?id="+selchb, "Card", "width=900, height=900"); 
}

</script>


<?php
//if(($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' )) and ($alt[55]=='1'))

if((($office_info[4]=='Supply Chain') && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' ) && ($alt[55]=='1')) || ($office_info[4]=='HR' && $office_info[29]=="Team Member") )
{
?>

<div id="DivChk">
<h3><input type="checkbox"  name="check[]" value="(<?php echo $alt[0];?>)" > <a class="card_preview" href="" onclick="BusinessCardPreview(<?php echo $alt[0];?>)" title="Card Preview"  > <span style="color: #000"> Card Preview </span></a></h3>
</div>

</td>
<?php
}
?>                              
 </form>                       
 </tr>


      <?php
      }
      
       endforeach;
      ?>



  <!--- if($alt[25]=='1' && $alt[26]=='4' && $alt[48]=='1' && $alt[55]=='1' && $alt[58]=='1' )  --->  


 </table>         


                
            </div>  <!------ Content End ---------->

        </div>
    </div>  
</body>

</html>

</html>





