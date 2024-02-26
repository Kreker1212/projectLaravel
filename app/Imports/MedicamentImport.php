<?php

namespace App\Imports;

use App\Models\Medicament;
use App\Models\Status;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MedicamentImport implements ToCollection
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            //Пересчеёт даты с php на формат Y-m-d
            $date = ($row[3] - 25569) * 86400;
            $date = date("Y-m-d", $date);

            $status = Status::where('name', $row[5])->first();

            if ($status == null) {
                $status = Status::create([
                    'name' => $row[5]
                ]);
                $status->save();
            }
            if (isset($row[0]) && $row[0] != null)
            {
                Medicament::firstOrCreate(
                    [
                        'supply' => $row[0],
                        'product' => $row[1],
                        'name' => $row[2],
                        'date' => $date,
                        'quantity' => $row[4],
                        'status_id' => $status->id,
                    ]
                );
            }
        }
    }
}
