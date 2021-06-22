<?php

/* GITHUB API*/

/*END OF GETTING INFO */

$input="";
$sum=-1;
$result="";
if (isset($_POST['submit']))
{
    $input=$_POST['user_in'];
    //for add function
    if(strpos($input, "add")){
        $sum=0;
        $input=explode(" ", $input);
        $input=array_slice($input, 1, sizeof($input));
        foreach($input as $argument)
        {
            $sum+=floatval($argument);
        }
    }

    //for ascending sort function
    else if(strpos($input, "sort-asc"))
    {
        
       
        $input=explode(" ", $input);
        $input=array_slice($input, 1, sizeof($input));
        foreach($input as $arg)
        {
            $arg=floatval($arg);
        }
        sort($input);

        $result=implode(" ",$input);
    }


    //For repo
    //Ex: repo-desc Synthia22 WHC
    else if(strpos($input, "repo-desc"))
    {
        global $desc;
        $owner;
        $repoArg;

        $input=explode(" ", $input);
        $input=array_slice($input, 1, sizeof($input));
        $owner=$input[1];
        $repoArg=$input[2];

        $jsonData=file_get_contents("https://github.com/".$owner."/".$repoArg."/blob/main/README.md");
        $desc= $jsonData;
        $result=implode(" ",$input); 
    }


    
}




?>
<!DOCTYPE html>
<html>
<head>
<title>Index WH</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
<!-- <script src="js/script.js"></script> -->
<style>
    body{
        text-align: center;
        font-family: 'Raleway', sans-serif;
    }
</style>
</head>
<body>

<h1>Welcome!</h1>
 
<form method="POST">
    <label for="user_in">Write a command...</label>
    <br>
    <input type="text" id="user_in" name="user_in" value=" <?php 
    if($sum<0)
    {
    echo $result;
    }
    else 
    {
    echo $sum;
    }
    ?>">
    <br><br>
    <button type="submit" onclick="add()" name="submit" id="submit">Submit</button>
</form>

<div>
    <?php
       if(isset($desc))
       {
           echo $desc;
       }
    ?>
</div>


</body>
</html>
