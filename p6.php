<!doctype html>
<html>
<head>
	<title>Search</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href ="p.css">
        <em><h1><strong>DICTIONARY</strong></h1></em>
</head>
<body>
<em>
<p>
<form action="p6.php" method="get">
<b>Word: </b><input class="sbox" type="text" name="query" placeholder="type your word" >
<input type="submit" value="submit">
</form>
</p>
<section>
<p>
<?php
$search=$_GET['query'];
$link = mysqli_connect("localhost", "nitish", "Nitish@123" , "dictionary");
$sql="select * from eword where word='$search'";
$result= $link->query($sql);
if (mysqli_num_rows($result) > 0) {
    echo "<h2>WORD: " . "$search"."<br></h2>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "(".$row["syllable"].")"."    (".$row["pro"].")<hr>";
        
    }
} else {}
?>
</p>
<?php
$sql="select * from eword inner join detail on eword.id=detail.id where eword.word='$search'";
$result= $link->query($sql);
if (mysqli_num_rows($result) > 0) {
   $i=1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "Meaning $i: "."(".$row["pos"].")" . $row["meaning"]. "<br><br>";
        echo "Example :". $row["example"]."<br><br>";
        $i++;
        $a=$row["id"];
        $b=$row["pos"];
        $sql2=" select * from synant where id=$a and pos='$b'";
        $result2= $link->query($sql2);
        $result3= $link->query($sql2);
        if (mysqli_num_rows($result2) > 0) {
        echo "Synonym: ";
        while($row2 = mysqli_fetch_assoc($result2)){
        $sy=$row2["synonym"];
        if($sy==NULL){
        continue;}
        echo "<a href='p6.php?query=$sy'>".$sy."</a>".",";
        }
        echo "<br><br>Antonym: ";
        while($row3 = mysqli_fetch_assoc($result3)){
        $an=$row3["antonym"];
        if($an==NULL){
        continue;}
        echo "<a href='p6.php?query=$an'>".$an."</a>".",";
        }
        }else{}
        echo "<br><br>"."<hr>";
    }    
} 
else {
}

$sql3="select * from language where id=$a";
$result4=$link->query($sql3);
if(mysqli_num_rows($result4)>0){
echo "IN OTHER LANGUAGE <br><br>";
while($row4=mysqli_fetch_assoc($result4)){
echo "Hindi: ".$row4["hindi"]."<br><br>"."Marathi: ".$row4["marathi"]."<br>"."Telugu: ".$row4["telugu"]."<br>";
}}
else{}
?>
</section>
<aside>
<?php
$sql="select * from image where id=$a";
$result=$link->query($sql);
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
if($row["scname"]!=NULL){
echo "scientific name: ".$row["scname"]."<br><hr>";
}
?>
<img class="image" src="data:image/jpeg;charset=utf8;base64,<?php echo base64_encode($row['img']);  ?>"style="width:250px;height:250px;" />
<?php
}}
else{}
mysqli_close($link);
?>
</aside>
</div>
</em>
</body>
</head>
</html>
