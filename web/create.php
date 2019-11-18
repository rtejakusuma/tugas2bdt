<?php


session_start();


if(isset($_POST['submit'])){


   require 'config.php';


   $insertOneResult = $collection->insertOne([
       'STATE/UT' => $_POST['STATE/UT'],
       'DISTRICT' => $_POST['DISTRICT'],
       'YEAR' => $_POST['YEAR'],
       'MURDER' => $_POST['MURDER'],
       'ATTEMPT TO MURDER' => $_POST['ATTEMPT TO MURDER'],
       'CULPABLE HOMICIDE NOT AMOUNTING TO MURDER' => $_POST['CULPABLE HOMICIDE NOT AMOUNTING TO MURDER'],
       'RAPE' => $_POST['RAPE'],
       'CUSTODIAL RAPE' => $_POST['CUSTODIAL RAPE'],
       'OTHER RAPE' => $_POST['OTHER RAPE'],
       'KIDNAPPING & ABDUCTION' => $_POST['KIDNAPPING & ABDUCTION'],
       'KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS' => $_POST['KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS'],
       'KIDNAPPING AND ABDUCTION OF OTHERS' => $_POST['KIDNAPPING AND ABDUCTION OF OTHERS'],
       'DACOITY' => $_POST['DACOITY'],
       'PREPARATION AND ASSEMBLY FOR DACOITY' => $_POST['PREPARATION AND ASSEMBLY FOR DACOITY'],
       'ROBBERY' => $_POST['ROBBERY'],
       'BURGLARY' => $_POST['BURGLARY'],
       'THEFT' => $_POST['THEFT'],
       'AUTO THEFT' => $_POST['AUTO THEFT'],
       'OTHER THEFT' => $_POST['OTHER THEFT'],
       'RIOTS' => $_POST['RIOTS'],
       'CRIMINAL BREACH OF TRUST' => $_POST['CRIMINAL BREACH OF TRUST'],
       'CHEATING' => $_POST['CHEATING'],
       'COUNTERFIETING' => $_POST['COUNTERFIETING'],
       'ARSON' => $_POST['ARSON'],
       'HURT/GREVIOUS HURT' => $_POST['HURT/GREVIOUS HURT'],
       'DOWRY DEATHS' => $_POST['DOWRY DEATHS'],
       'ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY' => $_POST['ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY'],
       'INSULT TO MODESTY OF WOMEN' => $_POST['INSULT TO MODESTY OF WOMEN'],
       'CRUELTY BY HUSBAND OR HIS RELATIVES' => $_POST['CRUELTY BY HUSBAND OR HIS RELATIVES'],
       'IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES' => $_POST['IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES'],
       'CAUSING DEATH BY NEGLIGENCE' => $_POST['CAUSING DEATH BY NEGLIGENCE'],
       'OTHER IPC CRIMES' => $_POST['OTHER IPC CRIMES'],
       'TOTAL IPC CRIMES' => $_POST['TOTAL IPC CRIMES'],
   ]);


   $_SESSION['success'] = "Crime created successfully";
   header("Location: index.php");
}


?>


<!DOCTYPE html>
<html>
<head>
   <title>PHP & MongoDB - CRUD Operation Tutorials - ItSolutionStuff.com</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>


