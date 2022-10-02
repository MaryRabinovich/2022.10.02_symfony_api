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

    // #[Route('/feedback', methods: 'POST')]
    #[Route('/feedback/add', methods: 'GET')]
    public function store(
        Request $request,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
    ): JsonResponse {
        $feedback = new Feedback();

        // $feedback->setName(
            // htmlentities($request->request->get('name'))
        // );
        // $feedback->setPhone((int) $request->request->get('phone'));
        $feedback->setName(
            htmlentities($request->query->get('name'))
        );
        $feedback->setPhone((int) $request->query->get('phone'));

        $feedback->setIp($request->server->get('REMOTE_ADDR'));
        $feedback->setCreatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($feedback);

        if (count($errors) > 0) {
            return new JsonResponse([
                'errors' => (string) $errors
            ]);
        }

        $manager = $doctrine->getManager();
        $manager->persist($feedback);
        $manager->flush();

        return new JsonResponse([
            'id' => $feedback->getId(),
            'name' => $feedback->getName(),
            'phone' => $feedback->getPhone(),
            'created_at' => $feedback->getCreatedAt()->format('Y/m/d h:i:s')
        ]);

    }
}
