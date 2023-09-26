<?php

namespace App\Livewire\Point;

use App\Exports\PointExport;
use App\Imports\PointImport;
use App\Models\Point;
use App\Traits\PointTrait;
use Livewire\Component;

class PointComponent extends Component
{
    use PointTrait;

    public function render()
    {
        $this->authorize('view-point');

        $points = Point::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.point.point-component', [
            'points' => $points
        ]);
    }

    public function confirmPointAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmPointEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $point = Point::findOrFail($id);
        $this->point_id = $point->id;
        $this->name = $point->name;
    }

    public function savePoint()
    {
        $validated = $this->validate();
        if (isset($this->point_id)) {
            $point = Point::findOrFail($this->point_id);
            $point->update($validated);
            $this->successMessage(__('Point updated successfully'));
        } else {
            Point::create($validated);
            $this->successMessage(__('Point created successfully'));
        }
        $this->confirm_form = false;
    }

    public function confirmPointDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deletePoint()
    {
        $point = Point::findOrFail($this->confirm_delete);
        $point->edokis()->update(['point_id' => null]);
        $point->emadEdeens()->update(['point_id' => null]);
        $point->delete();
        $this->successMessage(__('Point deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importPoint(PointImport $importPoint)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('Edoki schema imported successfully'));
            $this->confirm_import = false;
            return $importPoint->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportPoint()
    {
        try {
            $this->successMessage(__('Edoki schema exported successfully'));
            return new PointExport($this->search);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
