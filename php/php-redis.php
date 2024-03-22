<?php
    require './vendor-redis/autoload.php';
    $client = new Predis\Client();
    echo $client->ping();

    $entry=$client->get('user');

    if($entry)
    {
        echo "From Redis Cache <br>";
        echo $entry;
        exit();
    }
    else{
        $conn=new  mysqli("localhost","root","","pranav");
        $sql="select username,password from user;";
        $result=$conn->query($sql);
        echo "From Database <br>";
        $temp='';
        while ($row=$result->fetch_assoc()) {
            echo $username=$row['username']."<br>";
            echo $password=$row['password'];
            $temp.=$row['username']. '     ' .$row['password'].'<br>';
        }
        $client->set('user',$temp);
        exit();
}
?>