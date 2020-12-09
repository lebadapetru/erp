<?php


namespace App\Request;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;


abstract class BaseRequest
{
    private ?Request $request;
    private ValidatorInterface $validator;

    public function __construct(
        RequestStack $requestStack,
        ValidatorInterface $validator
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->validator = $validator;
    }

    abstract protected function rules(): array;

    public function all(): array
    {
        $violations = $this->validate(
            $this->getData(),
            $this->getRules()
        );

        $errorMessages = [];
        foreach ($violations as $violation) {
            $errorMessages[] = $violation->getMessage();
            throw new BadRequestHttpException($violation->getMessage());
        }

        return $this->getData();

        //TODO create event listener kernel.exception to display standardized validation error
        //catch those custom exceptions and throw json response of array
    }

    /*see if there's a need for wrapper in the future*/
    private function validate(array $data, array $rules)
    {
        return $this->validator->validate(
            $data,
            new Assert\Collection($rules)
        );
    }

    protected function getData(): array
    {
        return $this->request->request->all();
    }

    protected function getRules(): array
    {
        return $this->rules();
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }
}