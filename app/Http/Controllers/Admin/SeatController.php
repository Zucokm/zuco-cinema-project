<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CinemaHall;
use App\Models\SeatType;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function index()
    {

        $halls = CinemaHall::whereHas('seats')
            ->with(['cinema', 'seats' => function ($query) {

                $query->orderBy('row')->orderBy('number');
            }, 'seats.seatType'])
            ->get();

        return view('admin.seats.index', compact('halls'));
    }


    public function clearByHall($hallId)
    {

        Seat::where('cinema_hall_id', $hallId)->delete();

        CinemaHall::where('id', $hallId)->update(['totalSeats' => 0]);

        return redirect()->route('admin.seats.index')->with('success', 'All seats for this hall have been successfully cleared!');
    }

    public function create()
    {
        $halls = CinemaHall::with('cinema')->get();
        $seatTypes = SeatType::all();

        $usedRowsByHall = \App\Models\Seat::select('cinema_hall_id', 'row')
            ->distinct()
            ->get()
            ->groupBy('cinema_hall_id')
            ->map(function ($seats) {
                return $seats->pluck('row');
            });

        return view('admin.seats.create', compact('halls', 'seatTypes', 'usedRowsByHall'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cinema_hall_id' => 'required|exists:cinema_halls,id',
            'seat_type_id' => 'required|exists:seat_types,id',
            'start_row' => 'required|string|size:1', // စတင်မယ့် အက္ခရာ (ဥပမာ A, C)
            'row_count' => 'required|integer|min:1|max:26',
            'seats_per_row' => 'required|integer|min:1|max:100',
        ]);

        $hallId = $request->cinema_hall_id;
        $typeId = $request->seat_type_id;
        $startRow = strtoupper($request->start_row);
        $rowCount = $request->row_count;
        $seatsPerRow = $request->seats_per_row;


        $alphabet = range('A', 'Z');


        $startIndex = array_search($startRow, $alphabet);


        if ($startIndex === false || ($startIndex + $rowCount) > 26) {
            return back()->with('error', 'Row count exceeds the maximum letter Z.');
        }

        DB::beginTransaction();

        try {
            $seatsData = [];


            for ($i = $startIndex; $i < $startIndex + $rowCount; $i++) {
                $rowLetter = $alphabet[$i];
                for ($j = 1; $j <= $seatsPerRow; $j++) {
                    $seatsData[] = [
                        'cinema_hall_id' => $hallId,
                        'seat_type_id' => $typeId,
                        'row' => $rowLetter,
                        'number' => $j,
                        'seat_code' => $rowLetter . $j,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Bulk Insert
            Seat::insert($seatsData);

            $totalGeneratedSeats = $rowCount * $seatsPerRow;
            CinemaHall::where('id', $hallId)->increment('totalSeats', $totalGeneratedSeats);

            DB::commit();

            return redirect()->route('admin.seats.index')->with('success', $totalGeneratedSeats . ' Seats automatically generated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error generating seats. Please check if these seats already exist in this hall.');
        }
    }
}
