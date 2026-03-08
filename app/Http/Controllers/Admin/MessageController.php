<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::query()->latest()->paginate(20),
        ]);
    }

    public function show(Message $message): View
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return back()->with('status', 'Message deleted.');
    }
}
