<?php 
for($i=0; $i<=5;$i++){
	for($j=5-$i;$j>=1;$j--){
		echo "*";
	}
	echo "<br>";
}
echo "------------------------------<br>";
$csmap_data= array(
    array(
        "name" => "Peter Parker",
        "email" => "peterparker@mail.com",
    ),
    array(
        "name" => "Clark Kent",
        "email" => "clarkkent@mail.com",
    ),
    array(
        "name" => "Harry Potter",
        "email" => "harrypotter@mail.com",
    )
);
foreach($csmap_data as $key => $csm)
 {
  $csmap_data[$key]['age'] = '30';
 }
 
$csmap_data = array_map(function($arr){
    return $arr + ['flag' => 1];
}, $csmap_data);

//echo "<pre>"; print_r($csmap_data); die;

	for($i=1;$i<=5;$i++){
        for($j=1;$j<=$i;$j++){
                    echo "*";
        }
        echo "<br />";
	}
	
	echo "----------------------------<br/>";
	
	for($i=5;$i>=1;$i--){
        for($j=1;$j<=$i;$j++){
                    echo "*";
        }
        echo "<br />";
	}
echo "<br />----------------------------<br/>";

$height = 5;
//$i=1;
for($i=1;$i<=$height;$i++){

    for($t = 1;$t <= $height-$i;$t++)
    {
        echo "&nbsp;&nbsp;";
    }

    for($j=1;$j<=$i;$j++)
    {
        // use &nbsp; here to procude space after each asterix
        echo "*&nbsp;&nbsp;";
    }
echo "<br />";
}
echo "<br />----------------------------<br/>";

// pyramid height
$height = 5;
//$i=1;
for($i=1;$i<=$height;$i++){

    for($t = 1;$t <= $height-$i;$t++)
    {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    for($j=1;$j<=$i;$j++)
    {
        // use &nbsp; here to procude space after each asterix
        echo "*&nbsp;&nbsp;";
    }
echo "<br />";
}
echo "<br />----------------------------<br/>";



$height = 5;
for($i=1;$i<=$height;$i++){
    for($j=1;$j<=$i;$j++)
    {
        echo "*&nbsp;&nbsp;";
    }
    for($t = 1;$t <= $height-$i;$t++)
    {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    for($t = 1;$t <= $height-$i;$t++)
    {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    for($j=1;$j<=$i;$j++)
    {
        echo "*&nbsp;&nbsp;";
    }
    echo "<br />";
}


echo "<br />----------------------------<br/>";
create_pyramid("*", 6);

function create_pyramid($string, $level) {
    echo "<pre>";
    $level = $level * 2;
    for($i = 1; $i <= $level; $i ++) {
        if (!($i % 2) && $i != 1)
            continue;   
        print str_pad(str_repeat($string, $i),($level - 1) * strlen($string), " " , STR_PAD_BOTH);
        print PHP_EOL;
    }
}
?>