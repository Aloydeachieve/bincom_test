<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PollingUnit, AnnouncedPuResult, Lga, Ward};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResultController extends Controller
{
    // Question 1: Display result for individual polling unit
    // ✅ Show individual polling unit + last submission
    public function showPollingUnit($id)
    {
        $pollingUnit = PollingUnit::with('results')->find($id);

        if (!$pollingUnit) {
            return back()->with('error', 'Polling Unit not found');
        }

        // ✅ Get last submission info
        $lastSubmission = $pollingUnit->results()
            ->orderByDesc('date_entered')
            ->first(['entered_by_user', 'date_entered']);

        return view('polling_unit', compact('pollingUnit', 'lastSubmission'));
    }

    // Question 2: Display total results by LGA
    public function showLgaResult(Request $request)
    {
        $lgas = Lga::all();
        $results = [];

        if ($request->has('lga_id')) {
            $lga = Lga::find($request->lga_id);
            $pollingUnits = $lga ? $lga->pollingUnits()->pluck('uniqueid') : [];

            $results = AnnouncedPuResult::whereIn('polling_unit_uniqueid', $pollingUnits)
                ->selectRaw('party_abbreviation, SUM(party_score) as total_score')
                ->groupBy('party_abbreviation')
                ->get();
        }

        return view('lga_result', compact('lgas', 'results'));
    }

    // Question 3: Form for adding new polling unit results
    public function create()
    {
        $wards = Ward::with('lga')->get();
        return view('add_result', compact('wards'));
    }

    // ✅ Store new polling unit results
    public function store(Request $request)
    {
        $request->validate([
            'polling_unit_uniqueid' => 'required|integer',
            'results.*.party_abbreviation' => 'required|string|max:50',
            'results.*.party_score' => 'required|integer|min:0',
            'entered_by_user' => 'required|string|max:100',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->results as $result) {
                AnnouncedPuResult::create([
                    'polling_unit_uniqueid' => $request->polling_unit_uniqueid,
                    'party_abbreviation'   => $result['party_abbreviation'],
                    'party_score'          => $result['party_score'],
                    'entered_by_user'      => $request->entered_by_user,
                    'date_entered'         => Carbon::now(), // ✅ fixed missing default
                    'user_ip_address'      => $request->ip(),
                ]);
            }

            DB::commit();

            // ✅ Flash polling_unit_uniqueid so SweetAlert can show “View Added Result”
            return redirect()
                ->back()
                ->withInput(['polling_unit_uniqueid' => $request->polling_unit_uniqueid])
                ->with('success', 'Polling unit results successfully added!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // AJAX: Get LGAs by State
    public function getLgas($state_id)
    {
        return response()->json(Lga::where('state_id', $state_id)->get());
    }

    // AJAX: Get Wards by LGA
    public function getWards($lga_id)
    {
        return response()->json(Ward::where('lga_id', $lga_id)->get());
    }

    // AJAX: Get Polling Units by Ward
    public function getPollingUnits($ward_id)
    {
        return response()->json(PollingUnit::where('ward_id', $ward_id)->get());
    }
}
