<!DOCTYPE html>
<head>
 
<?php
include_once '../control/control.php';
include_once '../model/model.php';
session_start();
$control = new control();
$empid = $_SESSION['eID'];             //echo $empid;

$dept=$office_info[4];
$office_info = $control->user_personal_info_uniq2($_SESSION['eID']);
$other_info = $control->OtherInfo($_SESSION['eID']);

$id_all = explode(',',$_GET['id']);   //echo $id_all[0];  echo $id_all[1];

echo '<div><input type="button" name="it_equipment" id="btnprint"  value="Print" onClick="window.print()" style="margin-left:88%; color:#F00; width:60px; height:30px; font-size:14px; background:#F8F8F8; margin-top:-200px">  </div>';


foreach ($id_all as $id)
{

//echo $id;

  $a=str_replace("(", "", $id);       //str_replace(find, replace, string, count);     //echo $a;

  $a=str_replace(")", "", $a);       // echo $a; 

  $a = str_replace("on", "1", $a);   // echo $a;

  $Value = $control->FetchBusinessCard($a);

?>

<body>
<div class="test-1"  > 

      <br>

       <div>
        <img src="../images/logo.png" style="width:70px; height:35px; margin-left:70%; margin-top: 5px;"><td>
        </div>

        <div><span class="pdf_title" style="margin-left: 5%; font-size: 15px; font-weight: bold; background-color: #C00; color: #fff; ">
            <?php echo $Value[1];  ?>&nbsp;</span>
         </div>
 
          <div> <span class="id_font"><?php echo $Value[3];  ?> </span>
          </div>
            
           <div><span class="id_font"> <?php echo $Value[5]; ?> </span>       
           </div> 

          <div><span class="id_font"><?php echo '+88',$Value[6]; echo ' , '; echo '+88';echo $Value[41]; ?></span></div>
           
       
          <div><span class="id_font">Ext : +880 9666776677-<?php echo $Value[7];  ?> </span>
          </div>

      
           <div><span style="margin-left:20%; color:#C00; font-size: 11px;" ><?php echo $Value[8];  ?></span> 
           </div> 
       
          
        

<?php  
   if($Value[9]=="Head Office" && $Value[10]!='')
   {
   ?>
   <div><span style="margin-left: 5%;font-size: 11px;"><b>Fiber @ Home Ltd :</b><?php if($Value[9]=="Head Office") {echo '&nbsp;';  echo $Value[10]; } ?>   
     </span>
     </div>

   <?php
   }
   ?>
    


   <?php  
   if($Value[9]=="NMC Office" && $Value[40]!='')
   {
   ?>
       
   <div><span style="margin-left: 5%;font-size: 11px;"><b>Fiber @ Home Ltd : </b>
      <?php if($Value[9]=="NMC Office") {echo '&nbsp;'; echo $Value[40]; } ?> 
      </span>
  </div>

  <?php
   }
  ?>



  <?php if($Value[9]=="Regional Office Address" && $Value[32]!=''  ) 
  {
  ?>
    <div><span style="margin-left: 5%;font-size: 11px;"><b>Fiber @ Home Ltd : </b>

     <?php echo $Value[32];  if($Value[9]=="Regional Office Address" && $Value[45]!='' ) 
      {
         echo ", ".$Value[45];
      ?>

     <?php
      }
     ?> 


   <?php if($Value[9]=="Regional Office Address" && $Value[46]!='')
   {
    echo ", ".$Value[46];
   ?>
 
 
   <?php
   }
   ?>

  </span>  
  </div>

<?php
  }
?>
        
  <div style="margin-left: 10%; font-size: 11px; margin-bottom: 13px;">Phone : (+88 02) 8812501, 8814873, Fax : +88 0258815010  </div> 
  </div>


</body>

<?php
}

?>

 
<link href="css/it.css" rel="stylesheet" type="text/css">
 
<style type="text/css" >
  
  .test-1{
    border: 1px solid;
   margin-left:1%;
    width: 48%; 
    float: left;
    margin-top: 5px;
  }


  @page {
        margin: 0; 
      }

 @media print{
  #btnprint{
    display: none;
  }
 }


.id_font{
  margin-left:5%; 
  font-size: 11px;
}

 @page {
      size: auto;
      margin: 5mm 10mm 10mm 20mm; /* margin you want for the content     top,right, bottom, left (15mm 10mm 10mm 20mm;)*/    
  }

</style>
        
</head>
      
<body>
<div class="bg-color">
    <div class="content-wrapper" >
       

<!----------Content Start---------------------------->
            <div id="content" >



       </div>
                <!----------Content End---------------------------->


     </div>
</div>
        
</body>
</html>