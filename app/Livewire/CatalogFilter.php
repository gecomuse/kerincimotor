<?php

namespace App\Livewire;

use App\Models\Car;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogFilter extends Component
{
    use WithPagination;

    // Filter state
    public array  $brands       = [];
    public string $yearMin      = '';
    public string $yearMax      = '';
    public int    $priceMin     = 0;
    public int    $priceMax     = 1000000000;
    public int    $mileageMin   = 0;
    public int    $mileageMax   = 300000;
    public string $transmission = '';
    public array  $bodyTypes    = [];
    public array  $fuelTypes    = [];
    public array  $colors       = [];
    public bool   $onlyAvailable = true;

    // UI state
    public bool $showFilter = false;
    public int  $perPage    = 12;

    protected $queryString = [
        'brands'       => ['as' => 'brand'],
        'yearMin'      => ['as' => 'year_min'],
        'yearMax'      => ['as' => 'year_max'],
        'priceMin'     => ['as' => 'price_min', 'except' => 0],
        'priceMax'     => ['as' => 'price_max', 'except' => 1000000000],
        'mileageMax'   => ['as' => 'km_max', 'except' => 300000],
        'transmission' => ['as' => 'transmission', 'except' => ''],
        'bodyTypes'    => ['as' => 'type'],
        'fuelTypes'    => ['as' => 'fuel'],
        'colors'       => ['as' => 'color'],
        'onlyAvailable' => ['as' => 'available', 'except' => true],
    ];

    public function updatedBrands(): void      { $this->resetPage(); }
    public function updatedYearMin(): void     { $this->resetPage(); }
    public function updatedYearMax(): void     { $this->resetPage(); }
    public function updatedPriceMin(): void    { $this->resetPage(); }
    public function updatedPriceMax(): void    { $this->resetPage(); }
    public function updatedMileageMax(): void  { $this->resetPage(); }
    public function updatedTransmission(): void { $this->resetPage(); }
    public function updatedBodyTypes(): void   { $this->resetPage(); }
    public function updatedFuelTypes(): void   { $this->resetPage(); }
    public function updatedColors(): void      { $this->resetPage(); }
    public function updatedOnlyAvailable(): void { $this->resetPage(); }

    public function resetFilters(): void
    {
        $this->brands        = [];
        $this->yearMin       = '';
        $this->yearMax       = '';
        $this->priceMin      = 0;
        $this->priceMax      = 1000000000;
        $this->mileageMin    = 0;
        $this->mileageMax    = 300000;
        $this->transmission  = '';
        $this->bodyTypes     = [];
        $this->fuelTypes     = [];
        $this->colors        = [];
        $this->onlyAvailable = true;
        $this->resetPage();
    }

    public function toggleFilter(): void
    {
        $this->showFilter = ! $this->showFilter;
    }

    private function buildQuery()
    {
        $query = Car::query()->with('media');

        if ($this->onlyAvailable) {
            $query->where('is_available', true);
        }

        if (! empty($this->brands)) {
            $query->where(function ($q) {
                foreach ($this->brands as $brand) {
                    $q->orWhere('make_model', 'LIKE', '%' . $brand . '%');
                }
            });
        }

        if ($this->yearMin) {
            $query->where('year', '>=', (int) $this->yearMin);
        }
        if ($this->yearMax) {
            $query->where('year', '<=', (int) $this->yearMax);
        }

        if ($this->priceMin > 0) {
            $query->where('price', '>=', $this->priceMin);
        }
        if ($this->priceMax < 1000000000) {
            $query->where('price', '<=', $this->priceMax);
        }

        if ($this->mileageMax < 300000) {
            $query->where('mileage', '<=', $this->mileageMax);
        }

        if ($this->transmission) {
            $query->where('transmission', $this->transmission);
        }

        if (! empty($this->bodyTypes)) {
            $query->whereIn('body_type', $this->bodyTypes);
        }

        if (! empty($this->fuelTypes)) {
            $query->whereIn('fuel_type', $this->fuelTypes);
        }

        if (! empty($this->colors)) {
            $query->whereIn('color', $this->colors);
        }

        return $query->ordered();
    }

    public function render()
    {
        $cars  = $this->buildQuery()->paginate($this->perPage);
        $total = $this->buildQuery()->count();

        // Available filter options
        $allColors     = Car::available()->distinct()->pluck('color')->sort()->values();
        $availableYears = Car::available()->distinct()->orderBy('year', 'desc')->pluck('year')->values();

        $waNumber = Setting::getValue('wa_number', '6287776700009');

        return view('livewire.catalog-filter', compact('cars', 'total', 'allColors', 'availableYears', 'waNumber'));
    }
}
