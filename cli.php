<?php

use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;
use GeekBrains\LT\Blog\Repositories\InMemoryUserRepository;
use GeekBrains\LT\Blog\User as User;
use GeekBrains\LT\Person\Person as Person;
use GeekBrains\LT\Person\Name as Name;
use GeekBrains\LT\Blog\Post;

include __DIR__ . "/vendor/autoload.php";

// spl_autoload_register("load");
// function load($class)
// {
//     $file = $class . ".php";
//     $file = str_replace("GeekBrains\\LT\\", "src\\", $file);
//     if (file_exists($file)) {
//         include $file;
//     }
// }

$faker = Faker\Factory::create('ru_RU');
echo $faker->name() . PHP_EOL;

$name = new Name('Peter', 'Sidorov');
$user = new User(1, $name, "Wens");
$name2 = new Name('Ivan', 'Sokolov');
$user2 = new User(2, $name, "admin");

echo $user;


$person = new Person($name, new DateTimeImmutable());



$post = new Post(1, $person, 'Hello');

echo $post;

$userRepos = new InMemoryUserRepository();

$userRepos->save($user);
$userRepos->save($user2);

try {
    echo $userRepos->get(1);
    echo $userRepos->get(2);
    echo $userRepos->get(3);
} catch (UserNotFoundExeption $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo "Cho to ne to";
    echo $e->getMessage();
}