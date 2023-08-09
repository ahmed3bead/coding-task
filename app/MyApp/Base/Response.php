<?php

namespace MyApp\Base;

use Illuminate\Http\JsonResponse;

class Response implements \JsonSerializable
{
    /**
     * @var int $statusCode
     */
    private $statusCode = 200;
    /**
     * @var string $message
     */
    private mixed $message = "";
    /**
     * @var mixed $errors
     */
    private mixed $errors = null;
    /**
     * @var mixed $data
     */
    private mixed $data = null;
    /**
     * @var mixed $data
     */
    private mixed $meta = null;
    /**
     * @var string $source
     */
    private string $source = 'marafiq';
    /**
     * @var array $headers
     */
    private $headers = [];

    public function __construct($statusCode = 200, $data = null)
    {
        $this->statusCode = $statusCode;
        $this->data = $data ?? new \stdClass();
    }

    /**
     * @param  string  $message
     *
     * @return Response
     */
    public function setMessage(string $message): Response
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * build and return the json response
     *
     * @return JsonResponse
     */
    public function json()
    {
        return response()->json([
            'status_code' => $this->getStatusCode() ?? (new \stdClass()),
            'errors'      => $this->getErrors() ?? (new \stdClass()),
            'message'     => $this->getMessage() ?? (new \stdClass()),
            'source'      => $this->getSource() ?? (new \stdClass()),
            'data'        => $this->getData() ?? (new \stdClass()),
        ],
            $this->getStatusCode(),
            $this->getHeaders()
        );
    }

    /**
     * return the data that can be serialized as json
     */
    public function jsonSerialize()
    {
        return [
            'status_code' => $this->getStatusCode() ?? (new \stdClass()),
            'message'     => $this->getMessage() ?? (new \stdClass()),
            'errors'      => $this->getErrors() ?? (new \stdClass()),
            'data'        => $this->getData() ?? (new \stdClass()),
            'meta'        => $this->getMeta() ?? (new \stdClass()),
            'source'      => $this->getSource() ?? (new \stdClass()),
        ];
    }

    /**
     * @param  string  $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param  int  $statusCode
     *
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrors(): mixed
    {
        return $this->errors;
    }

    /**
     * @param  mixed  $errors
     *
     * @return Response
     */
    public function setErrors(mixed $errors): Response
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param  mixed  $data
     *
     * @return Response
     */
    public function setData(mixed $data): Response
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeta(): mixed
    {
        return $this->meta;
    }

    /**
     * @param  mixed  $data
     *
     * @return Response
     */
    public function setMeta(mixed $meta): Response
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param  array  $headers
     *
     * @return Response
     */
    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;
        return $this;
    }
}
