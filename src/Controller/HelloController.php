<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\UserProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HelloController extends AbstractController {
  private array $messages = [
    ['message' => 'Hello', 'created' => '2023/12/12'],
    ['message' => 'Hi', 'created' => '2023/08/12'],
    ['message' => 'Bye!', 'created' => '2022/10/12']
  ];
  #[Route('/', name: 'app_index')]
  public function index(UserProfileRepository $profiles, EntityManagerInterface $entityManager): Response {
//    $user = new User();
//    $user->setEmail('email@test.com');
//    $user->setPassword('12345678');
//
//    $profile = new UserProfile();
//    $profile->setUser($user);
//    $entityManager->persist($profile);
//    $entityManager->flush();


      $profile = $profiles->find(2);
      $entityManager->remove($profile);
      $entityManager->flush();

    return $this->render(
      'hello/index.html.twig',
      [
        'messages' => $this->messages,
        'limit' => 3
      ]
    );
  }

  #[Route('/messages/{id<\d+>}', name:'app_show_one')]
  public function showOne(int $id):Response {
    return $this->render(
      'hello/show_one.html.twig',
      [
        'message' => $this->messages[$id]
      ]
    );
  }
}
