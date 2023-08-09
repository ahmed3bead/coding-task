<?php

namespace MyApp\Base;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Munjz\Base\Http\HttpStatus;

class Service
{
    private ?\stdClass $errors = null;



    protected function response(): Response
    {
        return (new Response())
            ->setErrors($this->getErrors());
    }


    public function setResponse($data){
        return $this->response()->setData($data)->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function setSuccessMessageResponse($message, $status = HttpStatus::HTTP_OK): JsonResponse
    {
        return $this->response()->setData(['message' => $message])
            ->setMessage($message)->setStatusCode($status)->json();
    }
    public function setMessageResponse($message, $status = HttpStatus::HTTP_ERROR): JsonResponse
    {
        return $this->response()->setData(['message' => $message])
            ->setMessage($message)->setStatusCode($status)->json();
    }

    public function setErrorResponse($message, $status = HttpStatus::HTTP_ERROR): JsonResponse
    {
        return $this->response()->setErrors(['message' => $message])->setStatusCode($status)->json();
    }

    public function tryAndResponse(callable $func): Response|JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $func();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param  \stdClass|null  $errors
     */
    public function setErrors(?\stdClass $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return \stdClass|null
     */
    public function getErrors(): ?\stdClass
    {
        return $this->errors;
    }


    /**
     * @param mixed $errors
     */
    public function setError($error): void
    {
        $this->errors[] = $error;
    }
}
