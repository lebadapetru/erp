<?php


namespace App\EventListener;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestTransformerListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!$this->isAvailable($request)) {
            return;
        }

        if (!$this->transform($request)) {
            $response = new Response('Unable to parse request.', Response::HTTP_BAD_REQUEST);

            $event->setResponse($response);
        }
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isAvailable(Request $request): bool
    {
        return ('json' === $request->getContentType()) && $request->getContent();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function transform(Request $request): bool
    {
        $data = \json_decode($request->getContent(), true);
        array_walk_recursive($data, 'trim');
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            return false;
        }

        if (\is_array($data)) {
            $request->request->replace($data);
        }

        return true;
    }
}