<?php
    require_once("config.php");
    $data = $collection->find();
    $data = $data->toArray();
    $numOfData = sizeof($data);
    $summary = array();
    array_push($summary, $collection->aggregate([
        [
            '$group' => [
                '_id'   => ['state' => '$STATE/UT', 'year' => '$YEAR'],
                'KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS' => ['$sum' => '$KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS'],
                'ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY' => ['$sum' => '$ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY'],
                'INSULT TO MODESTY OF WOMEN' => ['$sum' => '$INSULT TO MODESTY OF WOMEN'],
                'CRUELTY BY HUSBAND OR HIS RELATIVES' => ['$sum' => '$CRUELTY BY HUSBAND OR HIS RELATIVES']
            ]
        ]
    ])->toArray() );
    $summaries = array();
    // var_dump(sizeof($summary[0])); die();
    foreach($summary[0] as $s){
        $summaries[$s['_id']['state']][$s['_id']['year']] = array(
            'KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS' => $s['KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS'],
            'ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY' => $s['ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY'],
            'INSULT TO MODESTY OF WOMEN' => $s['INSULT TO MODESTY OF WOMEN'],
            'CRUELTY BY HUSBAND OR HIS RELATIVES' => $s['CRUELTY BY HUSBAND OR HIS RELATIVES'],
        );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD MONGODB</title>
    <style>
        th,td{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2>Harrasment of Women</h2>
    <table>
	<tr>
        <th>State</th>
        <th>Year</th>
        <th>Kidnapping and Abduction of Women and Girls</th>
        <th>Assault on Women with Intent to Outrage Her Modesty</th>
        <td>Insult to Modesty of Women</th>
        <th>Cruel by Husband or His Relatives</th>
    </tr>
    <?php
        foreach($summaries as $statekey => $statedata){
            $flag = 0;
            echo "<tr>";
            echo "<td rowspan='".strval(sizeof($statedata)+1)."'>$statekey</td>";
                    
            foreach($statedata as $yearkey => $yeardata){
                // var_dump($yeardata); die();
                if($flag == 0){
                    echo "</tr>";
                    $flag = 1;
                }        
                echo "<tr>";
                echo "<td>$yearkey</td>";
                echo "<td>".$yeardata['KIDNAPPING AND ABDUCTION OF WOMEN AND GIRLS']."</td>";
                echo "<td>".$yeardata['ASSAULT ON WOMEN WITH INTENT TO OUTRAGE HER MODESTY']. "</td>";
                echo "<td>".$yeardata['INSULT TO MODESTY OF WOMEN']. "</td>";
                echo "<td>".$yeardata['CRUELTY BY HUSBAND OR HIS RELATIVES']. "</td>";
                echo "</tr>";
            }
        }
    ?>
    </table>
</body>
</html>