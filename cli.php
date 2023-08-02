<?php

use GeekBrains\LT\Blog\Command\CreateUserCommand;
use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;
use GeekBrains\LT\Blog\Repositories\InMemoryUserRepository;
use GeekBrains\LT\Blog\User as User;
use GeekBrains\LT\Blog\UUID;
use GeekBrains\LT\Person\Person as Person;
use GeekBrains\LT\Person\Name as Name;
use GeekBrains\LT\Blog\Post;
use GeekBrains\LT\Blog\Repositories\UsersRepository\SqliteUsersRepository;


include __DIR__ . "/vendor/autoload.php";
$faker = Faker\Factory::create('ru_RU');
$gender = 'male';

//объект подключения SQLite
$connection = new PDO("sqlite:blog.db");

//создаем объект репозитория
$usersRepository = new SqliteUsersRepository($connection);

//Добавляем в репозиторий несколько пользователей
//$usersRepository->save(new User(UUID::random(), new Name('Alla', 'Nik'), 'CW'));

$command = new CreateUserCommand($usersRepository);

try {
    // $usersRepository->save(
    //     new User(
    //         UUID::random(),
    //         new Name($faker->firstName($gender), $faker->lastName($gender)),
    //         $faker->email()
    //     )

    // );
    //echo $usersRepository->getByLogin('izabella.konstantinov@mail.ru');
    $command->handle($argv);
} catch (Exception $th) {
    echo $th->getMessage();
}



// $faker = Faker\Factory::create('ru_RU');
// echo $faker->name() . PHP_EOL;

// $name = new Name('Peter', 'Sidorov');
// $user = new User(1, $name, "Wens");
// $name2 = new Name('Ivan', 'Sokolov');
// $user2 = new User(2, $name, "admin");

// echo $user;


// $person = new Person($name, new DateTimeImmutable());

// $post = new Post(1, $user, 'Hello');

// echo $post;

// $userRepos = new InMemoryUserRepository();

// $userRepos->save($user);
// $userRepos->save($user2);

// try {
//     echo $userRepos->get(1);
//     echo $userRepos->get(2);
//     echo $userRepos->get(3);
// } catch (UserNotFoundExeption $e) {
//     echo $e->getMessage();
// } catch (Exception $e) {
//     echo "Cho to ne to";
//     echo $e->getMessage();
// }