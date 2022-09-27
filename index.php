
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

function generateRandomUserList($size){

    $users = array();

    for($x = 0; $x < $size ; $x ++){
        array_push($users, generateRandomUser());
    }
    return $users;
}

//Add User Function
function addUser($users, $newUser){
    if(!isset($newUser['username'])){
        return "Username is required";

    }else if(!isset($newUser['password'])){
        return "Password is required";

    }else if(isset($newUser['password']) && strlen($newUser['password']) < 6){
        return "Password must be 6 digits";

    }else{
        array_push($users,$newUser);
        return $users;
    }

}

//Update User Function
function updateUser($users, $updateUser, $username){

    for($i = 0; $i< count($users); $i++){
        if(isset($username) && $users[$i]['username'] === $username){
            $users[$i] = $updateUser;
        }
    }
    return $users;

}


//Delete User Function
function deleteUser($users, $username){

    $newArray = array();

    foreach($users as $user){
        if(isset($username) && $user['username'] !== $username){
            array_push($newArray,$user);
        }
    }
    return $newArray;
}

//User List 
$userList = generateRandomUserList(10);

//Add New User 'Aung Aung'
$newUser = [
    "username" => "Aung Aung",
    "email" => "aung@gmail.com",
    "password" => "aungaung",
    "status" => true
];
$userList = addUser($userList,$newUser );

//Update user with username 'Aung Aung'
$updateUser = [
    "username" => "Mg Mg",
    "email" => "mg@gmail.com",
    "password" => "mgmg1234",
    "status" => true  
];
$userList = updateUser($userList,$updateUser,'Aung Aung');

//Add New User 'Aung Aung' again
$newUser = [
    "username" => "Aung Aung",
    "email" => "aung@gmail.com",
    "password" => "aungaung",
    "status" => true
];
$userList = addUser($userList,$newUser );

//Delete User with username 'Aung Aung'
$userList = deleteUser($userList,'Aung Aung');


?>

<html>
    <head>
        <title>Php Test</title>
    </head>
    <body>
        <ul>
            <h3>Users List</h3>
            <?php foreach($userList as $key => $user) { ?>
               <?php if($user['status'] === true) { ?>
                    <li>Array Index : <?php echo ($key + 1) ?> </li>
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