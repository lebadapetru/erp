<?php

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UserExistsByIdValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\UserExistsById */

        $user = $this->userRepository->find($value);

        if (!$user) {
            throw new NotFoundHttpException();
        }
    }
}
