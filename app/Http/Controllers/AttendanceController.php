<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Lecture;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Pagrindinis puslapis: dalyko paskaitos ir lankomumas
     */
    public function index(Subject $subject)
    {
        $lectures = $subject->lectures()->with('attendances.user')->orderBy('date', 'desc')->get();
        $isAdmin  = in_array(auth()->user()->type, ['admin', 'superAdmin']);

        return view('attendance.index', compact('subject', 'lectures', 'isAdmin'));
    }

    /**
     * Dėstytojas sukuria naują paskaitą ir generuoja QR kodą
     */
    public function storeLecture(Request $request, Subject $subject)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $subject->lectures()->create([
            'created_by' => auth()->id(),
            'date'       => $request->date,
            'qr_code'    => Lecture::generateQrCode(),
        ]);

        return redirect()->route('attendance.index', $subject)->with('success', 'Paskaita sukurta.');
    }

    /**
     * Dėstytojas ištrina paskaitą (tik savo)
     */
    public function destroyLecture(Subject $subject, Lecture $lecture)
    {
        if ($lecture->created_by !== auth()->id() && auth()->user()->type !== 'superAdmin') {
            abort(403);
        }

        $lecture->delete();

        return redirect()->route('attendance.index', $subject)->with('success', 'Paskaita ištrinta.');
    }

    /**
     * Studentas pažymi lankomumą įvesdamas QR kodą
     */
    public function markAttendance(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $lecture = Lecture::where('qr_code', strtoupper($request->qr_code))->first();

        if (!$lecture) {
            return back()->with('error', 'Neteisingas kodas.');
        }

        $already = Attendance::where('lecture_id', $lecture->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($already) {
            return back()->with('error', 'Lankomumas jau pažymėtas.');
        }

        Attendance::create([
            'lecture_id'  => $lecture->id,
            'user_id'     => auth()->id(),
            'attended_at' => now(),
        ]);

        return back()->with('success', 'Lankomumas sėkmingai pažymėtas!');
    }

    /**
     * Studento savo lankomumo puslapis
     */
    public function myAttendance()
    {
        $attendances = Attendance::where('user_id', auth()->id())
            ->with('lecture.subject')
            ->orderBy('attended_at', 'desc')
            ->get();

        return view('attendance.My', compact('attendances'));
    }
}
