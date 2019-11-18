<?php


session_start();


require 'config.php';


if (isset($_GET['id'])) {
   $crime = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}


if(isset($_POST['submit'])){


   $collection->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' => ['STATE/UT' => $_POST['STATE/UT'], 'DISTRICT' => $_POST['DISTRICT'],]]
   );


   $_SESSION['success'] = "Crime updated successfully";
   header("Location: index.php");
}


?>


<!DOCTYPE html>
<html>
<head>
   <title>CRUD MONGODB</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>


<div class="container">
   <h1>EDIT BOOK</h1>
   <a href="index.php" class="btn btn-primary">Back</a>


   <form method="POST">
      <div class="form-group">
         <strong>STATE/UT:</strong>
         <input type="text" name="STATE/UT" value="<?php echo $crime->{'STATE/UT'}; ?>" required="" class="form-control" placeholder="STATE/UT">
      </div>
      <div class="form-group">
         <strong>DISTRICT:</strong>
         <input type="text" class="form-control" name="DISTRICT" placeholder="DISTRICT" value="<?php echo $crime->DISTRICT; ?>"></input>
      </div>
      <div class="form-group">
         <strong>YEAR:</strong>
         <input type="number" class="form-control" name="YEAR" placeholder="YEAR" value="<?php echo $crime->YEAR; ?>"></input>
      </div>
      <div class="form-group">
         <strong>MURDER:</strong>
         <input type="number" class="form-control" name="MURDER" placeholder="MURDER" value="<?php echo $crime->MURDER; ?>"></input>
      </div>
      <div class="form-group">
         <strong>ATTEMPT TO MURDER:</strong>
         <input type="number" class="form-control" name="ATTEMPT TO MURDER" placeholder="ATTEMPT TO MURDER" value="<?php echo $crime->{'ATTEMPT TO MURDER'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CULPABLE HOMICIDE NOT AMOUNTING TO MURDER:</strong>
         <input type="number" class="form-control" name="CULPABLE HOMICIDE NOT AMOUNTING TO MURDER" placeholder="CULPABLE HOMICIDE NOT AMOUNTING TO MURDER" value="<?php echo $crime->{'CULPABLE HOMICIDE NOT AMOUNTING TO MURDER'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>RAPE:</strong>
         <input type="number" class="form-control" name="RAPE" placeholder="RAPE" value="<?php echo $crime->RAPE; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CUSTODIAL RAPE:</strong>
         <input type="number" class="form-control" name="CUSTODIAL RAPE" placeholder="CUSTODIAL RAPE" value="<?php echo $crime->{'CUSTODIAL RAPE'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>OTHER RAPE:</strong>
         <input type="number" class="form-control" name="OTHER RAPE" placeholder="OTHER RAPE" value="<?php echo $crime->{'OTHER RAPE'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING & ABDUCTION:</strong>
         <input type="number" class="form-control" name="KIDNAPPING & ABDUCTION" placeholder="KIDNAPPING & ABDUCTION" value="<?php echo $crime->{'KIDNAPPING & ABDUCTION'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS:</strong>
         <input type="number" class="form-control" name="KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS" placeholder="KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS" value="<?php echo $crime->{'KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING AND ABDUCTION OF OTHERS:</strong>
         <input type="number" class="form-control" name="KIDNAPPING AND ABDUCTION OF OTHERS" placeholder="KIDNAPPING AND ABDUCTION OF OTHERS" value="<?php echo $crime->{'KIDNAPPING AND ABDUCTION OF OTHERS'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>DACOITY:</strong>
         <input type="number" class="form-control" name="DACOITY" placeholder="DACOITY" value="<?php echo $crime->DACOITY; ?>"></input>
      </div>
      <div class="form-group">
         <strong>PREPARATION AND ASSEMBLY FOR DACOITY:</strong>
         <input type="number" class="form-control" name="PREPARATION AND ASSEMBLY FOR DACOITY" placeholder="PREPARATION AND ASSEMBLY FOR DACOITY" value="<?php echo $crime->{'PREPARATION AND ASSEMBLY FOR DACOITY'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>ROBBERY:</strong>
         <input type="number" class="form-control" name="ROBBERY" placeholder="ROBBERY" value="<?php echo $crime->ROBBERY; ?>"></input>
      </div>
      <div class="form-group">
         <strong>BURGLARY:</strong>
         <input type="number" class="form-control" name="BURGLARY" placeholder="BURGLARY" value="<?php echo $crime->BURGLARY; ?>"></input>
      </div>
      <div class="form-group">
         <strong>THEFT:</strong>
         <input type="number" class="form-control" name="THEFT" placeholder="THEFT" value="<?php echo $crime->THEFT; ?>"></input>
      </div>
      <div class="form-group">
         <strong>AUTO THEFT:</strong>
         <input type="number" class="form-control" name="AUTO THEFT" placeholder="AUTO THEFT" value="<?php echo $crime->{'AUTO THEFT'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>OTHER THEFT:</strong>
         <input type="number" class="form-control" name="OTHER THEFT" placeholder="OTHER THEFT" value="<?php echo $crime->{'OTHER THEFT'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>RIOTS:</strong>
         <input type="number" class="form-control" name="RIOTS" placeholder="RIOTS" value="<?php echo $crime->RIOTS; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CRIMINAL BREACH OF TRUST:</strong>
         <input type="number" class="form-control" name="CRIMINAL BREACH OF TRUST" placeholder="CRIMINAL BREACH OF TRUST" value="<?php echo $crime->{'CRIMINAL BREACH OF TRUST'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CHEATING:</strong>
         <input type="number" class="form-control" name="CHEATING" placeholder="CHEATING" value="<?php echo $crime->CHEATING; ?>"></input>
      </div>
      <div class="form-group">
         <strong>COUNTERFIETING:</strong>
         <input type="number" class="form-control" name="COUNTERFIETING" placeholder="COUNTERFIETING" value="<?php echo $crime->COUNTERFIETING; ?>"></input>
      </div>
      <div class="form-group">
         <strong>ARSON:</strong>
         <input type="number" class="form-control" name="ARSON" placeholder="ARSON" value="<?php echo $crime->ARSON; ?>"></input>
      </div>
      <div class="form-group">
         <strong>HURT/GREVIOUS HURT:</strong>
         <input type="number" class="form-control" name="HURT/GREVIOUS HURT" placeholder="HURT/GREVIOUS HURT" value="<?php echo $crime->{'HURT/GREVIOUS HURT'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>DOWRY DEATHS:</strong>
         <input type="number" class="form-control" name="DOWRY DEATHS" placeholder="DOWRY DEATHS" value="<?php echo $crime->{'DOWRY DEATHS'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY:</strong>
         <input type="number" class="form-control" name="ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY" placeholder="ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY" value="<?php echo $crime->{'ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>INSULT TO MODESTY OF WOMEN:</strong>
         <input type="number" class="form-control" name="INSULT TO MODESTY OF WOMEN" placeholder="INSULT TO MODESTY OF WOMEN" value="<?php echo $crime->{'INSULT TO MODESTY OF WOMEN'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CRUELTY BY HUSBAND OR HIS RELATIVES:</strong>
         <input type="number" class="form-control" name="CRUELTY BY HUSBAND OR HIS RELATIVES" placeholder="CRUELTY BY HUSBAND OR HIS RELATIVES" value="<?php echo $crime->{'CRUELTY BY HUSBAND OR HIS RELATIVES'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES:</strong>
         <input type="number" class="form-control" name="IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES" placeholder="IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES" value="<?php echo $crime->{'IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>CAUSING DEATH BY NEGLIGENCE:</strong>
         <input type="number" class="form-control" name="CAUSING DEATH BY NEGLIGENCE" placeholder="CAUSING DEATH BY NEGLIGENCE" value="<?php echo $crime->{'CAUSING DEATH BY NEGLIGENCE'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>OTHER IPC CRIMES:</strong>
         <input type="number" class="form-control" name="OTHER IPC CRIMES" placeholder="OTHER IPC CRIMES" value="<?php echo $crime->{'OTHER IPC CRIMES'}; ?>"></input>
      </div>
      <div class="form-group">
         <strong>TOTAL IPC CRIMES:</strong>
         <input type="number" class="form-control" name="TOTAL IPC CRIMES" placeholder="TOTAL IPC CRIMES" value="<?php echo $crime->{'TOTAL IPC CRIMES'}; ?>"></input>
      </div>

      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
   </form>
</div>


</body>
</html>