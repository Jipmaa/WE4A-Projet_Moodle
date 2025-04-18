<?php

// src/Controller/UtilisateursController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Connection;

class UtilisateursController extends AbstractController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    #[Route('/get-all-users', name: 'get_all_users', methods: ['POST'])]
    public function getAllUsers(): JsonResponse
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT id, name, surname, 'teacher' AS role, birthdate, email, phone_number, '' AS department, password
                FROM teacher
                UNION ALL
                SELECT id, name, surname, 'student' AS role, birthdate, email, phone_number, department, password
                FROM student
                UNION ALL
                SELECT id, name, surname, job AS role, birthdate, email, phone_number, '' AS department, password
                FROM employee
            ");
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return new JsonResponse($data);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => "Erreur de connexion ou de requête : " . $e->getMessage()]);
        }
    }
}

