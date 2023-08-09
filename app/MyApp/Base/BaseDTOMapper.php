<?php

namespace MyApp\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BaseDTOMapper implements DTOMapperInterface
{
    /**
     * @var ModelInterface $model
     */
    protected ModelInterface $model;
    /**
     * @var DTOInterface $DTO
     */
    protected DTOInterface $DTO;
    /**
     * @var DTOMapperInterface $mapper
     */
    protected DTOMapperInterface $mapper;

    /**
     * @return DTOInterface
     */
    public function getDTO(): DTOInterface
    {
        return $this->DTO;
    }

    /**
     * @param  DTOInterface  $DTO
     */
    public function setDTO(DTOInterface $DTO): void
    {
        $this->DTO = $DTO;
    }

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface
    {
        return $this->model;
    }

    /**
     * @param  ModelInterface  $model
     */
    public function setModel(ModelInterface $model): void
    {
        $this->model = $model;
    }

    /**
     * @return DTOMapperInterface
     */
    public function getMapper(): DTOMapperInterface
    {
        return $this->mapper;
    }

    /**
     * @param  DTOMapperInterface  $mapper
     */
    public function setMapper(DTOMapperInterface $mapper): void
    {
        $this->mapper = $mapper;
    }

    public static function fromPaginator(
        LengthAwarePaginator $paginator
    ): array {
        $mapper = get_called_class();
        $mapper = new $mapper;
        return [
            'items' => $mapper::fromArray($paginator->items()),
            'meta'  => [
                'currentPage' => $paginator->currentPage(),
                'lastPage'    => $paginator->lastPage(),
                'path'        => $paginator->path(),
                'perPage'     => $paginator->perPage(),
                'total'       => $paginator->total(),
            ],
        ];
    }
}
