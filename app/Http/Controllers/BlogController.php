<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Occupied;
use Carbon\Carbon;
use App\Mail\participantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

// This controller  is commonly referred to as blog / news controller. Previous PR #12 caused a naming nightmare. (May or may not have been me.)
class BlogController extends Controller
{
    private VerificationController $verificationController;
    private PaymentController $paymentController;

    public function __construct() {
        $this->verificationController = new VerificationController();
        $this->paymentController = new PaymentController();
    }

    public function showPosts() {
        $posts = Blog::all();

        $dateForIntro = Carbon::parse('2022-08-22');
        $dateNow = Carbon::now();

        $diffDate = $dateForIntro->diffInDays($dateNow) + 1;

        $occupied = Occupied::all()->first();

        return view('blogs', ['posts' => $posts, 'date' => $diffDate, 'occupied' => $occupied]);
    }

    public function showPostsAdmin() {
        $posts = Blog::all();
        $occupied = Occupied::all()->first();
        return view('admin/blogs', ['posts' => $posts, 'occupied' => $occupied]);
    }

    public function updateOccupiedPercentage(Request $request){
        if(Occupied::all()->first() != null) {
            $occupied = Occupied::all()->first();
        } else {
            $occupied = new Occupied();
        }

        $occupied->occupied = $request->input('occupied');
        $occupied->save();
        return redirect('/blogsadmin')->with('success', 'percentage is geupdated!');
    }

    public function showPost(Request $request) {
        $postId = $request->postId;
    }

    public function savePost(Request $request) {

        if($request->input('blogId')) {
            $post = Blog::find($request->input('blogId'));
        } else {
            $post = new Blog;
        }

        $post->name =  $request->input('name');
        $post->content =  $request->input('content');

        if(isset($request->addBlog)) {
            $post->show = true;
        }

        $post->save();

        if(isset($request->sendEmail)) {
            $this->sendEmails($post, $request);
        }

        return redirect('/blogsadmin')->with('success', 'Blog is opgeslagen!');
    }

    public function showPostInputs(Request $request) {
        $post = null;
        if($request->blogId){
            $post = Blog::find($request->blogId);
        }
        return view('admin/blogInput',['post' => $post]);
    }

    public function deletePost(Request $request) {
        if($request->blogId) {
            $blog = Blog::find($request->blogId);
            if($blog != null) {
                $blog->delete();
                return redirect('/blogsadmin')->with('success', 'Blog is verwijderd!');
            }
            return redirect('/blogsadmin')->with('error', 'Blog kon niet gevonden worden!');

        }
        return redirect('/blogsadmin')->with('error', 'Er ging iets niet helemaal goed, probeer het later nog een keer.');
    }

    private function sendEmails(Blog $blog, Request $request) {
        $verifiedParticipants = $this->verificationController->getVerifiedParticipants();
        $nonVerifiedParticipants = $this->verificationController->getNonVerifiedParticipants();
        $paidParticipants = $this->paymentController->getAllPaidUsers();
        $unPaidParticipants = $this->paymentController->getAllNonPaidUsers();

        $userArr = [];

        if(isset($request->NotVerified)) {
            foreach($nonVerifiedParticipants as $participant) {
                array_push($userArr, $participant);
            }
        }

        if(isset($request->Verified)) {
            foreach($verifiedParticipants as $participant) {
                array_push($userArr, $participant);
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

        foreach(array_unique($userArr) as $participant) {
            if(isset($participant)) {
                Mail::bcc($participant)
                    ->send(new participantMail($participant, $blog));
            }
        }
    }
}
