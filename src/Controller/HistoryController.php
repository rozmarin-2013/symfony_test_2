<?php

namespace App\Controller;

use App\Services\HistoryService;
use App\Request\CreateHistoryInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractController
{
    public function __construct(private HistoryService $historyService)
    {
    }

    #[Route('/exchange/values', name: 'app_exchange_values_create', methods: 'POST')]
    public function create(
        CreateHistoryInput $input
    ): JsonResponse {

        try {
            $this->historyService->create($input);

            return $this->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return $this->json([
                [
                    'error' => $e->getMessage(),
                    'status' => 'fail'
                ],
                500
            ]);
        }
    }

    #[Route('/exchange/values', name: 'app_exchange_values_list', methods: 'GET')]
    public function list(): JsonResponse
    {
        return $this->json($this->historyService->list());
    }
}