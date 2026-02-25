<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSubmissionRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return Inertia::render('contact/index');
    }

    /**
     * Store a new contact submission.
     */
    public function store(ContactSubmissionRequest $request)
    {
        // Get validated data
        $validated = $request->validated();

        // Create submission record
        $submission = ContactSubmission::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'inquiry_type' => $validated['inquiryType'],
            'message' => $validated['message'],
            'newsletter' => $validated['newsletter'] ?? false,
            'consent' => $validated['consent'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        // Optional: Send email notification to admin
        // Mail::to(config('mail.admin'))->send(new ContactSubmissionNotification($submission));

        // Optional: Send auto-reply to user
        // Mail::to($submission->email)->send(new ContactAutoReply($submission));

        return redirect()->back()->with('success', 'Thank you for your message. We\'ll respond within 24-48 hours.');
    }

    /**
     * Display admin listing of contact submissions.
     */
    public function adminIndex(Request $request)
    {
        $submissions = ContactSubmission::query()
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('admin/contact-submissions/index', [
            'submissions' => $submissions,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    /**
     * Display a single contact submission.
     */
    public function adminShow(ContactSubmission $submission)
    {
        // Mark as read if not already read
        if ($submission->status === 'new') {
            $submission->markAsRead();
        }

        return Inertia::render('admin/contact-submissions/show', [
            'submission' => $submission,
        ]);
    }

    /**
     * Update submission status.
     */
    public function adminUpdate(Request $request, ContactSubmission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived',
            'admin_notes' => 'nullable|string',
        ]);

        $data = [
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $submission->admin_notes,
        ];

        if ($validated['status'] === 'replied' && !$submission->replied_at) {
            $data['replied_at'] = now();
        }

        $submission->update($data);

        return redirect()->back()->with('success', 'Submission updated successfully.');
    }

    /**
     * Delete a submission.
     */
    public function adminDestroy(ContactSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Submission deleted successfully.');
    }

    /**
     * Export submissions as CSV.
     */
    public function adminExport()
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->get();

        $filename = 'contact-submissions-' . now()->format('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $columns = ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Inquiry Type', 'Message', 'Newsletter', 'Status', 'Submitted At'];

        $callback = function() use ($submissions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($submissions as $submission) {
                fputcsv($file, [
                    $submission->id,
                    $submission->first_name,
                    $submission->last_name,
                    $submission->email,
                    $submission->phone,
                    $submission->inquiry_type,
                    $submission->message,
                    $submission->newsletter ? 'Yes' : 'No',
                    $submission->status,
                    $submission->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
