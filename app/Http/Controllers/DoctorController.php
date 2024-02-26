<?php

namespace App\Http\Controllers;

use App\Enums\MedicamentStatus;
use App\Models\Medicament;
use App\Models\MedicamentRecord;
use App\Models\Records;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function viewRecords(int $id): View
    {
        $medicaments = Medicament::where('status_id', '!=', MedicamentStatus::BAD)->get();
        $records = Records::where('doctor_id', $id)->get();

        return view('doctor.my_records', ['records' => $records, 'medicaments' => $medicaments]);
    }

    public function medicamentAdd(Request $request): RedirectResponse
    {
        MedicamentRecord::create([
            'record_id' => $request->record_id,
            'medicament_id' => $request->medicine,
            'quantity' => $request->quantity
        ]);

        $medicamentUser = Medicament::where('medicament_id', $request->medicine);

        return redirect()->back()->with('medicamentUser', $medicamentUser);
    }
}
