<?php 
declare(strict_types=1);
namespace App\Services;
use App\Models\Service;
use App\DTO\ServiceDTO;
use Arr;
class Services
{    
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
         name: Arr::get($data,'name'),
         uid : str_unique_with_prefix('se-'),
         image_url: Arr::get($data,'image_url'),
         description : Arr::get($data,'description'),
         price : Arr::get($data,'price'),
         status: Arr::get($data,'status'),
     );
    }
    protected function createService(ServiceDTO  $serviceDTO):Service
    {
        return Service::create($serviceDTO->toArray());
    }
}