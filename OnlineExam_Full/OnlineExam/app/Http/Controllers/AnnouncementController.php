<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\Courses_Students;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Courses $course)
    {
        return view('announcement.list', [
            'announcements' => Announcement::where(['course_id' => $course->id])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $role = auth()->user()->role == 'Teacher' ? 'given_by' : 'assistant_id';

        return view('announcement.create', [
            'courses' => Courses::where([$role => auth()->user()->id])->get()
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'course_id' => 'required|integer'
        ]);

        auth()->user()->announcements()->create($data);

        return redirect()->route('announcement.list', Courses::find($data["course_id"]));
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Courses $course, Announcement $announcement, Courses_Students $courses_Students)
    {
        $role = auth()->user()->role == 'Teacher' ? 'given_by' : 'assistant_id';
        $courses =Courses::all();
        $coursesStu=Courses_Students::all()->where('student_id', auth()->user()->id);
        $capsule=array('coursesStu'=> $coursesStu,'courses'=>$courses);
        return view('announcement.read', compact('announcement'),[
            'courses' => Courses::where([$role => auth()->user()->id])->get(),
        ])->with($capsule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $role = auth()->user()->role == 'Teacher' ? 'given_by' : 'assistant_id';

        return view('announcement.update', [
            'announcement' => $announcement,
            'courses' => Courses::where([$role => auth()->user()->id])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            
        ]);

        $announcement->update($data);

        return redirect()
            ->route('announcement.read', [Courses::find($announcement->course_id),$announcement]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->back();
    }
}
