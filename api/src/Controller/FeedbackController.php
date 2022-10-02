<?php

namespace App\Controller;

use App\Entity\Feedback;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedbackController extends AbstractController
{
    #[Route('/feedback', methods: 'GET')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/FeedbackController.php',
        ]);
    }

    #[Route('/feedback', methods: 'POST')]
    public function store(
        Request $request,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
    ): JsonResponse {
        $feedback = new Feedback();
        
        $feedback->setName(htmlentities($request->request->get('name')));
        $feedback->setPhone((int) $request->request->get('phone'));
        $feedback->setIp($request->server->get('REMOTE_ADDR'));
        $feedback->setCreatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($feedback);
        if ($errors->count() > 0) {
            $messages = [];
            foreach ($errors->getIterator() as $error) {
                $messages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $messages]);
        }

        $manager = $doctrine->getManager();
        $manager->persist($feedback);
        $manager->flush();

        return new JsonResponse($feedback->getNamePhoneAndCreatedAt());
    }
}
