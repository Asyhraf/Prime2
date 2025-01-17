<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\EmailMBKM;
use App\Mail\EmailKSUKP;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Mail\EmailPanggilanMBKM;
use App\Mail\EmailPanggilanKSUKP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function emailKSUKP(Request $request)
    {
        // dd(auth()->user()->email);
        // dd($request->message);

        //$ahliKSUKP = $request->all();
        // Get authenticated user's email
        $senderEmail = "mesyuaratksn@kabinet.gov.my";
        // $senderEmail = auth()->user()->email;

        $emailAhli = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $data = array(

            'subject'       => $subject,
            'message'       => $message,
        );
        // dd(auth()->user()->email);
        // sending email function
        // go to NotifikasiEmel controller in Mail.
        Mail::to($emailAhli)
        // $recipientEmails = "norhanifah.burhanudin@kabinet.gov.my";
        // Mail::to($recipientEmails)
            ->send((new EmailKSUKP($data, $subject))->from($senderEmail));

        return back()->with('status', "Email berjaya dihantar ");
    }

    public function emailMBKM(Request $request)
    {
        // dd(auth()->user()->email);
        // dd($request->message);

        //$ahliKSUKP = $request->all();
        // Get authenticated user's email
        $senderEmail = "mesyuaratmbkm@kabinet.gov.my";
        // $senderEmail = auth()->user()->email;
        $emailAhli = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $data = array(

            'subject'       => $subject,
            'message'       => $message,
        );
        // dd(auth()->user()->email);
        // sending email function
        // go to NotifikasiEmel controller in Mail.
        Mail::to($emailAhli)
        // $recipientEmails = "norhanifah.burhanudin@kabinet.gov.my";
        // Mail::to($recipientEmails)
            ->send((new EmailMBKM($data, $subject))->from($senderEmail));

        return back()->with('status', "Email berjaya dihantar ");
    }

    public function emailPanggilanKSUKP(Request $request)
    {
        $senderEmail = "mesyuaratksn@kabinet.gov.my";

        // Retrieve inputs
        $emailAhli = $request->email;

        $cc = $request->input('cc') ? collect(explode(',', $request->input('cc')))->map(fn($email) => trim($email))->filter() : [];
        $bcc = $request->input('bcc') ? collect(explode(',', $request->input('bcc')))->map(fn($email) => trim($email))->filter() : [];

        $subject = $request->subject;
        $messageContent = $request->message;

        // Prepare email data
        $data = [
            'subject' => $subject,
            'message' => $messageContent,
        ];

        try {
            Mail::to($emailAhli)
                ->cc($cc)
                ->bcc($bcc)
                ->send((new EmailPanggilanKSUKP($data))->from($senderEmail));

            return back()->with('status', "Emel berjaya dihantar.");
        } catch (\Exception $e) {
            return back()->withErrors("Failed to send email: " . $e->getMessage());
        }
    }

    public function emailPanggilanMBKM(Request $request)
    {
        $senderEmail = "mesyuaratmbkm@kabinet.gov.my";

        // Retrieve inputs
        $emailAhli = $request->email;

        $cc = $request->input('cc') ? collect(explode(',', $request->input('cc')))->map(fn($email) => trim($email))->filter() : [];
        $bcc = $request->input('bcc') ? collect(explode(',', $request->input('bcc')))->map(fn($email) => trim($email))->filter() : [];

        $subject = $request->subject;
        $messageContent = $request->message;

        // Prepare email data
        $data = [
            'subject' => $subject,
            'message' => $messageContent,
        ];

        try {
            Mail::to($emailAhli)
                ->cc($cc)
                ->bcc($bcc)
                ->send((new EmailPanggilanMBKM($data))->from($senderEmail));

            return back()->with('status', "Emel berjaya dihantar.");
        } catch (\Exception $e) {
            return back()->withErrors("Failed to send email: " . $e->getMessage());
        }
    }
}
