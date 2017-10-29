
<?php
include_once '../control/control.php';
include_once '../model/model.php';

session_start();

$control = new control();

$empid = $_SESSION['eID'];
//echo $empid;

$dept=$office_info[4];

$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);

$Value = $control->FetchBusinessCard($_GET['id']);


?>
<!DOCTYPE html>
<head>
 
 
 <link href="css/it.css" rel="stylesheet" type="text/css">
 
<style type="text/css">

input[type='radio'] { 
transform: scale(1.5);
font-weight: bold;
color:#000; 
}

#certificate-title{
	color:#333;
	margin-left:41%;
	margin-top:-3.5%;	
}

#buss_requi{
	margin-left:41%;
	margin-top:-20px;
}


#human{
margin-left:41%;
	margin-top:-20px;
}

 .bg-color{
	 background-color: #FFF;	 	 	 
 }
 
 .business-title{
	 margin-left:41%; 
	 width:100%;
	 margin-top:-30px;	
}

 #date-time-business{
margin-top:-50px;
margin-left:1000px;	
}

.certificate-table1{
	 font-size:18px;
	 width:100%;
	 margin-top:-20px;	 
}

#purpose-title{
	  margin-top:-35px;
	  margin-left:330px; 
	  color:#900;
}

.border{
	width:120%;
	
	
}

#up
{
text-transform: uppercase;	
}


@media print{
  #btnprint{
	  display:none;
  }
  
 .left-menu{
	display:none;	
}

#menu{
	display:none;
	
}

.active no-hover{
	display:none;
	
}

.active{
	display:none;
}

}

  fieldset{
	  border:1px solid #333366;
	}
	
	legend{
	padding: 0.1em 0.1em;
	border:1px solid green;
	font-size:12px;
	/*margin-left:400px;*/
	
	/*text-align:right; */
	background: #CCC;
	color:#333;
	}
	
.business-table{
	/*font-size:14px;*/
	 width:100%;
	 border: 1px solid;
}



#approve-part{
	 width:100%;
	 font-size:18px;
	 color: #000;
}


#approve-part {
	border:1px solid #666;
	border-collapse:collapse;	
}

#hr1{
	width:27%;
	 font-size:12px;
	 color: #000;
     font-weight:bold;
}

/*#recommend{
background-color:#CCC;
height:20px;
}  */

#business
	{
		
	 margin-top:-25px;
	 font-size:18px;
	 border:1px solid #000;
	 background-color: #999999;
	 font-weight:bold;
	 margin-bottom:20px;
	 font-style:oblique;
	 
	}

#date-time-business{
	margin-left:900px;
}


#tblC{
    width:40%;
	margin-left:300px;
	margin-top:-25px;
	font-size:18px;	
}

#tblY{
	  
	  margin-left:30%;
	  font-size:18px;
}

#card{
	margin-left:20%;
}

.ixt{
	margin-top:-10px;
}

/*fieldset {
  padding:1px;

  } */

#tick{
	margin-left:240px;
	margin-top:-20px;
	
}

.test-1{
	 font-size:16px;
	 margin-left:275px;
	 margin-top:-10px;
	 width:100% ;
	 border:0;
}


#tre{
	margin-top:3px;
}

#tbl_V{
 
    font-size: 18px;
    
	margin-left:265px;
}

</style>
   <script type="text/JavaScript">

function show(id)
{
     if (document.getElementById(id).style.display == 'none')
     {
          document.getElementById(id).style.display = '';
     }
}


function hide(id)
{
          document.getElementById(id).style.display = 'none';

}

</script>   
        
</head>
    
    
 <body>
<div class="bg-color">
  <div class="content-wrapper" >
       <!-- <div id="header">
       <!--    <p ><b> </b></p> 
         </div> ---->

<!----------Content Start---------------------------->
<div id="content" >
<br>

