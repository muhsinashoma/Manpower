 <?php

$control = new control();
$_SESSION['eID'];
$empid = $_SESSION['eID'];
echo  "<span style='color:#F00'>ID : $empid</span> ";
$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);
$job_location = $control->JobLocation();
$empdept = $control->employee_department_list();

$empdesignaiton = $control->employee_designation_list();
$empfunction = $control->employee_workarea_list();

if (isset($_POST['btnSearch'])) {
    $statement = "";
	
	 if ($_POST['employee_name_4'] != "" && $_POST['employee_id_4'] !=""  ) {
  
	   $statement .=" and tbl_business_card_requisition_form.emp_name = '$_POST[employee_name_4]' and tbl_business_card_requisition_form.emp_id = '$_POST[employee_id_4]' ";
	   
    }
		
	
    if($_POST['employee_id_4'] != "") {
    $statement .=(" and tbl_business_card_requisition_form.emp_id='$_POST[employee_id_4]' ") ;
    }
	
    /*if ($_POST['emp_name'] != "") {
        $statement .=" and tbl_business_card_requisition_form.emp_name like '%$_POST[emp_name]%'";
    } */
  
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
	
    $mod_statement =(str_replace("'", "*", $statement));
}


$allProblemInfo = $control->BusinessCardRequisitionList($statement);

?>




<!DOCTYPE html> 
 <html>
 <head>
 <link href="css/it.css" rel="stylesheet" type="text/css" >
 
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script src="autosearch/jquery.js" type="text/javascript"></script>
        <script src="autosearch/dimensions.js" type="text/javascript"></script>
        <script src="autosearch/autocomplete.js" type="text/javascript"></script>
 
 <script type="text/javascript">
 function equipment_prient(id)
 {
  window.open("view/print-business_card_requisition_form.php?id="+id,"printwindow","menubar=1,resizable=1, status=1, scrollbars=yes,width=400,height=350");
 } 
 
 function popitup(id)
 {
	 window.open("view/view_business_card_list.php?id="+id, "Details", "toolbar=no,location=no,status=1,menubar=no, scrollbars=yes,resizabel=no, width=1000, height=700");
 }




