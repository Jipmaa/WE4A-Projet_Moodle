<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Connection;

class GetUserController extends AbstractController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    #[Route('/fetch-user', name: 'fetch_user', methods: ['POST'])]

    public function fetchUser(Request $request): JsonResponse
    {
        // Récupérer les données envoyées par AJAX
        $input = json_decode($request->getContent(), true);
        $id = $input['id'] ?? null;
        $type = $input['type'] ?? null;
        $role = $input['role'] ?? null;

        if (!$id || !$type || !$role) {
            return new JsonResponse(['error' => 'Données POST manquantes']);
        }

        try {
            if ($type === "utilisateurs") {
                if ($role === "student") {
                    $stmt = $this->connection->prepare("SELECT * FROM student WHERE id = :id");
                } elseif ($role === "teacher") {
                    $stmt = $this->connection->prepare("SELECT * FROM teacher WHERE id = :id");
                } else {
                    $stmt = $this->connection->prepare("SELECT * FROM employee WHERE id = :id");
                }
            } elseif ($type === "ue") {
                $stmt = $this->connection->prepare("SELECT * FROM ue WHERE id = :id");
            } else {
                return new JsonResponse(['error' => 'Type non valide']);
            }

            $stmt->bindValue('id', $id);
            $stmt->execute();
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($data) {
                return new JsonResponse($data);
            } else {
                return new JsonResponse(['error' => 'Aucun élément trouvé pour cet ID']);
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur de connexion : ' . $e->getMessage()]);
        }
    }
}


