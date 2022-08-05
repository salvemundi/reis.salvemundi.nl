<?php

namespace App\Http\Controllers;

use App\Enums\AuditCategory;
use App\Models\AuditLog;
use App\Models\Blog;
use App\Models\Participant;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->log(AuditCategory::Other(), 'Inzien van audit logs');
        $logs = AuditLog::orderBy('created_at','desc')->get();
        return view('admin/auditLogs',['logs' => $logs]);
    }

    public static function Log(AuditCategory $category, string $description, Participant $participant = null, Blog $blog = null, Setting $setting = null, Schedule $schedule = null): void
    {
        $user = User::find(session('id'));
        $auditLog = new AuditLog(['description' => $description]);
        $auditLog->auditCategory = $category;
        $auditLog->user()->associate($user)->save();
        switch($category) {
            case AuditCategory::ParticipantManagement():
                if($participant !== null) {
                    $auditLog->participant()->associate($participant);
                    $auditLog->save();
                }
                break;
            case AuditCategory::BlogManagement():
                if($blog === null){
                    throw new InvalidArgumentException('Missing blog in parameter!');
                }
                $auditLog->blog()->associate($blog);
                $auditLog->save();
                break;
            case AuditCategory::SettingManagement():
                if($setting === null){
                    throw new InvalidArgumentException('Missing setting in parameter!');
                }
                $auditLog->setting()->associate($setting);
                $auditLog->save();
                break;
            case AuditCategory::ScheduleManagement():
                if($schedule === null){
                    throw new InvalidArgumentException('Missing schedule in parameter!');
                }
                $auditLog->schedule()->associate($schedule);
                $auditLog->save();
        }
    }
}
