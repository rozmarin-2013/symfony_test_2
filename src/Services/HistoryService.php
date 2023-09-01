<?php

namespace App\Services;

use App\Entity\History;
use App\Repository\HistoryRepository;
use App\Request\CreateHistoryInput;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class HistoryService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private HistoryRepository $historyRepository
    ) {
    }
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function create(CreateHistoryInput $input)
    {
        $history = new History();
        $history->setFirstIn($input->first);
        $history->setSecondIn($input->second);

        list($input->first, $input->second) = [$input->second, $input->first];

        $history->setFirstOut($input->first);
        $history->setSecondOut($input->second);

        $this->entityManager->persist($history);
        $this->entityManager->flush();
    }

    public function list()
    {
        return $this->historyRepository->findAll();
    }
}