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
                'MURDER' => ['$sum' => '$MURDER'],
                'ATTEMPT TO MURDER' => ['$sum' => '$ATTEMPT TO MURDER']
            ]
        ]
    ])->toArray() );
    $summaries = array();
    // var_dump(sizeof($summary[0])); die();
    foreach($summary[0] as $s){
        $summaries[$s['_id']['state']][$s['_id']['year']] = array(
            'MURDER' => $s['MURDER'],
            'ATTEMPT TO MURDER' => $s['ATTEMPT TO MURDER']
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
    <h2>Summary Murder Every District</h2>
    <table>
	<tr>
        <th>State</th>
        <th>Year</th>
        <th>Murder</th>
        <th>Attempt to Murder</th>
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
                echo "<td>".$yeardata['MURDER']."</td>";
                echo "<td>".$yeardata['ATTEMPT TO MURDER']. "</td>";
                echo "</tr>";
            }
        }
    ?>
    </table>
</body>
</html>