<form name="input" method="post" action="" enctype="multipart/form-data">
   <div><input type="button" name="it_equipment" id="btnprint"  value="Print" onClick="window.print()" style="margin-left:88%; color:#F00; width:60px; height:30px; font-size:14px; background:#F8F8F8; margin-top:-40px">  </div>
  
  
    <h3 class="business-title"> Business Card Requisition Form </h3>
    
    <div> <img src="../images/logo.png" style="width:100px; height:50px; margin-top:-60px; margin-left:75%"></div>
    
 <div id="tre"> <h3 id="certificate-title">Fiber @ Home</h3>
         <h4 id="human">Human Resources Department</h4>
          <h4 id="buss_requi"> Version:2.2 Effective Date : June 30, 2015 </h4>
          
 </div> 
 


  <div style="margin-top:-10px;"><b> Ref No: <?php echo $Value[30]; ?> </b> </div>

   <div style="margin-left:63%; margin-top:-1%" >
	 <td><b>Submission Date : </b></td>
	 <td><?php  echo $Value[29];?> <!--<font size="+1" >(y-m-d)</font>--> </td>
	</div>

<fieldset> 

<legend id="text"> <h3> &nbsp; PLEASE FILL IT IN CAPITAL LETTER &nbsp; </h3> </legend>
<div class="model-2">	  
       <table class="test-1"  >   

        <tr>
         <td width="19%">Employee Name : </td>
           <td id="up"> <?php echo $Value[1];  ?>  </td>
          </tr>
 
           <tr>
            <td>Employee ID :</td> 
			<td> <?php echo $Value[2];  ?> </td>
           </tr>  
            
		  <tr>
           <td>Designation : </td> 
		   <td id="up"> <?php echo $Value[3];  ?></td>          </tr>  
            
			
		   <tr>
            <td>Function :</td> 
			<td id="up"> <?php echo $Value[4];  ?> </td> 
           </tr> 
		   
		    <tr>
            <td>Department :</td> 
			<td id="up"> <?php echo $Value[5];   ?></td> 
           </tr>  
		   
		   <tr>
            <td>Mobile Number :</td> 
			<td> <?php echo $Value[6];  ?></td> 
           </tr>  
		   
           <tr>
            <td>Alternative Mobile No. : </td> 
			<td> <?php echo $Value[41];  ?></td> 
           </tr>
           
		   <tr>
            <td>Extension No. :</td> 
			<td> <?php echo $Value[7];  ?></td> 
           </tr>   
		   
		    <tr>
            <td>Email :</td> 
			<td> <?php echo $Value[8]; ?> </td> 
           </tr>
           
            <tr>
            <td>Alternative Email :</td> 
			<td> <?php echo $Value[47]; ?> </td> 
           </tr>          
	</table>   
</div>
</fieldset> 
<br>




<fieldset class="ixt">   
<legend> <h2> &nbsp;Preferred Office Address  &nbsp;</h2> </legend>

<div id="tick"><b> [ Please tick the Head Office / NMC Address or Fill in the Blank Box ]   </b>  </div><br>


<table cellspacing="1" cols="3" border="0" style="margin-left:245px; font-size:18px">
    <tbody>
    
    
    
   <?php  
   if($Value[9]=="Head Office" && $Value[10]!='')
   {
   ?>
    
    <tr valign="top" align="left">
      <td>
        <input type="radio" name="office_name" value="Head Office" <?php if($Value[9]=="Head Office") {echo "checked";} ?> onFocus="hide('tblB');hide('tblC');show('tblA');"> Head Office</td>
        
     <td>
      <?php if($Value[9]=="Head Office") {echo '&nbsp;&nbsp;&nbsp;';  echo $Value[10]; } ?>   
      </td>   
   </tr> 
   
   
   <?php
   }
   ?>
    

    
    
    
    <?php  
   if($Value[9]=="NMC Office" && $Value[40]!='')
   {
   ?>
       
  <tr>       
     <td>   
        <input type="radio" name="office_name" value="NMC Office"   <?php if($Value[9]=="NMC Office") {echo "checked";} ?> onFocus="hide('tblA');hide('tblC');show('tblB');return true;">  NMC Office</td>
        
       <td>
      <?php if($Value[9]=="NMC Office") {echo '&nbsp;&nbsp;&nbsp;'; echo $Value[40]; }
		  
		  ?> 
      </td>  
</tr> 
  
  
  <?php
   }
  ?>
  
  
  <?php if($Value[9]=="Regional Office Address" && $Value[32]!=''  ) 
  {
  ?>
   <tr>    
      <td>       
        <input type="radio" name="office_name" value="Regional Office Address"  <?php if($Value[9]=="Regional Office Address") {echo "checked";} ?> onFocus="hide('tblA');hide('tblB');show('tblC');return true;"> Regional Office Address</td>
        
   
    </tr>

<?php
  }
