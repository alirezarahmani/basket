<?php

namespace App\Controller;

use App\Domain\User;
use App\Repository\UserRepository;
use App\Service\ItemService;
use App\ValueObject\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private ItemService $itemService)
    {
    }

    #[Route('/basket/add/{id}', name: 'basket_add')]
    public function index(Request $request, int $id): Response
    {
        # because we do not implement auth we do it manually here!
        /** @var User $user */
        $user = $this->userRepository->findOneByEmail(new Email('test@test.com'));
        try {
            $this->itemService->updateItem(
                $user->getBasket(),
                $id,
                $request->get('count', 1)
            );
            return $this->redirectToRoute('home');
        } catch (\InvalidArgumentException $invalidArgumentException) {
            return $this->redirectToRoute('home', ['error' => $invalidArgumentException->getMessage()]);
        }
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    #[Route('/basket/remove/{id}', name: 'basket')]
    public function remove(Request $request, int $id): Response
    {
        # because we do not implement auth we do it manually here!
        /** @var User $user */
        $user = $this->userRepository->findOneByEmail(new Email('test@test.com'));
        try {
            $this->itemService->remove(
                $user->getBasket(),
                $id,
                $request->get('count', 1)
            );
            return $this->redirectToRoute('home');
        } catch (\InvalidArgumentException $invalidArgumentException) {
            return $this->redirectToRoute('home', ['error' => $invalidArgumentException->getMessage()]);
        }
    }
}
