
<?php

function generateRandomUser(){

    $email_type = ['@gmail.com','@hotmail.com','@outlook.com'];
    
    //Random Password
    $password="";
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $passwordLength = rand(6,16);
    for($x =0 ; $x < $passwordLength ; $x ++){
        $password .= $characters[rand(0, strlen($characters)-1 )];
    }
 
    $num = rand(0,1);
    $status = true;
    if($num === 1){
        $status = true;
    }else {
        $status = false;
    }

    $newUser = [
        "username" => generateRandomUserName(),
        "email" => generateRandomWord() . $email_type[rand(0, (count($email_type)-1))],
        "password" => $password,
        "status" => $status
    ];

    return $newUser;

}

function generateRandomWord(){
    $chars = 'abcdefghijklmnopqrstuvwxyz';
    return ucfirst(substr(str_shuffle($chars),0, rand(2,6)));
}

function generateRandomUserName(){
    $time = rand(3,6);
    $username="";
    for($x = 0; $x < $time; $x++ ){
        $username .= (generateRandomWord() . " ");
    }
    return $username;
}

$users = [
    [
        "username" => "Hla Hla",
        "email" => "hlahla@gmail.com",
        "password" => "123456",
        "status" => true    
    ]
];

for($x = 0; $x < 10 ; $x ++){
    array_push($users, generateRandomUser());
}

?>

<html>
    <head>
        <title>Php Test</title>
    </head>
    <body>
        <ul>
            <h3>Users List</h3>
            <?php foreach($users as $key => $user) { ?>
               <?php if($user['status'] === true) { ?>
                    <li>Array Index : <?php echo $key ?> </li>
                    <li>Username : <?php echo $user['username'] ?> </li>
                    <li>Email : <?php echo $user['email'] ?> </li>
                    <li>Password : <?php echo $user['password'] ?> </li>
                    <li>Status : <?php echo $user['status'] ?> </li>
                    <br>
                <?php } else { ?>
                    <li><?php echo "Account is not active" ?> </li> <br>
                <?php } ?>
            <?php } ?>
        </ul>
    </body>
</html>