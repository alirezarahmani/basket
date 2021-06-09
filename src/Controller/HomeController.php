<?php

namespace App\Controller;

use App\Domain\User;
use App\Repository\ItemRepository;
use App\Repository\UserRepository;
use App\ValueObject\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private ItemRepository $itemRepository, private UserRepository $userRepository)
    {
    }

    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        $user = $this->userRepository->findOneByEmail(new Email('test@test.com'));
        # because we do not implement auth we do it manually here!
        $items = $this->itemRepository->findByBasket($user->getBasket());
        return $this->render('home.html.twig', [
            'items' => $items,
            'error' => $request->get('error')
        ]);
    }
}
