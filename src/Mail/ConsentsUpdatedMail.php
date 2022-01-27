<?php

namespace Ekoukltd\LaraConsent\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsentsUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;
    
    
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $consentOptions = $this->user->activeConsents()->get();
        
        $content = view('vendor.ekoukltd.consent-options.widgets._viewUserPrint',['consentOptions'=>$consentOptions])->render();
    
        return $this->from(config('mail.from.address'),
                           config('mail.from.name'))->view(config('laraconsent.email-template'))
            ->subject(__('laraconsent::user.email-subject'))
            ->to($this->user->email)
            ->with([
                       'content'       => $content,
                       'preHeaderText' => __('laraconsent::user.email-preheader'),
                       'title'         => __('laraconsent::user.email-title'),
                   ]);
    }
}