?>
    </tbody>
  </table>
  
  
  
<table id="tblC"  cols="1" cellpadding="2">
   
   <tr> 
     <td>&nbsp;  </td> 
   </tr>
   
   
  <?php if($Value[9]=="Regional Office Address" && $Value[32]!=''  ) 
  {
  ?>
    <tr> 
     <td> <b> Job Location : </b> <?php echo $Value[32]; ?>  </td> 
   </tr>

<?php
  }
?>



    <?php if($Value[9]=="Regional Office Address" && $Value[45]!=''  ) 
    {
    ?>

   <tr>
      <td> <b> CO/RO Location : </b> <?php echo $Value[45]; ?></td>  	
   </tr>  
   <?php
    }
  ?>
  
  

   <?php if($Value[9]=="Regional Office Address" && $Value[46]!='')
   {
   ?>
   <tr>
      <td> <b> Office Address : </b> <?php echo $Value[46]; ?></td>  	
   </tr> 
   
   <?php
   }
   ?>

</table>
  
 <br>

 <table style="margin-left:245px; margin-top:-10px;">
      <tr>
        <td> Tel : (+88 02)  8812501, 8814873, 8812507, 9897921 <br>
         Fax : +88 0258815010 <br>
           www.fiberathome.net </td>

       </tr>
			   
	</table> 
</fieldset> 




 <br>

<fieldset class="ixt">   
<legend> <h2>&nbsp;Reason(Please Tick) &nbsp; </h2> </legend> 
<div class="model-4"> 
<table class="certificate-table1" id="card" >                       


<tr>
   <td> 
      <input type="radio" name="reason"  value="New Joining"   <?php if($Value[11]=="New Joining") {echo "checked";} ?>  disabled>New Joining 
           		
   <input type="radio" name="reason" value="Card is Exhausted"   <?php if($Value[11]=="Card is Exhausted") {echo "checked";}  ?> disabled >Card is Exhausted  
   
   <input type="radio" name="reason"  value="Change of Employment Status"  <?php if($Value[11]=="Change of Employment Status") {echo "checked";} ?> disabled >Change of Employment Status
   </td>     			 
</tr>
</table> 

<table id="tbl_V"  cols="1" cellpadding="2">

<?php  
 if($Value[11]=="New Joining" && $Value[11]!='')
  {
?>
<tr>
<td>
Joining Date : <?php echo $Value[28]; ?> </td> 
</tr>
<?php
   }
?>


</table>
  
</div>
</fieldset> 

<br>

<fieldset class="ixt">  
<legend> <h2>&nbsp; Requirement &nbsp; </h2> </legend>

<table class="certificate-table1"  id="card"  >                      
<tr>
    <td><input type="radio" name="card_value" value="Regular" onClick="RegularValue(this.value)"  <?php if($Value[43]=="Regular") {echo "checked";} ?> id="regular" disabled />Regular 
    

  <input type="radio" name="card_value"  value="Urgent"  <?php if($Value[43]=="Urgent") {echo "checked";} ?> id="urgent" onClick="UrgentValue(this.value)" disabled />Urgent (<font  style="color:#F00" >incur 4 times extra cost to the company</font>) 
  </td>  
  
</tr>


<table id="tblY" >
  <?php  
   if($Value[43]=="Urgent" && $Value[42]!='')
   {
   ?>
<tr>
<td>
Justification : <?php echo $Value[42]; ?> </td> 
</tr>
<?php
   }
?>

  <?php  
   if($Value[43]=="Urgent" && $Value[44]!='')
   {
 ?>

<tr>
<td>Required From : <?php echo $Value[44]; ?></td> 
</tr>

 <?php
   }
 ?>
</table>

</table>
 </fieldset>   
   

<br>

<fieldset class="ixt">   
<legend> <h2>&nbsp;Approved &amp; Verified By &nbsp; </h2> </legend> 
<td><input type="hidden" name="it_signature2" value="<?php echo $Value[12];  ?>"></td>

