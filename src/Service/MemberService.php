<?php

namespace App\Service;

use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;

class MemberService
{
    private $memberRepository;
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function getAllUser():?array{
        return $this->memberRepository->findAll();
    }


}