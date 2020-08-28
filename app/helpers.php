<?php 


// Custom helper for task to the users

function userRole()
{
    foreach (Auth::user()->getRoleNames() as $role) {
        return $role;
    }
}

// Custom helper for task to the roles

function TaskRole()
{
    return App\Task::where('roles', userRole())->where('status', 'upcoming')->where('is_notified', 'unseen')->get();
}

// Custom helper for completed task

function TaskCompleted()
{
    return App\TaskComplete::where('is_notified', 'unseen')->get();
}

// // Custom helper for central website settings

function centralSettings()
{
    return App\WebsiteSetting::first();
}

// Custom helper for footer settings

function footerSettings()
{
    return App\Footer::first();
}

// Custom helper to get doctors list 

function latestDocs()
{
    return App\Doctor::latest()->get();
}

