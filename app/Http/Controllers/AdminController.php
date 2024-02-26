<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\Medicament;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Enums\MedicamentStatus;

class AdminController extends Controller
{
    public function medicaments(): View
    {
        $medicaments = Medicament::all();

        $date = strtotime("now");
        $datePlusTwoMonth = date("Y-m-d", strtotime("+2 month", $date));

        foreach ($medicaments as $medicament) {
            if (date('Y-m-d') > $medicament->date) {
                Medicament::find($medicament->id)->update([
                    'status_id' => MedicamentStatus::BAD
                ]);
            }

            if (date('Y-m-d') < $medicament->date and $datePlusTwoMonth < $medicament->date) {
                Medicament::find($medicament->id)->update([
                    'status_id' => MedicamentStatus::GOOD
                ]);
            }

            if (date('Y-m-d') < $medicament->date and $datePlusTwoMonth > $medicament->date) {
                Medicament::find($medicament->id)->update([
                    'status_id' => MedicamentStatus::IMPLEMENT
                ]);
            }
        }

        return view('admin.admin_medicaments', ['medicaments' => $medicaments]);
    }

    public function viewUpdate(int $id): View
    {
        $doctor = Doctor::find($id);

        return view('admin.update_doctor', ['doctor' => $doctor]);
    }

    public function view(): View
    {
        $doctors = Doctor::all();

        return view('admin.admin', ['doctors' => $doctors]);
    }

    public function createDoctor(DoctorRequest $request): JsonResponse
    {
        $dataDoctor = $request->validated();

        $doctor = Doctor::create([
            'name' => $dataDoctor['name'],
            'surname' => $dataDoctor['surname'],
            'experience' => $dataDoctor['experience']
        ]);

        return response()->json($doctor);
    }

    public function deleteDoctor(int $id): JsonResponse
    {
        Doctor::find($id)->delete();

        return response()->json(['status' => 'ok']);
    }

    public function update(DoctorRequest $request, int $id): void
    {
        $doctor = $request->validated();

        if (isset($doctor->name)) {
            Doctor::find($id)->update([
                'name' => $doctor->name,
            ]);
        }

        if (isset($doctor['surname'])) {
            Doctor::find($id)->update([
                'surname' => $doctor->surname
            ]);
        }

        if (isset($doctor['experience'])) {
            Doctor::find($id)->update([
                'experience' => $doctor->experience
            ]);
        }
    }
}
