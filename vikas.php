<html>
<head>
    <style type="text/css">
        pre {
            float: left;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>

<?php
echo '<pre>';
for ($row=0; $row<7; $row++)
{
  for ($column=0; $column<=7; $column++)
    {
          if ((($column == 1 or $column == 5) and $row < 5) or ($row == 6 and $column == 3) or ($row == 5 and ($column == 2 or $column == 4)))
            echo "*";    
        else  
            echo "&nbsp;";     
    }        
  echo "<br />";
}
echo '</pre>';
echo '<pre>';
for ($row = 0; $row < 8; $row++) {
    for ($col = 0; $col <= 8; $col++) {
        if ($col == 4 OR ($row == 0 AND $col > 0 AND $col < 7) OR ($row == 7 AND $col > 0 AND $col < 7)) {
        //if ($col == 4) {
            echo "*";
        } else {
            echo "&nbsp;";
        }
    }
    echo "<br/>";
}
echo '</pre>';



echo '<pre>';
$j = 5;    
$i = 0;  
for ($row=0; $row<=7; $row++)
{
    for ($column=0; $column<=7; $column++)
      {
        if ($column == 1 or (($row == $column + 1) and $column != 0))
            echo "*";   
        else if ($row == $i and $column == $j)
           {  
              echo "*";    
              $i=$i+1;  
              $j=$j-1;
           }
        else
            echo "&nbsp;";   
}    
     echo "<br/>";    
}
echo '</pre>';








echo '<pre>';
for ($row=0; $row<=7; $row++)
{
  for ($column=0; $column<=7; $column++)
    {
        if ((($column == 1 or $column == 5) and $row != 0) or (($row == 0 or $row == 3) and ($column > 1 and $column < 5)))
            echo "*";    
        else  
            echo "&nbsp;";   
    }        
  echo "<br/>";    
}
echo '</pre>';




echo '<pre>';
for ($row=0; $row<8; $row++)
{
  for ($column=0; $column<=8; $column++)
    {
  if ((($row == 0 or $row == 3 or $row == 7) and $column > 1 and $column < 6) or ($column == 1 and ($row == 1 or $row == 2 or $row == 7)) or ($column == 6 and ($row == 0 or $row == 4 or $row == 6)))
            echo "*";    
        else  
            echo "&nbsp;"; 
    }        
  echo "<br/>";    
}
echo '</pre>';
?>


</body>
</html>