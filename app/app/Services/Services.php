<?php
declare(strict_types=1);
namespace App\Services;
use App\Models\Service;
use App\DTO\ServiceDTO;
use Arr;
class Services
{
    public function all()
    {
        return Service::select(['id', 'name', 'uid', 'image_url', 'description', 'price', 'status'])
            ->latest()
            ->paginate(10);
    }
    /**
     * Method store
     *
     * @param array $data [explicite description]
     *
     * @return Service
     */
    public function store(array $data): Service
    {
        $prepareDTO = $this->prepareServiceDTO($data);
        $service = $this->createService($prepareDTO);
        return $service;
    }
    public function prepareServiceDTO(array $data): ServiceDTO
    {
        return new ServiceDTO(
            name: Arr::get($data, 'name'),
            uid: str_unique_with_prefix('se-'),
            image_url: Arr::get($data, 'image_url'),
            description: Arr::get($data, 'description'),
            price: Arr::get($data, 'price'),
            status: Arr::get($data, 'status'),
        );
    }
    protected function createService(ServiceDTO $serviceDTO): Service
    {
        return Service::create($serviceDTO->toArray());
    }
    public function findServiceByUid(string $uid): Service
    {
        return Service::select(['id', 'name', 'price', 'image_url', 'uid', 'description', 'status'])
            ->where('uid', $uid)->first();
    }
    public function prepareDtoUpdateService($service, array $data): ServiceDTO
    {
        return new ServiceDTO(
            name: Arr::get($data, 'name'),
            uid: $service->uid,
            image_url: Arr::get($data, 'image_url'),
            description: Arr::get($data, 'description'),
            price: Arr::get($data, 'price'),
            status: Arr::get($data, 'status'),
        );
    }
    public function updatedServices(ServiceDTO $data, $service)
    {
        return $service->update([...$data->toArray()]);
    }
}