<?php

namespace App\Jobs;

use App\Models\Actualite;
use App\Models\Newsletter;
use App\Mail\NewsletterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Récupérer les dernières actualités de la semaine
        $latestNews = Actualite::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->latest()
            ->get();

        // Récupérer les dernières actualités du mois
        $latestNews2 = Actualite::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->latest()
            ->get();

        // Récupérer les dernières actualités des trois dernieres mois
        $latestNews3 = Actualite::whereBetween('created_at', [now()->subMonths(3), now()])
            ->latest()
            ->get();


        $subscribers = Newsletter::where('status', true)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($latestNews));
        }
    }
}
