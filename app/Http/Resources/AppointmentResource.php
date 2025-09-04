<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $months = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez'
        ];

        $ApDate = Carbon::parse($this->date);

        $ApDay = $ApDate->day;
        $Apmonth = $months[$ApDate->month];
        $ApYear = $ApDate->year;

        $newDate = "{$ApDay} de {$Apmonth} de {$ApYear}";

        return [
            'id'=>$this->id,
            'service' => $this->service->name,
            'date' => $newDate,
            'start_time' => Carbon::parse($this->start_time)->format('h:i'),
            'status' => $this->status
        ];
    }
}
