<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Connection;

class EffacerUserController extends AbstractController
    {
    private $connection;

    // Injection de la connexion à la base de données via Doctrine DBAL
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    #[Route('/effacer-user', name: 'effacer_user', methods: ['POST'])]
    public function deleteUser(Request $request): JsonResponse
    {
    // Récupérer les données envoyées par AJAX
        $input = json_decode($request->getContent(), true);
        $id = $input['id'] ?? null;
        $type = $input['type'] ?? null;
        $role = $input['role'] ?? null;

    // Vérifier les données reçues
        if (!$id || !$type || !$role) {
        return new JsonResponse(["error" => "ID, role ou type manquant. (EffacerUserController)"], 400);
    }

    // Supprimer l'entrée dans la base de données en fonction du type
    try {
        if ($type === "utilisateurs") {
            if ($role === "student") {
                $stmt = $this->connection->prepare("DELETE FROM student WHERE id = :id");
            } elseif ($role === "teacher") {
                $stmt = $this->connection->prepare("DELETE FROM teacher WHERE id = :id");
            } else {
                $stmt = $this->connection->prepare("DELETE FROM employee WHERE id = :id");
            }
        } elseif ($type === "ue") {
            $stmt = $this->connection->prepare("DELETE FROM ue WHERE id = :id");
        } else {
            return new JsonResponse(["error" => "Type non valide."]);
        }

        $stmt->bindValue('id', $id);
        $stmt->execute();

// Vérification du succès
        if ($stmt->rowCount() > 0) {
            return new JsonResponse(["success" => true]);
        } else {
            return new JsonResponse(["error" => "Échec de la suppression. ID introuvable."]);
        }
    } catch (\Exception $e) {
        return new JsonResponse(["error" => "Erreur de connexion ou de requête : " . $e->getMessage()]);
        }
    }
}

