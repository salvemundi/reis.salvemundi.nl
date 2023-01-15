<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Activity;
use Throwable;

class ActivityController extends Controller
{
    public function index(): Collection {
       return Activity::all();
    }

    public function showCreatePage(Request $request): Factory|View|Application {
        if($request->activityId) {
            return view('admin/addActivities')->with(['activity' => $this->show($request->activityId)]);
        }
        return view('admin/addActivities');
    }

    public function view(): Application|Factory|View {
        return view('admin/activities')->with(['activities' => $this->index()]);
    }

    public function show(string $uuid): Activity {
        return Activity::where('id', $uuid)->first();
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $activity = new Activity($request->all());
        $activity->saveOrFail();

        return redirect('/activities')->with('message', 'Activiteit is aangemaakt');
    }

    public function delete(Request $request): RedirectResponse {
        $this->show($request->activityId)->delete();

        return back()->with('success', 'Activiteit is verwijderd');
    }

    /**
     * @throws Throwable
     */
    public function update(Request $request): RedirectResponse {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $activity = $this->show($request->activityId);
        $activity->updateOrFail($request->all());

        return redirect('/activities')->with('success','Informatie bijgewerkt!');
    }
}

