<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị trang liên hệ
    public function show()
    {
        $contactInfo = [
            'phone' => '+84 (0) 123 456 789',
            'email' => 'info@cameramam.com',
            'address' => '123 Đường Camera, TP. Hồ Chí Minh, Việt Nam',
            'hours' => 'Thứ 2 - Thứ 7: 09:00 - 18:00'
        ];
        
        return view('contact', compact('contactInfo'));
    }
    
    // Xử lý form liên hệ
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10'
        ]);
        
        // Gửi email hoặc lưu vào database
        // Mail::send('emails.contact', $validated, function ($message) use ($validated) {
        //     $message->from($validated['email']);
        //     $message->to(config('mail.from.address'));
        //     $message->subject($validated['subject']);
        // });
        
        return redirect()->back()->with('success', 'Cảm ơn bạn! Chúng tôi sẽ liên hệ với bạn sớm.');
    }
}
