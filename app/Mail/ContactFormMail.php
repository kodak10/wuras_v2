<?php

// app/Mail/ContactFormMail.php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;

class ContactFormMail extends Mailable
{
    public $request;
    public $attachmentPaths;

    // Accepter un tableau de chemins d'attachement
    public function __construct(Request $request, $attachmentPaths = [])
    {
        $this->request = $request;
        $this->attachmentPaths = $attachmentPaths;
    }

    public function build()
    {
        $email = $this->subject('Nouveau message de contact')
                    ->view('front-end.emails.contactForm')
                    ->with([
                        'name' => $this->request->name,
                        'email' => $this->request->email,
                        'telephone' => $this->request->telephone ?? null,
                        'sujet' => $this->request->sujet ?? 'Sans sujet',
                        'content' => $this->request->message, // Changed from 'message' to 'content'
                        'pieces_jointes' => $this->getAttachmentsData(),
                    ]);
    
        foreach ($this->attachmentPaths as $path) {
            $email->attach(storage_path('app/public/' . $path));
        }
    
        return $email;
    }
    
    private function getAttachmentsData()
    {
        if (empty($this->attachmentPaths)) {
            return null;
        }
    
        $attachments = [];
        foreach ($this->attachmentPaths as $path) {
            $file = storage_path('app/public/' . $path);
            $attachments[] = [
                'url' => asset('storage/' . $path),
                'nom' => basename($path),
                'type' => pathinfo($path, PATHINFO_EXTENSION),
                'taille' => $this->formatSize(filesize($file)),
            ];
        }
        return $attachments;
    }
    
    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }

}