<div class="model-3">
<table id="approve-part" border="0" > 
<br>

<tr id="business">
<td width="0">&nbsp; Head of Function/HOHR </td>
<td width="35%">&nbsp;</td>
<td width="32%">&nbsp;Head of Dept./HOHR</td>
</tr>


<tr>
<!----------------  HOF/HOHR  -------------------->
<td> &nbsp;Status :
   <?php 
	 
	 if($Value[25]=='1')
   {
     echo "<span style='color:black '>Recommended </span>"; 
   } 
   
	 
	 if($Value[25]=='2')
      {
        echo "<span style='color:black '>Rejected </span>";
      } 
   
   ?></td>
   
  
  <td>&nbsp;</td>
   
  <!----------------  HOD/HOHR  -------------------->
    
  <td>&nbsp;Status :
  <?php 
   
   if($Value[48]=='1')
   {
     echo "<span style='color:black '>Recommended  </span>"; 
   } 
   
   
   if($Value[48]=='2')
    {
 echo "<span style='color:black '>Rejected </span>";
     } 
   
   ?>
    </td>

 </tr>



<tr>
<!----------------  HOF/HOHR Name -------------------->

   <td>&nbsp;Name :  <?php 
	  

if($Value[25]=='1' && $Value[48]=='1' && $Value[13]=='' )  //Emp = HOF=HOD
  {
     echo $Value[1];
  }

  if($Value[25]=='1' || $Value[25]=='2') 
    { 
      echo $Value[37]; 
    }

 ?> 
   </td>   
	

  <td>&nbsp;</td>   
	
    

<!----------------  HOD/HOHR Name -------------------->
	
<td>&nbsp;Name : <?php 
  if($Value[25]=='1' && $Value[48]=='1' && $Value[13]=='' )  //Emp = HOF=HOD
    {
      echo $Value[1];
    }

  
   if($Value[48]=='1' || $Value[48]=='2') 
    { 
     echo $Value[51];  
    }
    

    ?> 

  </td> 

</tr>   
 



  <tr>	
     
 <!----------------  HOF/HOHR Designation -------------------->
   <td>&nbsp;Designation : <?php 

    if($Value[25]=='1' && $Value[48]=='1' && $Value[13]=='' )  //Emp = HOF=HOD
      {
        echo $Value[3];
      }
		 
		 if($Value[25]=='1'  ||  $Value[25]=='2') 
		 {
			echo $Value[34]; 
		 }
		
	    ?> 
  </td> 
     

  <td>&nbsp; </td> 
             
   
 <!----------------  HOD/HOHR Designation -------------------->
         
    <td>&nbsp;Designation : <?php 
      if($Value[25]=='1'  &&  $Value[48]=='1' && $Value[13]=='' ) 
     {
      echo $Value[3];  
     } 

     if($Value[25]=='1'  ||  $Value[25]=='2') 
     {
      echo $Value[52]; 
     }
     
   ?>
    </td> 
 </tr>  
     
     
         
  <tr>

   <!--------- HOF/HOHR ID -------------->

  <td>&nbsp;ID : <?php  

  if($Value[25]=='1' && $Value[48]=='1' && $Value[13]=='' )  //Emp = HOF=HOD
  {
     echo $Value[2];
  }

 if(($Value[25]=='1' ||  $Value[25]=='2') )
    { 
    echo $Value[13];   
 } 

 ?> 

</td>
    
 
  <td>&nbsp; </td>
   
   
 <!--------- HOD/HOHR ID -------------->
    
    <td>&nbsp;ID : <?php  

    if($Value[48]=='1' &&  $Value[48]=='1' && $Value[13]=='' ) 
     { 
        echo $Value[2];   
     } 

    if($Value[48]=='1' ||  $Value[48]=='2') 
     { 
       echo $Value[50]; 
     }
  
    ?>
     </td>
     
</tr>


<tr>
     <td>&nbsp;Date : 
     <?php              //HOF/HOHR Approve Date 
	  
	 if($Value[25]=='1')
   {
     echo "<span style='color:black '>$Value[38]</span>"; 
   } 
   
	 
	 if($Value[25]=='2')
    {
      echo "<span style='color:black '> $Value[38]</span>";
     } 
   
   ?>
   </td>
    

  <td>&nbsp;</td>
    
    
