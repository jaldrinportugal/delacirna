<?php

namespace App\Http\Controllers\dentistrystudent;

use App\Http\Controllers\Controller;
use App\Models\CommunityForum;
use App\Models\Comment;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DentistryStudentCommunityForumController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
        ]);

        CommunityForum::create([
            'topic' => $request->topic,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Topic posted successfully!');
    }

    public function index(){
        $communityforums = CommunityForum::all();
        $communityforums = CommunityForum::paginate(10);
        return view('dentistrystudent.communityforum.communityforum', compact('communityforums'));
    }

    public function createCommunityforum(){
        return view('dentistrystudent.communityforum.create');
    }

    public function deleteCommunityforum($id){
        $communityforum = CommunityForum::findOrFail($id);
        $communityforum->delete();

        return back()
            ->with('success', 'Topic deleted successfully!');
    }

    
    public function editCommunityforum($id)
{
    session(['edit_id' => $id]);
    return redirect()->route('dentistrystudent.communityforum');
}

// Update the community forum post
public function updateCommunityforum(Request $request, $id)
{
    $request->validate([
        'topic' => 'required|string|max:255',
    ]);

    $communityforum = CommunityForum::findOrFail($id);
    $communityforum->topic = $request->input('topic');
    $communityforum->save();

    session()->forget('edit_id');
    return redirect()->route('dentistrystudent.communityforum')->with('success', 'Topic updated successfully!');
}

    public function showComment($communityforumId)
    {
        $communityforums = CommunityForum::findOrFail($communityforumId);
        $comments = $communityforums->comments;

        return view('dentistrystudent.communityforum.showComment', compact('communityforums', 'comments'));
    }
    public function comment()
    {
        $communityforums = CommunityForum::with('comments')->get();
        return view('dentistrystudent.communityforum', compact('communityforums'));
    }
}