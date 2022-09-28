
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
    if(!isset($updateUser['username'])){
        return "Username is required";

    }else if(!isset($updateUser['password'])){
        return "Password is required";

    }else if(isset($updateUser['password']) && strlen($updateUser['password']) < 6){
        echo "Password must be 6 digits";
        return;

    }else{
        for($i = 0; $i< count($users); $i++){
            if(isset($username) && $users[$i]['username'] === $username){
                $users[$i] = $updateUser;
            }
        }
        return $users;
    }
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
    "password" => "mgmg34",
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
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">    
    </head>
    <body>
        <ul>
            <h3>Users List</h3>
            <div class='container'>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($userList as $key => $user) { ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['password'] ?> </td>
                            <td>
                                <?php if($user['status'] === true) { ?>
                                    <button type="button" class="btn btn-success">Active</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger">Disable</button>
                                <?php } ?>
                            </td>
                        </tr>
                        
                    <?php } ?>
                    </tbody>
                </table>     
            </div>
            
        </ul>
    </body>
</html>