<?php

namespace App\Http\Controllers;

use App\Enums\AuditCategory;
use App\Enums\Roles;
use App\Jobs\SendBlogMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Occupied;
use Carbon\Carbon;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    private VerificationController $verificationController;
    private PaymentController $paymentController;

    public function __construct() {
        $this->verificationController = new VerificationController();
        $this->paymentController = new PaymentController();
    }

    public function showBlogs(): Factory|View|Application
    {
        $blogs = Blog::orderBy('created_at', 'desc')->where('show','1')->get();
        $lastBlog = Blog::where('show', '1')->latest()->first();

        $dateForIntro = Carbon::parse('2022-08-22');
        $dateNow = Carbon::now();

        $diffDate = $dateForIntro->diffInDays($dateNow) + 1;

        $occupied = Occupied::all()->first();

        return view('blogs', ['blogs' => $blogs, 'date' => $diffDate, 'occupied' => $occupied, 'lastBlog' => $lastBlog]);
    }

    public function showBlogsAdmin(): Factory|View|Application
    {
        $blogs = Blog::all();
        $occupied = Occupied::all()->first();
        return view('admin/blogs', ['blogs' => $blogs, 'occupied' => $occupied]);
    }

    public function showBlog(Request $request) {
        $blogId = $request->blogId;
    }

    public function saveBlog(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => ['mimes:png,jpg,jpeg'],
        ]);


        if($request->input('blogId')) {
            $blog = Blog::find($request->input('blogId'));
        } else {
            $blog = new Blog;
        }

        $blog->name =  $request->input('name');
        $blog->description =  $request->input('description');
        if($request->file('file') !== null) {
            $blog->imageExtension = $request->file('file')->extension();
        }
        $blog->save();
        if(isset($request->addBlog)) {
            AuditLogController::Log(AuditCategory::BlogManagement(),"Heeft blog toegevoegd of bewerkt: " . $blog->name, null, $blog);
            $blog->show = true;
            $blog->save();
        }

        if(isset($request->sendEmail)) {
            AuditLogController::Log(AuditCategory::BlogManagement(),"Verstuurde emails van blog " . $blog->name, null, $blog);
            $this->sendEmails($blog, $request);
        }

        if ($request->file('file') !== null) {
            $request->file('file')->storeAs(
                'public/blogImages', $blog->id . '.' . $request->file('file')->extension()
            );
        }

        return redirect('/blogsadmin')->with('success', 'Blog is opgeslagen!');
    }

    public function showBlogInputs(Request $request): Factory|View|Application
    {
        $blog = null;
        if($request->blogId) {
            $blog = Blog::find($request->blogId);
        }
        return view('admin/blogInput',['blog' => $blog]);
    }

    public function deleteBlog(Request $request): Redirector|Application|RedirectResponse
    {
        if($request->blogId) {
            $blog = Blog::find($request->blogId);
            if($blog != null) {
                AuditLogController::Log(AuditCategory::BlogManagement(),"Heeft blog " . $blog->name . " verwijderd.", null, $blog);
                $blog->delete();
                return redirect('/blogsadmin')->with('success', 'Blog is verwijderd!');
            }
            return redirect('/blogsadmin')->with('error', 'Blog kon niet gevonden worden!');
        }
        return redirect('/blogsadmin')->with('erroor', 'Er ging iets niet helemaal goed, probeer het later nog een keer.');
    }

    private function sendEmails(Blog $blog, Request $request) {
        $verifiedParticipants = $this->verificationController->getVerifiedParticipants()->where('role', Roles::participant);
        $nonVerifiedParticipants = $this->verificationController->getNonVerifiedParticipants()->where('role', Roles::participant);
        $paidParticipants = $this->paymentController->getAllPaidUsers()->where('role', Roles::participant);
        $unPaidParticipants = $this->paymentController->getAllNonPaidUsers()->where('role', Roles::participant);

        $userArr = [];

        if(isset($request->NotVerified)) {
            foreach($nonVerifiedParticipants as $participant) {
                array_push($userArr, $participant);
            }
        }

        if(isset($request->Verified)) {
            foreach($verifiedParticipants as $participant) {
                if(!$participant->hasPaid()) {
                    array_push($userArr, $participant);
                }
            }
        }

        if(isset($request->UnPaid)) {
            foreach($unPaidParticipants as $participant) {
                array_push($userArr, $participant);
            }
        }

        if(isset($request->Paid)) {
            foreach($paidParticipants as $participant) {
                array_push($userArr, $participant);
            }
        }
        $filtered = collect($userArr)->unique('id');
        foreach($filtered as $participant) {
            if(isset($participant)) {
                Log::info('Send blog email to: '. $participant->email);
                if(isset($request->addPaymentLink)){
                    SendBlogMail::dispatch($participant, $blog, true);
                } else {
                    SendBlogMail::dispatch($participant, $blog, false);
                }
            }
        }
    }
}
