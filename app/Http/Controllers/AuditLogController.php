<?php

namespace App\Http\Controllers;

use App\Enums\AuditCategory;
use App\Models\AuditLog;
use App\Models\Blog;
use App\Models\Participant;
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
        $logs = AuditLog::all();
        return view('admin/auditLogs',['logs' => $logs]);
    }

    public static function Log(AuditCategory $category, string $description, Participant $participant = null, Blog $blog = null): void
    {
        $user = User::find(session('id'));
        $auditLog = new AuditLog(['auditCategory' => $category, 'description' => $description]);
        $auditLog->user()->associate($user)->save();
        switch($category) {
            case AuditCategory::ParticipantManagement():
                if($participant === null) {
                    throw new InvalidArgumentException('Missing participant in parameter!');
                }
                $auditLog->participant()->associate($participant);
                $auditLog->user()->associate($user)->save();
                break;
            case AuditCategory::BlogManagement():
                if($blog === null){
                    throw new InvalidArgumentException('Missing blog in parameter!');
                }
                $auditLog->blog()->associate($blog);
                $auditLog->user()->associate($user)->save();
                break;
        }
    }
}