<td>&nbsp;Date :     
  <?php                 //HOD/HOHR Approve Date  
   
   if($Value[48]=='1')
   {
     echo "<span style='color:black '>$Value[49]</span>"; 
   } 
   
   
   
   if($Value[48]=='2')
    {
      echo "<span style='color:black '>$Value[49]</span>";
     } 
   
   ?>
     </td>
</tr>


<tr id="business">
<td width="0">&nbsp; Verified by HR Personel </td>
<td width="35%">&nbsp; </td>
<td width="32%">&nbsp;Verified by SCM Personel</td>
</tr>


<tr>
<td> &nbsp;Status :
   <?php              //HR Person Status 
    
    if($Value[26]=='4')
      {
       echo "<span style='color:black '>Verified </span>"; 
      } 
    
    if($Value[26]=='5') 
   {
 echo "<span style='color:black '>Rejected </span>"; 
     }   
    ?>
   </td>
   

  <td> </td>
   
  <td>&nbsp;Status :
   <?php 

   if($Value[55]=='1')    // SCM  Person Status
   {
     echo "<span style='color:black '>Verified </span>"; 
   } 
   
   ?>
    </td>
 </tr>



  <!----------------   // HR Person  Name -------------------->
<tr>
   <td>&nbsp;Name :  <?php 

$appr_info = $control->HeadOfFunctionName($Value[27]); 

if($Value[26]=='4') 
  {
     echo $appr_info[26];
  }  
  
  else
  {
  if($Value[26]=='5') 
     {
       echo $appr_info[26];
     }
  
  }

  ?>
    </td>   


 <td>&nbsp;</td>
  


    <!----------------  SCM Person Name-------------------->
  
<td>&nbsp;Name : <?php 

       $appr_info = $control->HeadOfFunctionName($Value[56]);    
        if($Value[55]=='1')                 
           { 
             echo $appr_info[26];
           }
   
          ?>  

          </td> 
   </tr>   
 


     <tr> 
     
      <!----------------  HR Person Designation  -------------------->
         <td>&nbsp;Designation :  <?php 

          $appr_info = $control->HeadOfFunctionName($Value[27]); 

        if($Value[26]=='4')
           {
              echo $appr_info[2];
           }
       
       else   {
        
        if($Value[26]=='5')
      
            echo $appr_info[2];
        } 
      
       ?>
    </td>   
  
        
     <td>&nbsp;</td>

         
     <!----------------  SCM person Designation -------------------->
         
     <td>&nbsp;Designation : <?php 

         $appr_info = $control->HeadOfFunctionName($Value[56]);   
            if($Value[55]=='1')                 
              { 
                  echo $appr_info[2];
              }
   
               ?> 
         </td> 
     </tr>  
     


  <!---------------- ID -------------------->
  <tr>
  <td>&nbsp;ID : <?php  if($Value[26]=='4')    //  HR Person ID
   {
    echo $Value[27]; 
   }  
    
   else 
     {
   if($Value[26]=='5') 
   {
      echo $Value[27]; 
   }
   
   }
   ?>

    </td> 

    <td>&nbsp;</td>

    <td>&nbsp;ID : <?php 
      $appr_info = $control->HeadOfFunctionName($Value[56]);    //  SCM Person ID
            if($Value[55]=='1')                 
              { 
                  echo $appr_info[25];
              }
   
        ?> </td>
     </tr>


  <!----------------  Date  -------------------->

  <tr>
      <td>&nbsp;Date: <?php        //HR Person Approval Date 
    
    if($Value[26]=='4')
      {
        echo "<span style='color:black '>$Value[39]</span>"; 
      } 
    
    if($Value[26]=='5') 
     {
      echo "<span style='color:black '>$Value[39]</span>"; 
     }   
    ?>

    </td> 

    <td>&nbsp;</td>

    <td>&nbsp;Date : <?php             //SCM Person Approval Date 
            if($Value[55]=='1')                 
              { 
                  echo $Value[57];
              }
   
          ?></td>
     </tr>


 </table>  
 <br>        
</div>                    
</fieldset> 
<br>

      </form>

       </div>
                <!----------Content End---------------------------->
            </div>

        </div>
        
       
    </body>
</html>