<div class="container">
   <h1>Create Book</h1>
   <a href="index.php" class="btn btn-primary">Back</a>


   <form method="POST">
      <div class="form-group">
         <strong>STATE/UT:</strong>
         <input type="text" name="STATE/UT" required="" class="form-control" placeholder="STATE/UT">
      </div>
      <div class="form-group">
         <strong>DISTRICT:</strong>
         <input type="text" class="form-control" name="DISTRICT" placeholder="DISTRICT"></input>
      </div>
      <div class="form-group">
         <strong>YEAR:</strong>
         <input type="number" class="form-control" name="YEAR" placeholder="YEAR"></input>
      </div>
      <div class="form-group">
         <strong>ATTEMPT TO MURDER:</strong>
         <input type="number" class="form-control" name="ATTEMPT TO MURDER" placeholder="ATTEMPT TO MURDER"></input>
      </div>
      <div class="form-group">
         <strong>CULPABLE HOMICIDE NOT AMOUNTING TO MURDER:</strong>
         <input type="number" class="form-control" name="CULPABLE HOMICIDE NOT AMOUNTING TO MURDER" placeholder="CULPABLE HOMICIDE NOT AMOUNTING TO MURDER"></input>
      </div>
      <div class="form-group">
         <strong>RAPE:</strong>
         <input type="number" class="form-control" name="RAPE" placeholder="RAPE"></input>
      </div>
      <div class="form-group">
         <strong>CUSTODIAL RAPE:</strong>
         <input type="number" class="form-control" name="CUSTODIAL RAPE" placeholder="CUSTODIAL RAPE"></input>
      </div>
      <div class="form-group">
         <strong>OTHER RAPE:</strong>
         <input type="number" class="form-control" name="OTHER RAPE" placeholder="OTHER RAPE"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING & ABDUCTION:</strong>
         <input type="number" class="form-control" name="KIDNAPPING & ABDUCTION" placeholder="KIDNAPPING & ABDUCTION"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS:</strong>
         <input type="number" class="form-control" name="KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS" placeholder="KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS"></input>
      </div>
      <div class="form-group">
         <strong>KIDNAPPING AND ABDUCTION OF OTHERS:</strong>
         <input type="number" class="form-control" name="KIDNAPPING AND ABDUCTION OF OTHERS" placeholder="KIDNAPPING AND ABDUCTION OF OTHERS"></input>
      </div>
      <div class="form-group">
         <strong>DACOITY:</strong>
         <input type="number" class="form-control" name="DACOITY" placeholder="DACOITY"></input>
      </div>
      <div class="form-group">
         <strong>PREPARATION AND ASSEMBLY FOR DACOITY:</strong>
         <input type="number" class="form-control" name="PREPARATION AND ASSEMBLY FOR DACOITY" placeholder="PREPARATION AND ASSEMBLY FOR DACOITY"></input>
      </div>
      <div class="form-group">
         <strong>ROBBERY:</strong>
         <input type="number" class="form-control" name="ROBBERY" placeholder="ROBBERY"></input>
      </div>
      <div class="form-group">
         <strong>BURGLARY:</strong>
         <input type="number" class="form-control" name="BURGLARY" placeholder="BURGLARY"></input>
      </div>
      <div class="form-group">
         <strong>THEFT:</strong>
         <input type="number" class="form-control" name="THEFT" placeholder="THEFT"></input>
      </div>
      <div class="form-group">
         <strong>AUTO THEFT:</strong>
         <input type="number" class="form-control" name="AUTO THEFT" placeholder="AUTO THEFT"></input>
      </div>
      <div class="form-group">
         <strong>OTHER THEFT:</strong>
         <input type="number" class="form-control" name="OTHER THEFT" placeholder="OTHER THEFT"></input>
      </div>
      <div class="form-group">
         <strong>RIOTS:</strong>
         <input type="number" class="form-control" name="RIOTS" placeholder="RIOTS"></input>
      </div>
      <div class="form-group">
         <strong>CRIMINAL BREACH OF TRUST:</strong>
         <input type="number" class="form-control" name="CRIMINAL BREACH OF TRUST" placeholder="CRIMINAL BREACH OF TRUST"></input>
      </div>
      <div class="form-group">
         <strong>CHEATING:</strong>
         <input type="number" class="form-control" name="CHEATING" placeholder="CHEATING"></input>
      </div>
      <div class="form-group">
         <strong>COUNTERFIETING:</strong>
         <input type="number" class="form-control" name="COUNTERFIETING" placeholder="COUNTERFIETING"></input>
      </div>
      <div class="form-group">
         <strong>ARSON:</strong>
         <input type="number" class="form-control" name="ARSON" placeholder="ARSON"></input>
      </div>
      <div class="form-group">
         <strong>HURT/GREVIOUS HURT:</strong>
         <input type="number" class="form-control" name="HURT/GREVIOUS HURT" placeholder="HURT/GREVIOUS HURT"></input>
      </div>
      <div class="form-group">
         <strong>DOWRY DEATHS:</strong>
         <input type="number" class="form-control" name="DOWRY DEATHS" placeholder="DOWRY DEATHS"></input>
      </div>
      <div class="form-group">
         <strong>ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY:</strong>
         <input type="number" class="form-control" name="ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY" placeholder="ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY"></input>
      </div>
      <div class="form-group">
         <strong>INSULT TO MODESTY OF WOMEN:</strong>
         <input type="number" class="form-control" name="INSULT TO MODESTY OF WOMEN" placeholder="INSULT TO MODESTY OF WOMEN"></input>
      </div>
      <div class="form-group">
         <strong>CRUELTY BY HUSBAND OR HIS RELATIVES:</strong>
         <input type="number" class="form-control" name="CRUELTY BY HUSBAND OR HIS RELATIVES" placeholder="CRUELTY BY HUSBAND OR HIS RELATIVES"></input>
      </div>
      <div class="form-group">
         <strong>IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES:</strong>
         <input type="number" class="form-control" name="IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES" placeholder="IMPORTATION OF GIRLS FROM FOREIGN COUNTRIES"></input>
      </div>
      <div class="form-group">
         <strong>CAUSING DEATH BY NEGLIGENCE:</strong>
         <input type="number" class="form-control" name="CAUSING DEATH BY NEGLIGENCE" placeholder="CAUSING DEATH BY NEGLIGENCE"></input>
      </div>
      <div class="form-group">
         <strong>OTHER IPC CRIMES:</strong>
         <input type="number" class="form-control" name="OTHER IPC CRIMES" placeholder="OTHER IPC CRIMES"></input>
      </div>
      <div class="form-group">
         <strong>TOTAL IPC CRIMES:</strong>
         <input type="number" class="form-control" name="TOTAL IPC CRIMES" placeholder="TOTAL IPC CRIMES"></input>
      </div>
      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
   </form>
</div>


</body>
</html>