function BusinessCardPreview(id)
 {

   window.open("view/business_card_preview.php?id="+id, "Card", "scrollbars=no,width=900,height=900" );
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
<div class="model-1">	           
<form method="post" id="frm1" action="" autocomplete="off">

<br>


<fieldset style="border-radius: 5px 5px 5px 5px;">
   
 <legend class="fld">&nbsp;Search&nbsp;</legend>
   <table>                             
   <tr> 
   <td>Emp Name :</td>
   <td> <input type="text" id="empname" onKeyUp="lookupEmp(this.value)" name="employee_name_4" class="requirement"  /></td>
         
    <td> &nbsp;&nbsp;Emp ID :</td>
    <td><input type="text" id="empid"  name="employee_id_4" style="width:145px; height:15px; border-radius:5px" /></td> 
    
    
     <td>&nbsp;&nbsp;Department :</td>
     <td>  
      <select name="department" style="width:160px; height:27px; border-radius:5px"  id="empdept" >
       <option value="">Select </option> 
            <?php
			 foreach($empdept as $row)
			 {
				 echo "<option>";
				 
				 echo $row['department_name'];
				 
				 echo "</option>";
			 }
			 ?>  
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
        <option value="">Select </option> 
       <?php
	   foreach($empdesignaiton as $desig)
	    { 
		 echo "<option>"; 
		 echo $desig['designation'];
		 echo "</option>";
	   }
	 
	   ?>
       </select>
      </td>
  
          <td>&nbsp;&nbsp;Function : </td>
          <td>
          <select name="function" style="width:160px; height:27px; border-radius:5px">
           <option value="">Select</option>
           <?php
		   foreach($empfunction as $empfunc)
		   {
			   echo "<option>";
			   echo $empfunc['work_field'];
			   echo "</option>";
		   }
		   ?>
          </select>
     </td>
     
 
     <td>&nbsp;&nbsp;Reason : </td>
          <td>
          <select name="reason" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="New Joining">New Joining</option>
            <option value="Card is Exhausted">Card is Exhausted</option>
            <option value="Change of Employment Status">Change of Employment Status</option>
           </select>
     </td>
  </tr>       
  
                           
<tr>
    <td> Month :  </td>
     <td>
          <select name="month" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="Jan">January</option>
            <option value="Feb">February</option>
            <option value="Mar">March</option>
            <option value="Apr">April</option>
            <option value="May">May</option>
            <option value="Jun">June</option>
            <option value="Jul">July</option>
            <option value="Aug">August</option>
            <option value="Sep">September</option>
            <option value="Oct">October</option>
            <option value="Nov">November</option>
            <option value="Dec">December</option>
           </select>
     </td>
     
     
     <td>&nbsp;&nbsp;Year :  </td>
      <td>
           <select name="year" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            
            <?php
             $current_year = date('Y');

             for($i=2016; $i<=$current_year; $i++ )
             {
                echo "<option value='$i'> $i </option>";
             }
           
            ?>
           </select>
     </td>
     

     <td>&nbsp;&nbsp;PO Done /Pending :</td>
     <td>
       <select name="deliver_pending" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="1">PO Done</option>
            <option value="0">Pending</option>
           </select>
     </td>


     
</tr>


<tr>
<td>Requirement : </td>
          <td>
          <select name="card_requirement" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="Regular">Regular</option>
            <option value="Urgent">Urgent</option>
           </select>
</td>

<td>&nbsp;&nbsp;Office Name : </td>
          <td>
          <select name="office_name" style="width:160px; height:27px; border-radius:5px">
            <option value="">Select</option>
            <option value="Head Office">Head Office</option>
            <option value="NMC Office">NMC Office</option>
            <option value="Regional Office Address">Regional Office Address</option>
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

<br>
<br>

<div> <h3 class="manpower-title"> Business Card Requisition List </h3> </div>

 <hr/> 
 <br><br>

<table class="TFtable-business" border="1" bordercolor="#CCCCCC" style="border-radius: 5px 5px 5px 5px;" width="100%" cellpadding="2" cellspacing="0" >         
                        <tr id="business">
                            <td>SLNo.</td>
                            <td>Ref No</td>
                            <td>EmployeeInformation</td>

                            <td>OfficeName</td> 
                            <td>Reason </td>
                            <td>Requirement </td>
                            
                            <td>Submission Status</td>
                            <td>HOF/HOHR </td>
                            <td>HOD/HOHR </td>
                            <td>HR Verification</td>
                            
                            <td>SCM Verification</td>  
                        <!-- <td>Inventory Verification</td> -->
                            <td>RejectReason<br>
Mandatory(<font size="+2" style="color:#F00" >*</font>) </td> 
                            
					               <td>Action  </td>  
                        </tr>
						
                  <?php
				             foreach($allProblemInfo as $alt):

                    $val    = $control->LM_HOF_HOD($alt[2]);       //  print_r($val);
                    $lm_id  = $val[0]; 
                    $hof_id = $val[1];
                    $hod_id = $val[2];  
                    $md_id  = $val[3]; 

if(($hof_id==$empid) || ($hod_id==$empid) || ($hohr_email[0]==$empid) || ($office_info[4]=='HR' && $office_info[29]=="Team Member")  || ($office_info[4]=='Supply Chain' && ($office_info[35]=='Executive' or $office_info[35]=='Sr. Executive' )) || ($empid=='02-0800') || ($alt[2]==$empid)) 
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

                            <td><?php echo $alt[9]; ?></td>
                            <td><?php echo $alt[11];?></td>
                            <td><?php echo $alt[43];?></td>
                            
     <!------------------Submission Status------------------------------------------>                 
        <td> <?php 
       
        if($alt[54]!='1') 
        {
        $pending="<img src=\"images/stay.gif\" width=22px; height=22px  />";
        echo $pending; 
        }

       else {
       if($alt[54]=='1')
        {
         $approve="<img src=\"images/tick.gif\" width=20px;height=20px  />";
         echo $approve;
        } 
       
       }
       ?>
        </td>
                            
							
     <!---------------------------1st column HOF/HOHR ---------------------->  

       <td align="center"> 
          <?php  
          $approve="<img src=\"images/tick.gif\" width=20px;height=20px  />";  
          $pending="<img src=\"images/stay.gif\" width=22px; height=22px  />";
          $reject="<img src=\"images/cal_close.gif\" width=20px;height=20px />";  


         if($alt[25]=='1' and $alt[54]=='1') 
          {
          echo $approve; 
          }

          if($alt[25]=='1' and $alt[54]=='')
          { 
         
          echo $pending;
          }

          if($alt[25]=='2')
          {
            echo $reject;
          }
 
          if($alt[25]!='1' and $alt[25]!='2')
          { 
        
          echo $pending;
          } 

          ?>
        <br>
                     
       </td>
               

                           
  <!---------------------------2nd column HOD/HOHR ---------------------->  

     <td align="center"> 
      <?php  
      
      if($alt[48]=='1' and  $alt[54]=='1')
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
      
      
      else 
      {
       
       echo $pending;
     } 
      ?> 
                   
       </td>
 
                   
                   
  <!---------------------------3rd HR Person ---------------------->   
                   
    <td align="center"> 
			<?php  
			
			if($alt[26]=='4'){
			echo $approve; 
			}

			elseif($alt[26]=='5')
			{
			echo $reject;
			}
			
			elseif($alt[48]=='2')
			{
				echo '';
			}
					 
			elseif($alt[25]=='2')
			{
				echo ' ';
			}
			
			
			else 
			{
			  echo $pending;
		 } 
		  ?> 
                   
       </td>
       

     <!---------------------------4th SCM  ---------------------->   
     
      <td><?php   

      if($alt[55]=='1')
      {

      //echo $approve;
      echo '<span style="color:#33C; font-weight:bold; font-size:12px"> PO Done </span>';
      }

      elseif ($alt[25]=='') {
      echo  $pending;
      }

     elseif ($alt[25]=='2') {
      echo ' ';
     }
     
    elseif ($alt[48]=='2') {
     echo ' ';
    }

    elseif ($alt[26]=='5') {
      echo '';
    }

     else{

       echo $pending;
     }

      ?> </td>


     


     <!---------------------------5th Inventory ---------------------->   
 <!---<td>

     <?php

     if($alt[58]=='1'){ 
      
          echo '<span style="color:#000; font-weight:bold; font-size:12px">Received </span>';
      }

      elseif($alt[58]=='2' ){
            
                //echo $approve;
                echo '<span style="color:#33C; font-weight:bold; font-size:12px"> Delivered  </span>';
      }


     elseif ($alt[25]=='2') {
      echo ' ';
     }
     
    elseif ($alt[48]=='2') {
     echo ' ';
    }

    elseif ($alt[26]=='5') {
      echo '';
    }

    elseif($alt[25]==''){
         echo $pending;
     }


    else{
     echo $pending;
    }

     ?>

  </td>  ---->


<td><?php  echo $alt[31]; ?>  </td>    

<td>  
    <a class="print" href=""  onClick="popitup(<?php echo $alt[0]; ?>)" title="print">View</a> 
 
            <br>
            <br>

        <?php
          if($alt[25]=='')
	      {
        ?>   
	       <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="details">Details </a> 
      
        <?php
          }
         elseif ($alt[54]!='1' )
          {
         ?>

       <a class="edit" href="?e=pabx&p=edit_business_card_requisition_form&id=<?php echo $alt[0]; ?>" title="details">Details </a>  
          
         <?php

		      }
		    ?> 

      <br><br>
      <b> <a class="card_preview" href="" onclick="BusinessCardPreview(<?php echo $alt[0];?>)" title="Card Preview"  > <span style="color: #000"> Card Preview </span></a> </b>

      <br><br>
      <?php
      if($alt[25]=='')
        {
        ?>    
       <a class="delete" href="?e=pabx&p=delete_business_form&id=<?php echo $alt[0]; ?>" onclick="return confirm('Are you sure to delete this ?')" title="Delete">Delete</a>
    
     <?php
     }
     ?> 

   </td> 
           
   </tr>         
           

	    <?php 
		  }
 	     endforeach;
	    ?>
               
  
          </table>
          </form>
          
          </div>
        </body> 
    
 </html>







