<?php
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title>CRUD MONGODB</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>


<div class="container">
<h1>CRUD MONGODB</h1>


<a href="create.php" class="btn btn-success">Add Crime</a>
<a href="read.php"  class="btn btn-success">Lihat agegrasi-1</a>
<a href="read2.php"  class="btn btn-success">Lihat agegrasi-2</a>

<?php


   if(isset($_SESSION['success'])){
      echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
   }


?>


<table class="table table-borderd">
   <tr>
      <th>STATE/UT</th>
      <th>DISTRICT</th>
      <th>YEAR</th>
      <th>MURDER</th>
      <th>ATTEMPT TO MURDER</th>
      <th>CULPABLE HOMICIDE NOT AMOUNTING TO MURDER</th>
      <th>RAPE</th>
      <th>CUSTODIAL RAPE</th>
      <th>OTHER RAPE</th>
      <th>KIDNAPPING & ABDUCTION</th>
      <th>KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS</th>
      <th>KIDNAPPING AND ABDUCTION OF OTHERS</th>
      <th>DACOITY</th>
      <th>PREPARATION AND ASSEMBLY FOR DACOITY</th>
      <th>ROBBERY</th>
      <th>BURGLARY</th>
      <th>THEFT</th>
      <th>AUTO THEFT</th>
      <th>OTHER THEFT</th>
      <th>RIOTS</th>
      <th>CRIMINAL BREACH OF TRUST</th>
      <th>CHEATING</th>
      <th>COUNTERFIETING</th>
      <th>ARSON</th>
      <th>HURT/GREVIOUS HURT</th>
      <th>DOWRY DEATHS</th>
      <th>ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY</th>
      <th>INSULT TO MODESTY OF WOMEN</th>
      <th>CRUELTY BY HUSBAND OR HIS RELATIVES</th>
      <th>IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES</th>
      <th>CAUSING DEATH BY NEGLIGENCE</th>
      <th>OTHER IPC CRIMES</th>
      <th>TOTAL IPC CRIMES</th>
      <th>Action</th>
   </tr>
   <?php


      require 'config.php';


      $crimes = $collection->find([]);


      foreach($crimes as $crime) {
         echo "<tr>";
         echo "<td>".$crime->{'STATE/UT'}."</td>";
         echo "<td>".$crime->DISTRICT."</td>";
         echo "<td>".$crime->YEAR."</td>";
         echo "<td>".$crime->MURDER."</td>";
         echo "<td>".$crime->{'ATTEMPT TO MURDER'}."</td>";
         echo "<td>".$crime->{'CULPABLE HOMICIDE NOT AMOUNTING TO MURDER'}."</td>";
         echo "<td>".$crime->RAPE."</td>";
         echo "<td>".$crime->{'CUSTODIAL RAPE'}."</td>";
         echo "<td>".$crime->{'OTHER RAPE'}."</td>";
         echo "<td>".$crime->{'KIDNAPPING & ABDUCTION'}."</td>";
         echo "<td>".$crime->{'KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS'}."</td>";
         echo "<td>".$crime->{'KIDNAPPING AND ABDUCTION OF OTHERS'}."</td>";
         echo "<td>".$crime->DACOITY."</td>";
         echo "<td>".$crime->{'PREPARATION AND ASSEMBLY FOR DACOITY'}."</td>";
         echo "<td>".$crime->ROBBERY."</td>";
         echo "<td>".$crime->BURGLARY."</td>";
         echo "<td>".$crime->THEFT."</td>";
         echo "<td>".$crime->{'AUTO THEFT'}."</td>";
         echo "<td>".$crime->{'OTHER THEFT'}."</td>";
         echo "<td>".$crime->RIOTS."</td>";
         echo "<td>".$crime->{'CRIMINAL BREACH OF TRUST'}."</td>";
         echo "<td>".$crime->CHEATING."</td>";
         echo "<td>".$crime->COUNTERFIETING."</td>";
         echo "<td>".$crime->ARSON."</td>";
         echo "<td>".$crime->{'HURT/GREVIOUS HURT'}."</td>";
         echo "<td>".$crime->{'OWRY DEATHS'}."</td>";
         echo "<td>".$crime->{'ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY'}."</td>";
         echo "<td>".$crime->{'INSULT TO MODESTY OF WOMEN'}."</td>";
         echo "<td>".$crime->{'CRUELTY BY HUSBAND OR HIS RELATIVES'}."</td>";
         echo "<td>".$crime->{'IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES'}."</td>";
         echo "<td>".$crime->{'CAUSING DEATH BY NEGLIGENCE'}."</td>";
         echo "<td>".$crime->{'OTHER IPC CRIMES'}."</td>";
         echo "<td>".$crime->{'TOTAL IPC CRIMES'}."</td>";
         echo "<td>";
         echo "<a href='edit.php?id=".$crime->_id."' class='btn btn-primary'>Edit</a>";
         echo "<a href='delete.php?id=".$crime->_id."' class='btn btn-danger'>Delete</a>";
         echo "</td>";
         echo "</tr>";
      };


   ?>
</table>
</div>


</body>
</html>